<?php
identifier_comment("START family_select.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +-----------------------------------+
//  ¦ f a m i l y _ s e l e c t . p h p ¦
//  +-----------------------------------+
//
//	NAME:	family_select.php
//
//	INCLUDED INTO:
//			edit_clan_and_family.php
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
//	USES TABLES:
//		family:
//			Field		Type		Null
//			---------	-----------	----
//			family_id	bigint(20)	No
//			family_name	varchar(32)	No
//			clan_ptr	bigint(20)	No
//
//	Description
//		Presents a drop-down list of all family ID's and names, with the user's own
//		family being the default.
//		The selected family is loaded into the $family variable.
//		
//		This routine is only called if the user has "all" edit privilege.
//		Otherwise $family is set to the user's family pointer by edit_clan_and_family.php
//		and this routine is never called.
//	
////////////////////////////////////////////////////////////////////////////////
//debug_on();
db_echo("\$_POST",$_POST);

// Get current family to use as default.  If $family is not defined use user's family
	if(empty($family)) $family = NULL;

// Query to get all family names
	$query = "SELECT * FROM families WHERE clan_ptr='$clan' ORDER BY family_id";
	$result = do_query($query);
	
	if( ($nr = mysqli_num_rows($result)) >1 ) {  //Count the rows, store in $nr, and check if greater than one
		// Begin Drop Down List and autosubmit on change
		echo "\n<form name='family_select_form' 
				method='POST' action='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family'>"; 
		echo "<input type='hidden' name='clan' value='$clan'>";
		echo "\nSelect family:<br>";
		echo "\n<select size='1' name='family_select' onChange='document.family_select_form.submit();' >";  
		echo "\n<option selected>--Select a family</option>";
		//Cycle through all families and make $family the default	
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		 	extract ($row);
			echo "\n	<option value='$family_id'";
			if($family_id == $family) echo " SELECTED";
			echo ">$family_id - $family_name</option>";
		}
		echo "\n</select>\n</form>";
	}	
	else { 
		list($family) = mysqli_fetch_row($result);  // Get the single family (or NULL if no families in clan)
	}

db_echo("family",$family);
debug_off();	

identifier_comment("END family_select.php");