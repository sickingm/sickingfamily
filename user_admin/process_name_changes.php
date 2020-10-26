<?php
identifier_comment("START process_name_changes.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +--------------------------+
//  ¦ process_name_changes.php ¦
//  +--------------------------+
//
//	CALLED BY:
//			XX
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

// Check if a change to a clan name has been submitted.  If so, update the data base
	if(!empty($clan_rename)) {
	 	$result = do_query("SELECT clan_name FROM clans WHERE clan_id ='$clan_rename'");
	 	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		message("Renaming clan $clan from {$row['clan_name']} to $clan_rename");
		$result = do_query("
			UPDATE clans 
				SET clan_name='$clan_rename' 
				WHERE clan_id='$clan'
			");		
	}


// Check if a change to a family name has been submitted.  If so, update the data base
	if(!empty($family_rename)) {
		message("Renaming family $family to $family_rename");
		$result = do_query("
			UPDATE families 
				SET family_name='$family_rename' 
				WHERE family_id='$family'
			");		
	}


identifier_comment("END process_name_changes.php");