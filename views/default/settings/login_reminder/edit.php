<?php

	$plugin = $vars["entity"];
	
	$interval = (int) $plugin->interval;
	if($interval < 1){
		$interval = 30;
	}
	
	echo "<div>";
	echo elgg_echo("login_reminder:settings:interval");
	echo "&nbsp;<input type='text' name='params[interval]' value='" . $interval . "' size='5' maxlength='3' />";
	echo "</div>";