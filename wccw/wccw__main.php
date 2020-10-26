<!-- BEGIN wccw_main.php -->
<?php
////////////////////////////////////////////////////////////////////////////////
//
//  +---------------------------+
//  � w c c w _ m a i n . p h p �
//  +---------------------------+
//
//	NAME:	main.php
//
//	CALLED BY:
//			<none>
//
//	CALLS:
//			identifier_comment
//
//	INCLUDES:
//			wccw_common/wccw_general_header.php
//			wccw_main_header.php
//			wccw_main_footer.php
//
//	CONTAINS:
//			display_event_table_header
//			display_description
//			display_dates
//			display_invitees
//			ok_to_display_private
//
//	USES STYLES:
//			(see wccw_main_header.php)
//			
//	Description
//			Main entry point for the wccw appliaction.  When entered this file
//			displays the entire list of open events (except for private events
//			to which the user is not invited), along with all pertinent info 
//			regarding the events: Description, list of suggested dates, list of 
//			invitees, and the 'scores' that each date currently has.
//			Also, if the user is the organizer of the event, it also shows the
//			edit and delete options
////////////////////////////////////////////////////////////////////////////////
//
// Output all header detail, user validation, and the main title.
$page_title = "Who Can Come When";
require_once "wccw_class.php"; 

identifier_comment("BEGIN ".__FILE__." ".__LINE__);
//pre_dump('$_REQUEST',$_REQUEST);

// Parse url and direct execution to the appropriate routines
extract($_REQUEST);
if (empty($cmd)) $cmd = "list";

$cmd=strtolower($cmd);
/* 	
	Extracts all $_REQUEST parameters
	One input parameter should be "cmd" (loaded by Extract into the $cmd variable)
	which determines the function to process.
	Allowable values for $cmd are:
		- delete
		- edit
		- list (default)
		- mail_some
		- mail-all
		- new
		- poll
		- <null> (set to 'list')

		One exeption: If the $cmd is "new" but the $save_event is set (to "SAVE EVENT")
		then perform a save operaton instead of a create new operation
*/

if(isset($save_event) AND $save_event=="Save Event")$cmd="save_event";
$function_name = "wccw_$cmd";  
$file_name = "$function_name.php";

// E.g., if cmd is 'edit' then function_name is 'wccw_edit' and filename is 'wccw_edit.php'
if (file_exists($file_name)) {  // Make sure the file (and therefore the function) exists
	require $file_name;         // It does, so require it and execute it
	If(empty($event_id))$event_id='';
	$function_name($event_id);
} else die("Illegal command: $cmd");

?>
<!-- END wccw_main.php-->