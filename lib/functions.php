<?php

	function login_reminder_get_teaser_content(ElggUser $user){
		$result = "";
		
		if(!empty($user) && ($user instanceof ElggUser)){
			$backup_user = $_SESSION["user"];
			$_SESSION["user"] = $user;
			
			$options = array(
				"type" => "user",
				"count" => true,
				"created_time_lower" => $user->last_action
			);
			
			// count new users
			if($count = elgg_get_entities($options)){
				if(empty($result)){
					$result = elgg_echo("login_reminder:teaser") . "\n";
				}
				
				$result .= sprintf(elgg_echo("login_reminder:teaser:users"), $count) . "\n";
			}
			
			// count new groups
			if(is_plugin_enabled("groups")){
				$options["type"] = "groups";
				
				if($count = elgg_get_entities($options)){
					if(empty($result)){
						$result = elgg_echo("login_reminder:teaser") . "\n";
					}
					
					$result .= sprintf(elgg_echo("login_reminder:teaser:groups"), $count) . "\n";
				}
			}
			
			// count new blogs
			if(is_plugin_enabled("blogs")){
				$options["type"] = "object";
				$options["subtype"] = "blog";
				
				if($count = elgg_get_entities($options)){
					if(empty($result)){
						$result = elgg_echo("login_reminder:teaser") . "\n";
					}
					
					$result .= sprintf(elgg_echo("login_reminder:teaser:blog"), $count) . "\n";
				}
			}
			
			$_SESSION["user"] = $backup_user;
		}
		
		return $result;
	}