<?php
identifier_comment("START process_new_elements.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +--------------------------+
//  ¦ process_new_elements.php ¦
//  +--------------------------+
//
//	NAME:	filename.php
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
//

// Check if a new clan has been created.  If so, update the data base
	if(!empty($new_clan)){
		message("Creating new clan: $new_clan");
	 	$new = slash_it($new_clan);
		$result = do_query("
			INSERT INTO clans  (clan_name) 
						VALUES ('$new')
			");
	}

// Check if a new family has been created.  If so, update the data base
	if(!empty($new_family)){
		message("Creating new family: $new_family");
	 	$new = slash_it($new_family);
		$result = do_query("
			INSERT INTO families (family_name, clan_ptr) 
						  VALUES ('$new', $clan)
			");
	}

// Check if a new member has been created.  If so, update the data base
	if(!empty($new_member)){
		message("Creating new member: $new_member");
		// Split between first and last name.  Use * as forced split for names
		// with blank in them (e.g., Mark Van Dyke)
		if ($star_location = strrpos($new_member, '*') ) $break = $star_location;
		else $break = strrpos($new_member, " "); // Otherwise split at last blank (as in Mary Beth Schmidt)
			$first_name = trim(substr($new_member,0,$break));
			$last_name = trim(substr($new_member,$break+1));
		$result = do_query("
			INSERT INTO members (first_name, last_name, family_ptr) 
						  VALUES ('$first_name','$last_name', $family)
			");		
	}
debug_off();
identifier_comment("END process_new_elements.php");