<?php
identifier_comment("START clan_select.php");
//////////////////////////////////////////////////////////////////////////////
//
//  +-------------------------------+
//  � c l a n _ s e l e c t . p h p �
//  +-------------------------------+
//
//	NAME:	clan_select.php
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
//		clan:
//			Field		Type		Null
//			---------	-----------	----
//			clan_id		bigint(20)	No
//			clan_name	varchar(32)	No
//
//	Description
//		Presents a drop-down list of all clan ID's and names, with the user's own
//		clan being the default.
//		The selected clan is loaded into the $clan variable.
//		
//		This routine is only called if the user has "all" edit privilege.
//		Otherwise $clan is set to the user's clan pointer by edit_clan_and_family.php
//		and this routine is never called.
//	
//////////////////////////////////////////////////////////////////////////////
	
//debug_on();
db_echo("\$_POST",$_POST);
	 	
// Get current clan to use as default.
// If $clan is not defined set $clan to NUll to force clan selection
	if(empty($clan)) $clan = null;

// Query to get all clan names
	$query = "SELECT * FROM clans ORDER BY clan_id";
	$result = do_query($query);
	
// Begin Drop Down List and autosubmit on change
	echo <<<CLAN
<form name='clan_select_form' method='POST' action='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family'>
    <label for='clan_select'>Select a Clan:</label>
	<select size='1' 
        name='clan_select' 
		onChange='document.clan_select_form.submit();' >
CLAN;
       
 //Cycle through all clans and make $clan the default	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	 	extract ($row);
		echo "\n	<option value='$clan_id'";
		if($clan_id == $clan) echo " SELECTED";
		echo ">$clan_id - $clan_name</option>";
	}

	echo "\n</select>\n<br>\n</form>";	

identifier_comment("END clan_select.php");