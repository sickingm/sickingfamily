<?php 

ob_flush();
ob_start();

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

require_once("wccw_class.php");
extract($_REQUEST);
if (isset($event_id)) require('wccw_process_poll_data.php');
else $event_id = -1;

$my_event = new WCCW();
$my_event->load($event_id); // Load existing event data. 

$scores = array(
    'Y' => 1,   'y' => 1,
    'N' => 0,   'n' => 0,
    'M' => 0.5, 'm' => 0.5,
    ' ' => 0, '?' => 0
);
?>

<h1>Who can come when?</h1>
<?php
echo <<<HEADING
    Event {$my_event->event_id}: <span style='font-size:1.4em;font-weight: bold;'>{$my_event->title}</span>\n
    <br>
    <div style='margin:auto; font-style: italic; max-width:28em; font-weight: bold;' >$my_event->details</div>
<div class='response-container'>
    <form class='ynm_form' method='post' id='ynm_form' >
    <input type='hidden' name='event_id' value='$event_id'>
        <table id='poll'>
            <thead><tr>
                <th>Invitee</th>

HEADING;

foreach ($my_event->dates as $date) {
    $score[$date] = 0;
    echo '<th>' . little_date($date) . '</th>';
    foreach ($my_event->invitees as $uid => $user_name) {
        if (isset($my_event->ynm[$uid][$date])) $score[$date] += $scores[$my_event->ynm[$uid][$date]];
        else $my_event->ynm[$uid][$date] = '?';
    }
}
$high_score = max($score);
?>

<th>Comments</th>
</tr>
</thead>
<tbody>

    <?php

    foreach ($my_event->invitees as $uid => $user_name) {
        echo "<tr>
                    <th>$uid $user_name<input type='hidden' id='changed[$uid]' name='changed[$uid]'></th>";
        foreach ($my_event->dates as $date) {
            $ynm = $my_event->ynm[$uid][$date];
            $ynmformat = $ynm == '?' ? "X" : $ynm;
            if($_SESSION['member_id']==$my_event->organizer_ptr OR has_privilege($uid))
                $disabled = "";
                else $disabled = 'disabled';

            $ynm_td_fmt = $score[$date] == $high_score ? "wccw-ynm-td-high" : "wccw-ynm-td";
            echo <<<POLL
                            <td class='$ynm_td_fmt'>
                                <input 
                                    class='circle $ynmformat'
                                    type='text' 
                                    name='ynm[$uid][$date]' 
                                    id='ynm[$uid][$date]'  
                                    $disabled
                                    value='$ynm'
                                    maxlength='1' 
                                    onclick='cycle(this); note_change("changed[$uid]");'
                                ></td>
                        POLL;
        }
        $cmts =slash_it($my_event->comments[$uid]);
d($my_event->comments[$uid]);
d($cmts);
        echo <<<COMMENTS
                        <td style='text-align:left; padding:0'>
                            <input 
                                type='text' 
                                name='comments[$uid]' 
                                id='comments[$uid]' 
                                    $disabled
                                value='{$cmts}'
                                size='45'
                                onblur='note_change("changed[$uid]");'
                            >
                        </td>
                        </tr>
                    COMMENTS;
    }
    echo "\n<tr><th>SCORE</th>";
    foreach ($my_event->dates as $date) {
        $score_fmt = $score[$date] == $high_score ? "wccw-ynm-high-score" : "wccw-ynm-score";
        echo "\n<td class='$score_fmt'>" . number_format($score[$date], 1) . '</td>';
    }
    echo "\n<td>Maximum Score is $high_score </td></tr>";
    ?>
</tbody>
</table>
<input type='submit' value='Submit' name='submitForm'>
<button type='button' onclick="window.location.replace('_wccw.php');">Return to List</button>

</script>
</form>
</div> <!-- Close response-container-->

</body>

</html>
<?php
function little_date($str_date)
{
    return (date('D', strtotime($str_date)) . '<br>' . date('M j', strtotime($str_date)));
}
function wccw_poll()
{
    return;
}
