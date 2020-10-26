
<!--****************************************************************************
			START	get_privileges.php
-->
<?php
//
//	NAME:	get_privileges.php
//
//	CALLED BY:
//			address_book_edit_main.php
//
//	CALLS:
//			connect_and_select (from common/utility_funcitons.php
//
//	DESCRIPTION:
//		Determine currently logged in user's edit permissions
//		(global, clan, and family)
//
//debug_on();

db_text(__FILE__); // show where I am

$family_ptr=get_family_from_member($who);
$clan_ptr=get_clan_from_family($family_ptr);

$allowed_to_edit=has_privilege($who,$family_ptr,$clan_ptr);  // Determines what level of edit privilege current user has for this member
$not_allowed_to_edit=(strlen($allowed_to_edit)==0); // Does he have any edit privilege at all
$allowed_to_edit_all=($allowed_to_edit=="all");  // Can he edit everybody?
$allowed_to_edit_clan=($allowed_to_edit_all || $allowed_to_edit=="clan"); // Can he at least edit the entire clan?
$allowed_to_edit_family=($allowed_to_edit_clan || $allowed_to_edit=="family"); // Can he at least edit his entire family

db_echo("allowed_to_edit",$allowed_to_edit);
db_echo("not_allowed_to_edit",$not_allowed_to_edit);
db_echo("allowed_to_edit_all",$allowed_to_edit_all);
db_echo("allowed_to_edit_clan",$allowed_to_edit_clan);
db_echo("allowed_to_edit_family",$allowed_to_edit_family);
?>
<!--
			END		get_privileges.php
*****************************************************************************-->
