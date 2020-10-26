<?php
    identifier_comment("BEGIN ".__FILE__);
    function dbc_line_item($text,$val){
        echo "<tr class='dbc-mtg-info'><td >$text:<td>$val</td></tr>";
    }
    require_once ('../dbc_constants.inc');
?>

<div>
    <table >
        <tr>
            <td colspan="2" >
            <img src="../images/dbc_logo.jpg" alt='logo' style='height: 4em;' />
        </tr>
        <tr>
            <td colspan="2"  >
            <?php echo "Next Meeting (#".$DBC['number'].")";?>
            </td>
        </tr>
<?php        
    if($DBC['date']=="TBD"){
        $dbc_day="TBD";
    } else {
        $meeting_date= new DateTime($DBC['date']);
        $dbc_day = date_format($meeting_date,"l");
    }

    dbc_line_item("Day", $dbc_day);
    dbc_line_item("Date",$DBC['date']);
    dbc_line_item("Time",$DBC['time']);
    dbc_line_item("Venue",$DBC['venue']);
    dbc_line_item("Contact",$DBC['organizer']);
?>
	</table>
</div>

<?php
    identifier_comment("END ".__FILE__);
?>