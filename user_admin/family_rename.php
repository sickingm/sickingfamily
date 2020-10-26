<?php
identifier_comment("START family_rename.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +-----------------------------------+
//  ¦ f a m i l y _ r e n a m e . p h p ¦
//  +-----------------------------------+
//
//	NAME:	family_edit.php
//
//	CALLED BY:
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
//	Description
//		Allows the user to edit the name of the selected family, which is stored
//		in $family.
//	
////////////////////////////////////////////////////////////////////////////////
//
	if(empty($family))return;

	$query = "SELECT family_name FROM families WHERE family_id ='$family'";
	$result = do_query($query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	echo "
	\n<form name='family_rename_form' method='POST' 
		action='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family'
		onReset=\"showElement('family_rename_buttons','none');\">
	\nRename Family:
		\n<input 
			type='text' 
			name='family_rename' 
			size='32' 
			value='{$row['family_name']}' 
			\nonKeyDown=\"showElement('family_rename_buttons','inline');\">
		\n<input type='hidden' name='family' value='$family'>
		\n<input type='hidden' name='clan' value='$clan'>
		<span id='family_rename_buttons' style='display:none'>
			\n<input type='submit' value='Submit'>
			\n<input type='reset' value='Reset'>
		\n</span>
	\n</form>
	";  

identifier_comment("END family_rename.php");