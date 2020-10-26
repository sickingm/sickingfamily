<?php
identifier_comment("BEGIN ".__FILE__. ' ***************************************************** ');
require_once "events_table_header.php";

extract($_POST);
if (isset($submit))
    include "events_update_fields.php";
$s = array(
    "30",
    "26",
    "7",
    "30",
    "30",
    "7"); // sizes of the six columns
$w = array(
    "25%",
    "25%",
    "",
    "25%",
    "25%",
    ""); // widths (same as size but with % appended)

// Need for type 1 (header) format has been obviated by use of the event_table_header subroutine

// format for type 2 printf statement (Input Boxes) or Type 2a (textarea)
$fmt2 = "\n" . "<td class='event-gray' width='%s'><input type='text' name='%s[%s]' size='%s' value='%s'></td>";
$fmt2a = "\n" . "<td class='event-gray' width='%s'><textarea name='%s[%s]' cols='%s' >%s</textarea>%s</td>";

// format for type 3 printf statement (static uneditable text)
$fmt3 = "\n" . '<td class="event-gray" width="%s"><font color="#0">%s</font>%s</td>';

// format for type 4 printf statement (empty input boxes) or Type 2a (empty textarea)
$fmt4 = "\n" . '<td class="event-gray" width="%s"><input type="text" name="%s" size="%s"></td>';
$fmt4a = "\n" . '<td class="event-gray" width="%s"><textarea name="%s" cols="%s"></textarea></td>';

echo "\n<p align='center'>\n<h1>Add or Edit Events</h1>";

connect_and_select();
require_once "events_table_header.php";

$query = 'SELECT 
		event_id,
		DATE_FORMAT(date,"%M %e, %Y") as date, 
		TIME_FORMAT(time,"%h:%i%p") as time, 
		event, venue, comments, posted_by,
		DATE_FORMAT(date,"%Y%m%d") as date2
		FROM events ORDER BY date2';
$result = do_query($query);


echo <<<TXT
<body topmargin='1'>
<div align='center'>
<form method='post' action='{$_SERVER['PHP_SELF']}'>;
TXT;

//table headers
event_table_header("Edit Upcoming Events...");

while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
    echo '<tr>';
    if (($row["posted_by"] == $_SESSION["userid"]) || $_SESSION["userid"] === "Matt")
    {
        printf($fmt2a,$w[0],'edit_event',$row['event_id'],$s[0],htmlentities($row['event']),
            "<br><a href='../wbw/_wbw.php?wbw_event_ptr={$row['event_id']}'>Who's bringing what </a>");
        printf($fmt2,$w[1],"edit_date",$row["event_id"],$s[1],$row["date"],'');
        printf($fmt2,$w[2],"edit_time",$row["event_id"],$s[2],$row["time"],'');
        printf($fmt2a,$w[3],"edit_venue",$row["event_id"],$s[3],htmlentities($row["venue"]),
            '');
        printf($fmt2a,$w[4],"edit_comments",$row["event_id"],$s[4],htmlentities($row["comments"]),
            '');
        printf($fmt3,$w[5],$row["posted_by"],'');
        echo "\n\n";
    }
    else
    {
        printf($fmt3,$w[0],htmlentities($row["event"]),
            "<br><a href='../wbw/_wbw.php?wbw_event_ptr={$row['event_id']}'>Who's bringing what </a>");
        printf($fmt3,$w[1],$row["date"],'');
        printf($fmt3,$w[2],$row["time"],'');
        printf($fmt3,$w[3],htmlentities($row["venue"]),'&nbsp;');
        printf($fmt3,$w[4],htmlentities($row["comments"]),'&nbsp;');
        printf($fmt3,$w[5],$row["posted_by"],'');
        echo "\n\n";
    }
    echo '</tr>';
}

?>
	</table>
		<br><input type="submit" value="Submit" name="submit" width ="90%">	

<?php

event_table_header("Add A New Event...");

echo '<tr>';
printf($fmt4a,$w[0],"new_event",$s[0]);
printf($fmt4,$w[1],"new_date",$s[1]);
printf($fmt4,$w[2],"new_time",$s[2]);
printf($fmt4,$w[3],"new_venue",$s[3]);
printf($fmt4a,$w[4],"new_comments",$s[4]);
printf($fmt3,$w[5],$_SESSION["userid"],"");
echo "\n\n";

?>
	</tr>
	</table>
	<br><input type="submit" value="Submit" name="submit">
	<br><br><input type="reset" value="Reset" name="reset">

</form>
 
</div>

<?php identifier_comment("END " . __FILE__ . ' ***************************************************** '); ?>
</body>
</html>
