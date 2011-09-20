<?php

	$english = array(
		'login_reminder' => "Login Reminder",
		
		'login_reminder:settings:interval' => "After how many days should a user be reminded to login?",
		
		'login_reminder:notify:subject' => "You haven't been online for some time",
		'login_reminder:notify:message' => 'Dear %4$s,

We\'ve noticed that you haven\'t signed in to %2$s for %1$s days.

We\'d like you to come back to our community, please sign in here:
%3$s

%5$s',
		'login_reminder:teaser' => "Since you've been away the following content was added:",
		'login_reminder:teaser:blog' => "%s new blogs",
		'login_reminder:teaser:groups' => "%s new groups",
		'login_reminder:teaser:users' => "%s new users",
		
	);
	
	add_translation("en", $english);