<?php
identifier_comment("START	login_action.php");
	$logged_in=check_password($txtUserId,$txtPassword,'realm');
	if(!$logged_in){
		alert('Incorrect username/password....Please re-enter.','error-msg');
		include "login.php";
	}
	else alert("Authorized.... <br />
        Welcome: <span class='user-id'>{$_SESSION['userid']}</span> 
        (<span class='user-name'>{$_SESSION['first_name']} {$_SESSION['last_name']}</span>)");

identifier_comment("END	login_action.php");