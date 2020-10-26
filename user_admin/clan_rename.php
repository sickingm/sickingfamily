<?php
identifier_comment("START clan_rename.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +---------------------------+
//  ¦ clan_rename.php ¦
//  +---------------------------+
//
//	NAME:	clan_rename.php
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
//		Allows the user to edit the name of the selected clan, which is stored
//		in $clan.
//	
////////////////////////////////////////////////////////////////////////////////
//
	if(empty($clan))return;

	$query = "SELECT clan_name FROM clans WHERE clan_id ='$clan'";
	$result = do_query($query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	echo "
	\n<form name='clan_rename_form' method='POST' 
		action='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family'
		onReset=\"showElement('clan_rename_buttons','none');\">
	\nRename Clan:
		\n<input 
			type='text' 
			name='clan_rename' 
			size='32' 
			value='{$row['clan_name']}'	
			\nonKeyDown=\"showElement('clan_rename_buttons','inline');\">
		\n<input type='hidden' name='clan' value='$clan'>
		\n<span id='clan_rename_buttons' style='display:none'>
			<input type='submit' value='Submit'>
			<input type='reset' value='Reset'>
		</span>
	\n</form>
	";  
		
identifier_comment("END clan_rename.php");