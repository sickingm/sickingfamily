<?php
identifier_comment("BEGIN " . __FILE__ . ' ***************************************************** ');
function event_table_header($title,$second_message="&nbsp;")
{
	identifier_comment("BEGIN " . __FILE__ ." Line # " . __LINE__ . " FUNCTION: ". __FUNCTION__);
?>
<table class="event-table" border="1" width ="90%">

	<caption class="event-caption">
		<Table borders=0 width=100% style='background-image: url("../images/sickingfamily.jpg");'>
			<tr>
				<td >
					<p align="left"><b><?php echo $title;?></b></p>
				</td>
				<td>
					<p align="right"><?php echo $second_message;?></p>
				</td>
			</tr>
		</Table>
	</caption>

	<tr>
		<th class="event-header" width="25%">Event</th>
		<th class="event-header" width="10%">Date</th>
		<th class="event-header" width="8%">Time</th>
		<th class="event-header" width="25%">Location</th>
		<th class="event-header" width="25%">Comments</th>
		<th class="event-header" width="7%">Posted&nbsp;By</th>
	</tr>
<?php
	identifier_comment("END " . __FILE__ . " Line # " . __LINE__ . " FUNCTION: " . __FUNCTION__);
return;
}
identifier_comment("END " . __FILE__ . " Line # " . __LINE__ . " FUNCTION: " . __FUNCTION__);
?>