<?php
identifier_comment("BEGIN " . __FILE__ . ' ***************************************************** ');
/*
    Reads POSTed variables and updates the Event table in the data base
    Adds any new event created in the form
    
    DOES NOT print out these vales on the page.
*/
connect_and_select();
if(!empty($edit_event)) {
	foreach ($edit_event as $k => $v) {
		$q='UPDATE events 
			SET event="'.slash_it(trim($v))
    			.'", date="'.date("Y-m-d",strtotime($edit_date[$k]))
    			.'", time="'.date("H:i:s",strtotime($edit_time[$k]))
    			.'", venue="'.trim(slash_it($edit_venue[$k]))
    			.'", comments="'.slash_it(trim($edit_comments[$k]))
    			.'" WHERE event_id='.$k;
			do_query($q);
	}
}
if (!empty($new_event)) {
		if(empty($new_date))$new_date="now"; 
		if(empty($new_time))$new_time="now";
 		$q='INSERT INTO events 
		(event, date, time, venue, comments, posted_by)
		VALUES ("'.slash_it(trim($new_event))
		.'", "'.date("Y-m-d",strtotime($new_date))
		.'", "'.date("H:i:s",strtotime($new_time))
		.'", "'.slash_it(trim($new_venue))
		.'", "'.slash_it(trim($new_comments))
		.'", "'.$_SESSION["userid"]
		.'")';
	do_query($q);
}

// Delete obsolete Events
    do_query('DELETE FROM events where date < DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -3 day)');
    
// Delete orphaned wbw's
    do_query('DELETE FROM wbw WHERE event_ptr NOT IN (SELECT event_id FROM events)');

identifier_comment("END " . __FILE__ . ' ***************************************************** ');
?>