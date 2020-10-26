<?php identifier_comment("BEGIN ".__FILE__); 
?>

	<table class="dbc">
		<tr class="dbc">
        <th style="background:none">
            <a href="../dbc/dbc.php">DBC</a>&nbsp;&nbsp;
        </th>
			<td class='card'>
			<?php
                if($DBC['date']=="TBD") {
                    printf("No DBC meeting currently scheduled.");
                } ELSE {
                    $today=strtotime("today");
                    $meeting_date= strtotime($DBC['date']);
                    if($meeting_date < $today) {
                    printf("No DBC meeting currently scheduled.");
                    } Else {
                    printf("Meeting #%s will be held at %s<br>on %s<br>at %s<br> See %s for details",                			
                        $DBC['number'], 
                        $DBC['time']=="TBD" ? "TBD": date('ga',strtotime($DBC['time'])), 
                        $DBC['date']=="TBD" ? "TBD" : date('l, F j, Y', strtotime($DBC['date'])),
                        $DBC['venue'], 
                        $DBC['organizer']);    
                    }
                }

			?>
			</td>
		</tr>
	</table>
<?php identifier_comment("END ".__FILE__); ?>