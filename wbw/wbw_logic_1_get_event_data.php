<?php

fill_comment("  BEGIN  ", __FILE__);

//Read in wbw data for current event
connect_and_select();
$query = "SELECT 
		event_id,
		DATE_FORMAT(date,'%M %e, %Y') as date, 
		TIME_FORMAT(time,'%h:%i%p') as time, 
		event, venue, comments, posted_by,
		DATE_FORMAT(date,'%Y%m%d') as date2
		FROM events where event_id='$wbw_event_ptr'";

$result = do_query($query);
$event_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
extract($event_data);



//  add/update data base if form has been submitted

// Check if input has been entered (clue is that $_REQUEST['coming'] exists)
if (isset($_REQUEST['coming'])) {
	extract($_REQUEST);
	$mid = $_SESSION['member_id'];
	$query = "SELECT * FROM wbw WHERE member_ptr='$mid' AND event_ptr='$wbw_event_ptr'";
	$result = do_query($query);
	$num_rows = mysqli_num_rows($result);
	$row=mysqli_fetch_assoc($result);
	extract($row);
	$qb = slash_it($bringing);
	$qc = slash_it($comments);
	$query = "
		INSERT INTO wbw (event_ptr, member_ptr, coming, bringing, comments) 
		VALUES ('$event_id','$mid','$coming','$qb', '$qc')
		ON DUPLICATE KEY UPDATE    
			coming='$coming',
			bringing='$qb',
			comments='$qc' ";

	do_query($query);
}

fill_comment("  END  ", __FILE__);
?>