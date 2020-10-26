<?php
identifier_comment("BEGIN " . __FILE__ . " " . __LINE__);
//pre_dump("BEGIN ", __FILE__);
/*
1. Retrieve event_id from $_REQUEST
2. Load event from database
3. Get member_id from $_SESSION
4. Determine if user is an invitee; if not return to list
   (Probably better to put this test in the list page)
5. Display Event Descrtiption
6. Display list of dates
7. Retrieve any previous votes
8. Implement the voting buttons
9. Tally votes
10. Identify non-respondents
*/

//Build top of page

$page = file_get_contents('wccw_poll_1_top.htm');
$page = str_replace('##EVENT_ID##', $event_id, $page);
$page = str_replace('##ORGANIZER##', $_SESSION['first_name'].' '. $_SESSION['last_name'] , $page);
$result = do_query("SELECT * FROM wccw_events WHERE event_id = '$event_id';");
$row = mysqli_fetch_array($result,MYSQLI_ASSOC) ;
$page = str_replace('##TITLE##', $row['title'], $page);
$page=str_replace('##DETAILS##',$row['details'],$page);

// Get list of dates
$result = do_query("SELECT date, DATE_FORMAT(date,'%a<br>%b %e') as little_date 
            FROM wccw_dates 
            WHERE event_ptr='$event_id'
            ");
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
   $dates[]=$row['date'];
   $little_dates[]=$row['little_date'];
}

// Get list if invitees and associated comments
$result=do_query("
      SELECT 
         concat(first_name,' ',last_name) AS full_name, 
         wccw_invitees.invitee_id, 
         wccw_invitees.comments 
      FROM members, wccw_invitees
      WHERE member_id=invitee_id
      ");
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
   $invitee[]=
      array(
         'id'=>$row['invitee_id'],
         'name'=> get_member_name($row['invitee_id']), 
         'comments'=>$row['comments']
      );
}


// Put the dates into the header row pf the table
$page=str_replace('##DATES##', "\n<th>".implode("</th>\n<th>",$little_dates)."</th>\n", $page);

//read in all votes for each invitee and date
   $Q= "SELECT ynm_member_id AS inv, ynm_date_id AS date, ynm
	FROM wccw_ynm, wccw_dates, wccw_invitees 
	WHERE wccw_ynm.event_ptr='$event_id' 
		AND ynm_member_id = wccw_invitees.invitee_id 
      AND wccw_dates.date=wccw_ynm.ynm_date_id ";
   $result = do_query($Q); 
   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      extract($row);
      $vote[$inv][$date]=$ynm;
   }

/* 
   Note: $dates contains list of valid dates.  Keep that for later use.
   $date is just temporary for loading in the $vote data.
   Will need to kill $date in order to use same variable in upcoming foreach loop
   Ditto for $inv
*/
unset ($date); 
unset($inv);

$changed = false;  // Keep track of whether any votes are missing in database
// Fill in any non-existent votes 
foreach ($invitee as $i=>$inv) {
   $vote_line = file_get_contents('wccw_poll_2_middle_wrapper.htm');
   $vote_line=str_replace('##INVITEE##', get_member_name($inv['id']), $vote_line);
   $com = trim($inv['comments']);
   $com = strlen($com)<1 ? ' ' : $com;  //Make sure $com is at least 1 character log
   $vote_line=str_replace('##COMMENTS##', $com,$vote_line);

   $VOTE_TD = file_get_contents('wccw_poll_2_middle_vote.htm');
   $VOTE_TD = str_replace('##USER_ID##', $inv['id'], $VOTE_TD);

   $all_votes=''; //This will collect the $vote_td details for every date
   foreach($dates as $d=>$date){
      $vote_td=$VOTE_TD;
      if(empty($vote[$inv['id']][$date])) {
         $vote[$inv['id']][$date]=null;  //Make sure a record exists for each invitee/date pair
         $changed = true;  // At least one newly created vote, so note the need to save later.
      }

   $votes = str_replace('##YNM##', $vote[$inv['id']][$date], $vote_td);
   $votes = str_replace('##DATE##', $date, $votes);
   $all_votes .= $votes;
   } 
   $vote_line = str_replace('##VOTES##', $all_votes, $vote_line);
pre_dump('vote_line',"<textarea>$vote_line</textarea>");
   $page .= $vote_line;
}

$page .= file_get_contents('wccw_poll_3_bottom.htm');

echo $page;
die();








//echo file_get_contents('wccw_poll_2_middle_wrapper.htm');
//echo file_get_contents('wccw_poll_3_bottom.htm');


$Q2 = "SELECT invitee_id, wccw_invitees.comments, concat(first_name,' ', last_name) as member_name 
         FROM wccw_invitees, members 
         where event_ptr=$event_id
         AND member_id=invitee_id";
pre_dump('Q2', $Q2);
$Q3 = "SELECT invitee_id, wccw_ynm.event_ptr, ynm_date_id
         FROM wccw_ynm, wccw_invitees 
         WHERE wccw_ynm.event_ptr=$event_id
         AND wccw_ynm.event_ptr = wccw_invitees.event_ptr
         AND ynm_member_id=invitee_id;";
pre_dump('Q3', $Q3);


echo $page;
die();

identifier_comment('PART 1 - Retrieve event_id from $_REQUEST.<br>File: ' . __FILE__ . ' Line: ' . __LINE__);
$event_id = $_REQUEST['event_id'];
$page = str_replace("##EVENT_ID##", $event_id, $page);

identifier_comment('Part 2 - Load event from database.<br>File: ' . __FILE__ . ' Line: ' . __LINE__);
$wccw = new Wccw;
$wccw->load_event($event_id);
//pre_dump('WCCW object', $wccw);
//$page = str_replace('####',$wccw->,$page);
$page = str_replace('##TITLE##', $wccw->title, $page);
$page = str_replace('##TITLE##', $wccw->title, $page);
$page = str_replace('##DETAILS##',$wccw->details,$page);
$page = str_replace('##ORGANIZER##',$wccw->organizer_name,$page);

identifier_comment('3. Get member_id from $_SESSION.<br>File: ' . __FILE__ . ' Line: ' . __LINE__);
$memid = $_SESSION['member_id'];

// This next step may not be necessary
identifier_comment('4 - Determine if user is an invitee; Save in $pollable<br>File: ' . __FILE__ . ' Line: ' . __LINE__);
$pollable = $wccw->is_invited($_SESSION['member_id']);

identifier_comment('5. Display list of dates<br>File: ' . __FILE__ . ' Line: ' . __LINE__);
$dates = explode(",",$wccw->date_list);
/*
identifier_comment('7. retrieve any previous votes<br>File: ' . __FILE__ . ' Line: ' . __LINE__);
identifier_comment('8. Implement the voting buttons<br>File: ' . __FILE__ . ' Line: ' . __LINE__0);
identifier_comment('9. tally votes<br>File: ' . __FILE__ . ' Line: ' . __LINE__);
identifier_comment('10. Identify non-repondents<br>File: ' . __FILE__ . ' Line: ' . __LINE__);
*/

echo $page;
function wccw_poll()
{
   return;
}