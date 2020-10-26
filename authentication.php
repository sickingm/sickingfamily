<?php

/*******************************************************************************
	a u t h e n t i c a t e . p h p
	
	contains:
		 authenticate_user($realm,$message=1) - pop up authentication menu
		 send_authenticate_header($realm) - standard authentication menu
		 check_password($name,$pwd,$log_user) - is $name/$pwd in member list
		 sessionize($user) - stores all pertinent user data in SESSION variable
		 has_privilege($member, $family, $clan) - Does current user have edit privileges
		 change_userid($member_id, $new_userid) - changes userid of current user
		 change_password($member_id, $new_password) - Changes the password for current user
 *******************************************************************************/
require_once "$doc_root/common/utility_functions.php";
//******************************************************************************
//**** a u t h e n t i c a t e _ u s e r ***************************************
//******************************************************************************

function authenticate_user($realm, $message = 1)
{
	global $db_link;
	// Validates a user for access to a page.
	// Call this routine at the top of any page that you wish to limit access
	//
	//debug_on();
	// we must never forget to start the session
	$sid = session_id();
	if (empty($sid)) session_start();

	//	db_echo('$_SESSION',$_SESSION);

	//	Check if already authenticated
	if (isset($_SESSION['authenticated']) && ($_SESSION['authenticated'] === TRUE)) return;

	extract($_POST); // Get POSTed variables in case login form has already been executed
	$errorMessage = ''; // Initialize errorMessage string

	if (isset($txtUserId) && isset($txtPassword)) {  // test user credentials
		if (check_password($txtUserId, $txtPassword, "yes")) {
			if ($message == 1) { //Output standard Welcome message
				printf(
					"\n
					<span class='who-is-it'>Authorized....</span>
					<br />Welcome: 
					<span class='user-id'>%s</span> (<span class='user-name'>%s %s</span>)",
					$_SESSION["userid"],
					$_SESSION["first_name"],
					$_SESSION["last_name"]
				);
			} else echo $message; // Otherwise just output the $message
			$_SESSION['authenticated'] = TRUE;  //Remember authentication in SESSION variable regardless of message
			return; // Go back to calling app
		}
		// Username/Password not valid.  So output error mesage and reissue userid/password request form
		else $errorMessage = "<br>--- Invalid credentials ---<br>";
	}
	if ($errorMessage != '') alert($errorMessage);

	//echo "<p align='center'><strong><font color='#990000'>$errorMessage</font></strong></p>";
?>
	<style>
		body {
			font-size: 1em
		}
	</style>

	<div id="auth-form">
		<form method="POST" id="authenticate-form">
			<table>
				<caption>
					Log on:<br />
					Enter User ID and Password
				</caption>
				<tr>
					<th>User Name:</th>
					<td><input name="txtUserId" size="20" /> </td>
				</tr>
				<tr>
					<th>Password:</th>
					<td>
						<input type="password" name="txtPassword" size="20" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Submit" name="login" /></td>
				</tr>
			</table>
		</form>
	</div>




	</body>

	</html>
<?php
	exit(); // Kill script with login form displayed (will reawaken upon Submit button)
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++ c h e c k _ p a s s w o r d +++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function check_password($name, $pwd, $log_user = "yes"){
	identifier_comment("STARTtt " . __FILE__ . " sessionize()"); // show where I am

	global $db_link;
	//	$name = user_id
	//	$pwd = password
	//	$log_user:  If "no" then check password, but don't set this as the current user
	//				Anything else, and $name/$pwd will be used to sessionize that user

	connect_and_select();

	$Q = "
		SELECT 	
    			family_id, family_name, clan_ptr,
    			member_id , family_ptr, first_name, last_name, address, 
    			DATE_FORMAT(birthday, '%m-%d-%Y') AS birthday,
    			comments , userid, password, bot, edit_privilege, see_hidden		
    		FROM members, families 
    		WHERE 
    			userid = '$name'
    		AND 
    			password in ('$pwd', md5('$pwd') )
			AND family_ptr=family_id
	";

	$result = do_query($Q, "Password Check:");

	if (mysqli_num_rows($result) == 0) return FALSE; // No userid/password match

	if ($log_user != "no") { //make this the current user unless $log_user = no
		$user_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
		sessionize($user_info); // load record into session variables
	}

	return TRUE;
}
//******************************************************************************
//**** s e s s i o n i z e *****************************************************
//******************************************************************************
function sessionize($user)
{
	identifier_comment("START " . __FILE__ . " sessionize()"); // show where I am

	if (!session_id()) session_start();
	$_SESSION["authenticated"] = TRUE;
	$_SESSION['member_id'] = $user["member_id"];
	$_SESSION['clan_ptr'] = $user["clan_ptr"];
	$_SESSION['family_ptr'] = $user["family_ptr"];
	$_SESSION['first_name'] = $user["first_name"];
	$_SESSION['last_name'] = $user["last_name"];
	$_SESSION['address'] = $user["address"];
	$_SESSION['birthday'] = $user["birthday"];
	$_SESSION['member_comments'] = $user["comments"];
	$_SESSION['userid'] = $user["userid"];
	$_SESSION['bot'] = $user["bot"];
	$_SESSION['see_hidden'] = $user["see_hidden"];
	$_SESSION['edit_privilege'] = $user['edit_privilege'];

	//debug_on();
	db_echo('$_SESSION["edit_privilege"]', $_SESSION["edit_privilege"], 0);


	identifier_comment("END " . __FILE__ . " sessionize()");
	return;
}
//******************************************************************************
//**** h a s _ p r i v i l e g e ***********************************************
//******************************************************************************
function has_privilege($member, $F=-1, $C=-1)
//
// Returns true if current logged on user has edit privilege for the 
// given member.  
// If the user is not logged on FALSE is returned.
// If the user has global edit privilege "all" is returned
// If the user has Clan-level edit privilege "clan" is returned
// If the user has Family-level edit privilege "family" is returned
// If the user is editing his own record "self" is returned
// Otherwise FALSEs returned
// 
// Privilege is granted if:
//	1. Current user is the same as the member to be edited ("self")
// 	2. Current user has family privilege equal to member to be edited 
//			(i.e. edit_privilege = "family")
//  3. Current user has clan privilege equal to clan of member to be edited
//			(i.e. edit_privilege="clan")
//	4. Current user has super privilege (i.e., edit_privilege="all")
//

// If family or clan or -1, use the family and/or clan values for $member
{

//	identifier_comment("BEGIN " . __FILE__ . " function (" . __FUNCTION__ . ") Line #" .__LINE__);

	//Check if user has even logged on
	if (empty($_SESSION["authenticated"])) return (FALSE);

	//Check if user has full edit privileges
	if ($_SESSION["edit_privilege"] == "all") return ("all");

	//Check if user has clan edit privilege and if member to be edited is in his clan
	if($C<0) {
		$query = "
			SELECT family_ptr AS family, clan_ptr AS clan
			FROM members, families
			WHERE member_id='$member'
			AND family_ptr=family_id
			";
		$result = do_query($query);
		$row = mysqli_fetch_assoc($result);
		$clan=$row['clan'];
		$family=$row['family'];
	}
	if($F>0) $family=$F;	

	if ($_SESSION["edit_privilege"] == "clan" && $clan == $_SESSION["clan_ptr"]) return ("clan");

	//Check if user has family edit privilege and if member to be edited is in his family
	if ($_SESSION["edit_privilege"] == "family" && $family == $_SESSION["family_ptr"]) return ("family");

	//Check if user is same as member to be edited
	if ($_SESSION["member_id"] == $member) return ("self");
	return (FALSE);
}

//******************************************************************************
//**** c h a n g e _ u s e r i d ***********************************************
//******************************************************************************
function change_userid($member_id, $new_userid)
{
	//
	// Changes the user_id of the specified member.
	// First it checks to make sure that the userid is not already in use.
	//
	//
	// Return value specifies error code in setting the password
	// So if the return value is FALSE then the password has been changed.
	// Otherwise the return value will be a string indicating the error.
	// 
	// String vales for these a=error codes is stroed in the
	// Global variable $chg_id_return_code
	//debug_on();

	global $chg_id_return_code;
	/*
echo "Session:<pre>";
print_r($_SESSION);
print "</pre>";
*/

	$chg_id_return_code = array(
		'User ID successfully changed',
		'Illegal User ID requested.<br />Must be at least three characters long.',
		'No change to userid',
		"User ID $new_userid is already in use by ##FIRST## ##LAST##",
		'Failed to update User ID -- Unknown Error.  Contact Matt Sicking'
	);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	connect_and_select();

	// Check if valid userid
	if (strlen($new_userid) < 3) return $chg_id_return_code[1]; //Illegal User ID

	// Check if the userid has not changed (i.e. is userid already the one member_if ($who) has been using
	$query = "SELECT userid FROM members WHERE member_id='$member_id'";
	$result = do_query($query);
	$row = mysqli_fetch_array($result);
	if ($row['userid'] == $new_userid) return ($chg_id_return_code[2]);  //User ID has not changed;

	// Check to make sure that $new_userid is not already in use.	
	$result = do_query("
		SELECT first_name, last_name 
			FROM members 
			WHERE userid = '$new_userid'
		");
	if (mysqli_num_rows($result) > 0) {
		$other_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$rtn = str_replace('##FIRST##', $other_info["first_name"], $chg_id_return_code[3]);
		$rtn = str_replace('##LAST##', $other_info["last_name"], $rtn);
		return $rtn;  // ID is already in use.
	}

	// Username is valid.  Update member's record
	if (do_query("UPDATE members SET userid='$new_userid' WHERE member_id='$member_id' ")) {
		//(UPDATE returns TRUE/False one success/failure)
		$_SESSION["userid"] = $new_userid;
		return $chg_id_return_code[0];
	} else return $chg_id_return_code[4]; // failure to pdate data base??????
}

//******************************************************************************
//**** c h a n g e _ p a s s w o r d *******************************************
//******************************************************************************
function change_password($member_id, $new_password, $alert_type = "")
{
	//
	// Changes the password of the specified member.
	//
	// Open database 
	connect_and_select();

	// Update member's record
	$result = do_query("
		UPDATE members 
			SET password='$new_password' 
			WHERE member_id='$member_id'
		");
	$_SESSION["password"] = $new_password;

	$alert = "Password changed";
	if ($alert_type == "Full") $alert .= " to '$new_password'";
	$alert .= ".";
	return $alert;
}
