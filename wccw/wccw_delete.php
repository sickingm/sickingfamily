<?php
identifier_comment("BEGIN " . __FILE__ . "Line #" . __LINE__ . "    Function: (" . __FUNCTION__ . ")");
require_once "wccw_list.php";
function wccw_delete($event_id) { // Deletes event $event_id
    $event_id = $_REQUEST['event_id'];
    $Q = "DELETE FROM wccw_events WHERE event_id = '$event_id' ";
    do_query($Q);
    wccw_list(NULL);
}
identifier_comment("END " . __FILE__ . "Line #" . __LINE__ . "    Function: (" . __FUNCTION__ . ")");