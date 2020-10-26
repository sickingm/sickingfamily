<?php
////////////////////////////////////////////////////////////////////////////////
//
//  +----------------------+
//  ¦ _e v e n t s . p h p ¦
//  +----------------------+
//
//	NAME:	_events.php
//
//	CALLED BY:
//			home_page.htm
//
//	CALLS:	
//			connect_and_select (from /common/utility_functions.php)
//
//	INCLUDES:
//			<nothing>
//
//	CONTAINS:
//			<nothing>
//
//	USES STYLES:
//			master.css
//			<other>.css
//			
//	Description
//		Reads the events within the events table and outputs them in a table
//
 
identifier_comment("BEGIN ".__FILE__);
if(!isset($_SESSION['userid'])) $_SESSION['userid']=" ";
require "../events/event_template_1_top.htm";
require "../events/event_template_2_table_header.htm";

$second_message = 
			"Click <a href='../events/events.php'><b>here</b></a> to add a new event to the list.";

$editable=FALSE; // Will be set to TRUE iff any of the table items are editable
connect_and_select();

// ADD LOGIC TO DELETE OLD EVENTS
//  FORMAT the dates
//  Format the time and set 00:00:00 to ""
//  Print out all current events
$query='SELECT 
	event_id,
	DATE_FORMAT(date,"%W") as day, 
	DATE_FORMAT(date,"%M %e, %Y") as date1, 
	TIME_FORMAT(time,"%h:%i%p") as time, 
	event, venue, comments, posted_by,
	DATE_FORMAT(date,"%Y%m%d") as date2
	FROM events ORDER BY date2';
$result = mysqli_query($db_link,$query) or die(mysql_error());

$hrefs = FALSE;  // Flag to determine if any of the event rows are editable by current user

while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	if($row["time"]=="12:00AM")$row["time"]="&nbsp;"; //check for null time values
	
	$obsolete=($row["date2"]<date("Ymd")); // Check if date is in the past
    
    // Delete obsolete events
	if($obsolete){    
		$qdel="DELETE FROM events WHERE event_id='{$row['event_id']}'";
    	$qdresult=do_query($qdel); 
    	$qdel="DELETE FROM wbw WHERE event_ptr='{$row['event_id']}'";
    	$qdresult=do_query($qdel);
    }
	else {     // Print out the ones that are not obsolete
	
        if(	empty($_SESSION['authenticated']) || empty($_SESSION['userid']) || $_SESSION['userid']!=$row['posted_by'])  
            $href = "";
        else {
        	$href = "events/add_or_edit_events.php?id={$row['event_id']}";
        	$hrefs=TRUE;  //At least one editable event, so set flag TRUE
        }
		$editable=!(empty($_SESSION['authenticated']) || empty($_SESSION['userid']) 
					|| $_SESSION['userid']!=$row['posted_by']);
		 //output uneditable data if row was not posted by user
		$wbw_ptr="
            <br>
			<p style='margin-top: 0; margin-bottom: 0'>
			<a href='../wbw/_wbw.php?wbw_event_ptr={$row['event_id']}'>
			<i>Who's bringing what?</i></a>";
        echo <<<EVT
            <tr>
            <td class='ecol1'>{$row['event']}{$wbw_ptr}</td>\n   
            <td class='ecol2'>{$row['day']}<br />{$row['date1']} </td>\n
            <td class='ecol3'>{$row['time']}</td>\n   
            <td class='ecol4'>{$row['venue']}</td>\n   
            <td class='ecol5'>{$row['comments']}</td>\n   
            <td class='ecol6'><a href='$href'>{$row['posted_by']}</a></td>   
EVT;
    }	
}
echo "\n</table>";
if ($hrefs)echo "Click a highlighted event to edit it.<br>";


 identifier_comment("END ".__FILE__);
?>