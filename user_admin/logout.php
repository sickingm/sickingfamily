<?php
identifier_comment("BEGIN logout.php"); 	
	$logged_in=FALSE;
	if(empty($_SESSION["authenticated"]) || !($_SESSION["authenticated"]===TRUE) ) {
		echo "No One Logged in..........<br>";
		//if (isset($_SESSION))var_export($_SESSION);
	}
	else  {
		if (isset($_COOKIE[session_name()]))setcookie(session_name(), '', time()-42000, '/');
		echo"\n<span class='message'>
                Logging off: <br />
                <span class='user-id'>**{$_SESSION['userid']}**</span>
                (<span class='user-name'>{$_SESSION['first_name']} {$_SESSION['last_name']}</span>)
            </span>";
            
		// Note: This will destroy the session, and not just the session data!
		$_SESSION = array(); // reset session array
		session_destroy();   // destroy session.
	}
// force a reload of the navigation frame

identifier_comment("END logout.php"); 