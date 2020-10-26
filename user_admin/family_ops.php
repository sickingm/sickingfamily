<?php
identifier_comment("START family_ops.php");
//////////////////////////////////////////////////////////////////////////////
//
//  +-----------------------------+
//  � f a m i l y _ o p s . p h p �
//  +-----------------------------+
//
//	NAME:	family_ops.php
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
if(!empty($family))  {

// Get family name (At this point we only have the family_ptr stored in $family)
	$result = do_query("SELECT family_name, clan_ptr FROM families where family_id=$family");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$family_name = $row["family_name"];
	$clan = $row["clan_ptr"];
	
 	echo "\n<div ID='family_ops'>"; $family_ops=TRUE;
	echo "	\n<fieldset class='fieldset-family'>\n
		 	<legend>
	 			<a class='ops' href='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family&amp;family=$family&amp;clan=$clan'>
				 	Family Operations:
				 	<font color='#CC0000'>$family_name</font>
				</a></legend>";
	require "family_rename.php";
	echo "<table width='100%'><tr><td>";
	add('member');
	echo "</td><td>";
	require "member_delete.php";
	echo "</td></tr></table>";

}
identifier_comment("END family_ops.php");