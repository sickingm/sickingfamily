<?php
identifier_comment("START admin_ops.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +---------------------------+
//  � a d m i n _ o p s . p h p �
//  +---------------------------+
//
//	NAME:	admin_ops.php
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
////////////////////////////////////////////////////////////////////////////////
 	echo "\n<div ID='admin_ops'>"; $admin_ops=TRUE;
	echo "\n<fieldset class='fieldset-admin'>";
	echo "
<legend>
	<a class='ops' href='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family&family=0&clan=0'>Admin Operations</a>
</legend>";

	if(empty($clan))$clan = NULL;
	
	echo "\n<table><tr>\n<td>";
	require "clan_select.php"; //Admins (superusers) can edit any clan, others can only edit their own
	echo "</td>\n<td>";
	add('clan');				
	echo "</td>\n<td>";
	require "clan_delete.php";	
	echo "</td></tr></table>";
		
identifier_comment("END admin_ops.php");