<?php
identifier_comment("START process_deletions.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +----------------------+
//  ¦ process_deletions.php¦
//  +----------------------+
//
//	CALLED BY: XX
//
//	CALLS:
//		<none>
//
//	INCLUDES:
//		<none>
//
//	CONTAINS:
//		<none>
//
//	USES STYLES:
//		<none>
//			
//	Description
//		<none>
//	
////////////////////////////////////////////////////////////////////////////////

// Check if a clan name has been submitted for deletion.
	if(!empty($clan_delete)) {
	 	$result = do_query("SELECT clan_name FROM clans WHERE clan_id ='$clan_delete'");
	 	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	 	$cn = $row["clan_name"];
		message("Deleting clan $clan_delete - $cn");
		$result = do_query("DELETE FROM clans WHERE clan_id='$clan_delete'");		
	}
	
// Check if a family name has been submitted for deletion.
	if(!empty($family_delete)) {
	 	$result = do_query("SELECT family_name FROM families WHERE family_id ='$family_delete'");
	 	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	 	$fn = $row["family_name"];
		message("Deleting family $family_delete - $fn");
		$result = do_query("DELETE FROM families WHERE family_id='$family_delete'");		
	}
	
// Check if a member name has been submitted for deletion.
	if(!empty($member_delete)) {
	 	$result = do_query("SELECT first_name, last_name FROM members WHERE member_id ='$member_delete'");
	 	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	 	$mn = $row["first_name"]." ".$row["last_name"];
		message("Deleting member $member_delete - $mn");
		$result = do_query("DELETE FROM members WHERE member_id='$member_delete'");		
	}

identifier_comment("END process_deletions.php");