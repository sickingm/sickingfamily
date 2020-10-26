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

require_once "../events/events_table_header.php";

echo "<div align='center'>";
$second_message = 
			"<font size='3'>
			\nClick <a href='../events/events.php'><b>here</b></a> to add a new event to the list.
			\n</font>";
			
event_table_header("Upcoming Events....",$second_message);

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

while ($row=mysqli_fetch_array($result,MYSQL_ASSOC))
{
	if($row["time"]=="12:00AM")$row["time"]="&nbsp;"; //check for null time values
	
	$obsolete=($row["date2"]<date("Ymd")); // Check if date is in the past
	if($obsolete) // Delete obsolete events
	{
		$qdel="DELETE FROM events WHERE event_id='{$row['event_id']}'";
	$qdresult=do_query($qdel);
       
	$qdel="DELETE FROM wbw WHERE event_ptr='{$row['event_id']}'";
	$qdresult=do_query($qdel);
       
 
}
	else // Print out the ones that are not obsolete
	{
		if(	empty($_SESSION['authenticated']) 		||
			empty($_SESSION['userid']) 				||
			$_SESSION['userid']!=$row['posted_by'])  
		{$href = "";}
		else
		{
			$href = "events/add_or_edit_events.php?id={$row['event_id']}";
			$hrefs=TRUE;  //At least one editable event, so set flag TRUE
		}
		$editable=!(empty($_SESSION['authenticated']) || empty($_SESSION['userid']) 
					|| $_SESSION['userid']!=$row['posted_by']);
		 //output uneditable data if row was not posted by user
			echo "<tr>";
				$wbw_ptr="<br>
							<p align='center' style='margin-top: 0; margin-bottom: 0'>
							<a href='../wbw/_wbw.php?wbw_event_ptr={$row['event_id']}'>
							<i>Who's bringing what?</i></a>";
				do_row($row["event"],$href, "left",$wbw_ptr);
				do_row($row["day"]."<br>".$row["date1"],"", "left", "nowrap");
				do_row($row["time"],"", "center");
				do_row($row["venue"],"", "left");
				do_row($row["comments"],"", "left");
				do_row($row["posted_by"],$href, "center");
			echo "</tr>";
	}	
}
echo '</table>';
if ($hrefs)echo "Click a highlighted event to edit it.<br>";
echo '</div>';

function do_row($item, $href, $align, $extra_data="")
{
	// creates an element in a table row with or without a hyperlink to edit events. 
	//
	// Parameters:
	//	$item - data element to be output
	//	$href - straight data if empty, hyperlink if non empty
	//	$align - left/right/center horizontal alignment
	if($extra_data=="nowrap")
		{ 
			$extra="";
			$nw="nowrap";
		}
		else
		{
			$extra=$extra_data;
			$nw="";
		}

	$l=strlen(trim($item));
	$tval = $l<1 ? "&nbsp;" : $item; // Make sure it's not a zero length string.
	if (empty($href)) {echo "<td $nw class='event-list' align='$align'>$tval $extra</td>\n";}
	             else {echo "<td $nw class='event-list' align='$align'><a href = '$href'>$tval</a> $extra_data</td>\n";}
}
?>