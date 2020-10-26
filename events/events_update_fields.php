<?php
identifier_comment("BEGIN " . __FILE__ . " Line # " . __LINE__ . " FUNCTION: " . __FUNCTION__);
//debug_on();
connect_and_select();
if(!empty($edit_event))
{
	foreach ($edit_event as $k => $v)
	{
		$q='UPDATE events 
			SET event="'.slash_it(trim($v))
			.'", date="'.date("Y-m-d",strtotime($edit_date[$k]))
			.'", time="'.date("H:i:s",strtotime($edit_time[$k]))
			.'", venue="'.trim(slash_it($edit_venue[$k]))
			.'", comments="'.slash_it(trim($edit_comments[$k]))
			.'" WHERE event_id='.$k;
			do_query($q);
			db_echo("q",$q);
	}
}

if (!empty($new_event))
{
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
	db_echo("q",$q);
}
debug_off();
identifier_comment("END " . __FILE__ . " Line # " . __LINE__ . " FUNCTION: " . __FUNCTION__);
?>