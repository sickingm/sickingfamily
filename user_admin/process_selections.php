<?php
identifier_comment("START filename.php");
////////////////////////////////////////////////////////////////////////////
//
//  +--------------+
//  ¦ filename.php ¦
//  +--------------+
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
////////////////////////////////////////////////////////////////////////////

// Check whether admin wishes to change the clan to be operated on
	if(!empty($clan_select)){
		$clan = $clan_select; // Make the selected clan the one in question
		unset($family); // Destroy current family since it may not be a member of $clan
						// Let logic in family_select determine the correct family name
	}

// Check whether clan head wishes to change the family to be operated on
	if(!empty($family_select)){
		$family = $family_select; // Make the selected family the one in question
		unset($member); // Destroy current member since it may not be a member of $family
						// Let logic in member_select determine the correct member name
	}

identifier_comment("END filename.php");