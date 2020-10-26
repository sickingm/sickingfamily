<?php
identifier_comment ("BEGIN ".__FILE__. "Line #".__LINE__."    Function: (" .__FUNCTION__ . ")");
//  This function displays the entire list of open events (except for private 
//	events to which the user is not invited), along with all pertinent info 
//	regarding the events: Details, list of suggested dates, list of 
//	invitees, and the 'scores' that each date currently has.
//	Also, if the user is the organizer of the event, it shows the edit and 
//	delete options

function wccw_list($dummy='') { // Lists all events
html_comment('LINE ' . __LINE__ . ' in '. __FILE__.' (FUNCTION '.__FUNCTION__ . ')' );

db_echo('$_SESSION',$_SESSION);

    $middle = file_get_contents("wccw_list_2_middle.php");
    $bottom = file_get_contents("wccw_list_3_bottom.php");

    // Get a list of all the events
    $result = do_query("
        SELECT event_id, title, details, organizer_ptr, is_private, 
            first_name, last_name, edit_privilege, userid, member_id
            FROM wccw_events, members WHERE organizer_ptr=member_id
    ", "Get all events");
$number_of_events = 0;
html_comment('LINE ' . __LINE__ . ' in '. __FILE__.' (FUNCTION '.__FUNCTION__ . ')' );
    $first = TRUE;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        extract ($row);
        if (ok_to_display_private($row['is_private'], $row['event_id'])) {
            If($first) echo file_get_contents("wccw_list_1_top.php");
            $first=FALSE;
            $middle_row = str_replace('##TITLE##', $title, $middle);  // NOTE the "$middle" here, not "$middle_row"
            $middle_row = str_replace('##EVENT_PTR##', $row['event_id'], $middle_row);
            $middle_row = str_replace('##DETAILS##', $details, $middle_row);
            $middle_row = str_replace('##ORGANIZER##', $row['userid'], $middle_row);

// will create "display:none" or "display:block"
            if($_SESSION['member_id'] == $row['organizer_ptr'] OR $_SESSION['edit_privilege']=='all')
                $middle_row = str_replace('##IS_ORGANIZER##', 'inline', $middle_row);
            else $middle_row = str_replace('##IS_ORGANIZER##', 'none', $middle_row);


            $middle_row = str_replace('##PRIVACY##', $is_private=='private' ? '(private)' : '', $middle_row);
            $middle_row = str_replace('##DATES##',get_dates($row['event_id']), $middle_row);
            $middle_row = str_replace('##INVITEES##',get_invitees($row['event_id']),$middle_row);
            
            echo $middle_row;
        }
    }
    if($first)  echo file_get_contents('wccw_list_0_empty.php');  // No events so show blank page
    else echo $bottom; // At least one event so add the stuff on the bottom of the page

    html_comment('LINE ' . __LINE__ . ' in ' . __FILE__ . ' (FUNCTION ' . __FUNCTION__ . ')');
}
    
////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_dates($event_id)
// Lists a table of the proposed dates including:
//	Day of week
//	Date in mm/dd form
//	Current score
{
html_comment('LINE ' . __LINE__ . ' in '. __FILE__.' (FUNCTION '.__FUNCTION__ . ')' );
    // debug_on();
    // Get all ynm's for every date.  
    // Must use LEFT JOIN in order to get those dates with no ynm defined yet.

    $Q= 
    "SELECT 
        DATE_FORMAT(date,'%Y-%m-%d') AS DATE, 
        DATE_FORMAT(date,'%a') AS date_day, 
        DATE_FORMAT(date,'%c/%e') AS date_small, 
        SUM(CASE ynm WHEN 'Y' THEN 1 WHEN 'M' THEN 0.5 ELSE 0 END ) AS score 
    FROM wccw_dates 
    LEFT JOIN wccw_ynm 
        ON date = ynm_date_id 
    WHERE wccw_dates.event_ptr='$event_id' 
    GROUP BY wccw_dates.date 
    ORDER BY wccw_dates.date ";

    //echo $Q;
    $date_result = do_query($Q,"Get YMN's for Event $event_id");

    // 
    $sub = 0; // subscript for these rows
    while ($date_row = mysqli_fetch_array($date_result, MYSQLI_ASSOC)) {
        $s = $date_row["score"];
        $sfloor=(int)floor($s);
        $s2 = ($s == $sfloor) ? (string)$sfloor : (string)$sfloor.'½';
        if($s2 == '0½')$s2= '½';
        $score[$sub]=$s2;
        $date_day[$sub] = $date_row["date_day"];
        $date_small[$sub] = $date_row["date_small"];
        $sub++;
    }

    if(empty($date_small))return "";  // In case no dates have yet been defined

    $date_result="<table><tr>\n";
    foreach ($date_small as $d => $dd) {
        $date_result .= "<td class='wccw-list-dates'>{$date_day[$d]}<br />$dd<br />({$score[$d]})</td>\n";
    }
    $date_result .= "</tr>\n</table>";
    return $date_result;
html_comment('LINE ' . __LINE__ . ' in '. __FILE__.' (FUNCTION '.__FUNCTION__ . ')' );
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_invitees($event_id) {
html_comment('LINE ' . __LINE__ . ' in '. __FILE__.' (FUNCTION '.__FUNCTION__ . ')' );
    $max_col = 5;
    $col = 0; 
    $invitee_list = '';

    $rslt = do_query(
        "SELECT userid 
         FROM wccw_invitees, members 
         WHERE event_ptr ='$event_id' and members.member_id=wccw_invitees.invitee_id"
         ,"Get the invitees for Event $event_id"
    );

    while ($row = mysqli_fetch_array($rslt, MYSQLI_ASSOC)) {
        if (++$col > $max_col) {
            $invitee_list .= "</tr><tr>";
            $col = 1;
        }
        $invitee_list .= "<td>{$row['userid']}</td>";
    }
html_comment('LINE ' . __LINE__ . ' in '. __FILE__.' (FUNCTION '.__FUNCTION__ . ')' );
    return "<table class='invitees'>\n<tr>\n".$invitee_list."\n</tr>\n</table>";


}

////////////////////////////////////////////////////////////////////////////////////////////////////////
function ok_to_display_private($private, $event_id) {
html_comment('LINE ' . __LINE__ . ' in '. __FILE__.' (FUNCTION '.__FUNCTION__ . ')' );

    // If the event is not private, or if the user has "all" privilege, don't worry about access

    if ($private != "private" OR $_SESSION['edit_privilege'] == 'all')  return TRUE;

    // Event is private, so find out if the current user 
    // (specified in the $_SESSION['member_id'] variable) 
    // is an invitee of the event.

    $private_result = do_query("SELECT * FROM wccw_invitees, wccw_events 
        WHERE event_ptr='$event_id'	
        AND event_id=event_ptr
        AND (invitee_id='{$_SESSION['member_id']}' 
        OR organizer_ptr = '{$_SESSION['member_id']}')"
        , "Get OK to display from organizer"        
    );

    return (mysqli_num_rows($private_result) > 0); // If there is an invitation to the user
html_comment('LINE ' . __LINE__ . ' in '. __FILE__.' (FUNCTION '.__FUNCTION__ . ')' );
}