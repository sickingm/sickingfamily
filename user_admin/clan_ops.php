<?php
identifier_comment("START clan_ops.php");
//////////////////////////////////////////////////////////////////////////////
//
//  +-------------------------+
//  � c l a n _ o p s . p h p �
//  +-------------------------+
//
//	NAME:	clan_ops.php
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
//		Provides for adding and deleting to/from the family database
//		Only superusers (admin privilege) have access to this page
//	
//////////////////////////////////////////////////////////////////////////////

//debug_on();
if (!empty($clan)) {
 
	if (empty($family))$family = NULL;
	
// Get clan name
	$result = do_query("SELECT clan_name FROM clans where clan_id=$clan");
	list($clan_name) = mysqli_fetch_row($result);
 	echo "\n<div ID='clan_ops'>\n"; $clan_ops=TRUE;
	 echo  "<fieldset class='fieldset-clan'>\n";
	 echo  "<legend>
	 			<a class='ops' href='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family&amp;family=0&amp;clan=$clan'>
				 	Clan Operations:
				 	<font color='#CC0000'>$clan_name</font>
				</a>
			</legend>";
	require "clan_rename.php";

	echo  "<table width='100%'><tr><td valign='top'>";
	require "family_select.php"; 

	echo  "</td><td valign='top'>";
	add('family');
	echo  "</td></tr>
	<tr><td>&nbsp;</td><td valign='top' >";
	require "family_delete.php";
	echo  "</td></tr></table>";
}
		
identifier_comment("END clan_ops.php");