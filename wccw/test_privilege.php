<?php

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
	identifier_comment("BEGIN " . __FILE__ . " function (" . __FUNCTION . ") Line #" .__LINE__);

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