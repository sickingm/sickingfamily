<?php
    identifier_comment("BEGIN ".__FILE__);
    function dbc_line_item($text,$val){
           
        echo <<<EOD
		<tr>
			<td align="right" width="23%">
			<p align="center"><b>
			<font color="#666666" size="0.25em">$text:</font></b></td>
			<td width="160" >
			<p align="center"><font color="#336633">$val</font></td>
		</tr>
EOD;
    }
?>

<div align="center">
    <table  cellspacing="1">
        <tr>
            <td colspan="2" >            <br />XXXX
            <p align="center">
            <img border="0" src="../images/dbc_logo.jpg"  height="55px" />
        </tr>
        <tr>
            <td colspan="2"  >
            <?php echo "Next Meeting (#".$DBC['number'].")";?>

            </td>
        </tr>
<?php        
    if(DBC_DATE=="TBD"){
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

		</tr>
	</table>
</div>
</html>

<?php



    identifier_comment("END ".__FILE__);
?>