<?php
identifier_comment(' Line #' . __LINE__ . ' in ' . __FILE__.' function '.__FUNCTION__);

require_once "wccw_list.php";

function wccw_save_event() {

d("Beginning wccw_save_event FUNCTION");
// extract $title, $details, $invitee_group, $chbox, dates from $_REQUEST
    extract($_REQUEST);  
    $my_event = new WCCW();
    // Convert privacy status from html version to db version

    // Get stored event data if it exists
    if (isset($event_id) and $event_id>0) $my_event->load($event_id);
    if (isset($title)) $my_event->set_title($title);
    if (isset($details)) $my_event->set_details($details);

    $my_event->set_is_private(isset($private) ? 'private' : 'public'); 
    $my_event->update_dates(explode(',',$dates)); 
    $my_event->update_invitees(array_keys($chkbox));  // Blank comments will be added to the array as well 

    $my_event->save();
    wccw_list();
}
identifier_comment(' Line #' . __LINE__ . ' in ' . __FILE__.' function '.__FUNCTION__);