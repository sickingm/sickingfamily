<?php
identifier_comment("START edit_clan_and_family.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +-------------------------------------------------+
//  ¦ e d i t _ c l a n _ a n d _ f a m i l y . p h p ¦
//  +-------------------------------------------------+
//
//	NAME:	edit_clan_and_family.php
//
//	CALLED BY:
//			user_admin_navigation.php
//
//	CALLS:
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
//		Allows for Adding, Deleting and Editing Clan and Family information
//		Routines are only include if the user has sufficient privilege
//
//	clans:
//		Field		Type		Null
//		---------	----------	----
//		clan_id		bigint(20)	No	
//		clan_name	varchar(32)	No	
//
//	
////////////////////////////////////////////////////////////////////////////////
//
?>
<script>
function showElement(id,displayMode) {
	//safe function to show an element with a specified id

	if(displayMode == null) 
		{ displayMode = "inline"}	 
	
	if (document.getElementById) { 
		document.getElementById(id).style.display = displayMode;
	}
}
</script>
<?php

// Remember whether user has clan or family editing prvilege
	if (empty($_SESSION["edit_privilege"])) return ("User Not logged in");

// Get the actual edit privilege
	$edit_priv = $_SESSION["edit_privilege"];

// Convert to numeric value for easier algorithm
	$levels = array("self"=>0, "family"=>1, "clan"=>2, "all"=>3); 
	$edit_level = $levels[$edit_priv]; //Calculate numeric edit level

include "message.php";
include "process_new_elements.php";	// fields requests to add a new clan, family, or member
include "process_name_changes.php";	// fields requests to change the name of a clan, family, or member
include "process_deletions.php";	// fields requests to delete a clan, family, or member
include "process_selections.php";	// fields requests to change focus to another clan, family, or member

// Check whether admin wishes to change the clan to be operated on
	if(!empty($clan_select)){
		$clan = $clan_select; // Make the selected clan the one in question
		unset($family); // Destroy current family since it may not be a member of $clan
						// Let logic in family_select determine the correct family name
	}

require_once "add.php";

// If privilege is "all" allow adding and deleting of clans
	if($edit_level > 2) include "admin_ops.php";
	else $clan = $_SESSION["clan_ptr"];
	
// If privilege is 'clan' or 'all' allow editing of clan name and selection of family
	if ($edit_level > 1 ) include "clan_ops.php";  // logic to edit clan name
	else $family = $_SESSION["family_ptr"]; // otherwise just use user's family

// If privilege is 'family' or better allow editing of family name
	if ($edit_level > 0) include "family_ops.php"; 
	else return ("No clan or family edit privilege");
	
// Close up fieldset tags if used
	if(isset($admin_ops) AND $admin_ops)echo "</fieldset></div>";
	if(isset($clan_ops) AND $clan_ops)echo "</fieldset></div>";
	if(isset($family_ops) AND $family_ops)echo "</fieldset></div>";


identifier_comment("END edit_clan_and_family.php");