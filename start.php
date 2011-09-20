<?php

	require_once(dirname(__FILE__) . "/lib/functions.php");

	function login_reminder_cron_hook($hook, $type, $returnvalue, $params){
		global $CONFIG;
		
		// get configured interval (in days)
		$interval = (int) get_plugin_setting("interval", "login_reminder");
		
		if($interval < 1){
			$interval = 30;
		}
		
		// convert days to seconds
		$day = 24 * 60 * 60;
		$ts_interval = time() - ($interval * $day);
		
		// set options
		$options = array(
			"type" => "user",
			"limit" => false,
			"joins" => array("JOIN " . $CONFIG->dbprefix . "users_entity ue ON e.guid = ue.guid"),
			"wheres" => array("(ue.last_action < " . $ts_interval . ")")
		);
		
		if($users = elgg_get_entities($options)){
			// notify users
			foreach($users as $user){
				// create message vars
				$message_args = array(
					$interval,
					$CONFIG->site->name,
					$CONFIG->site->url,
					$user->name,
					login_reminder_get_teaser_content($user)
				);
				
				$subject = elgg_echo("login_reminder:notify:subject");
				$message = vsprintf(elgg_echo("login_reminder:notify:message"), $message_args);
				
				notify_user($user->getGUID(), $CONFIG->site_guid, $subject, $message, null, "email");
				
				// set last action, to prevent the same mail tommorow
				set_last_action($user->getGUID());
			}
		}
	}

	// register CRON hook
	register_plugin_hook("cron", "daily", "login_reminder_cron_hook");
	