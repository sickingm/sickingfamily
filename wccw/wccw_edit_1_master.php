<?php identifier_comment("BEGIN " . __FILE__ . " Line # " . __LINE__ . " FUNCTION: " . __FUNCTION__); ?>

<script>
	//##DROPDOWN_PICKED##
</script>

<div align='center' id='top'>
	<h1>Create New Event</h1>
	<form method='POST' name='new_event' action='_wccw.php?cmd=edit' id='input_form'>
		<input type='hidden' id='event_id' name='event_id' value='##EVENT_ID##'>
		<input type='submit' value='Save Event' name='save_event'>
		<input type='reset' value='Reset'>
		<table class='rowtable'>
			<tr>
				<th>Organizer:</th>
				<td class='wccw-new-organizer inactive'>##ORGANIZER_NAME##</td>
			</tr>
			<tr>
				<th>Event Title (##EVENT_ID##):</th>
				<td><input class='wccw-new-title' type='text' name='title' required value='##TITLE##' placeholder='Enter Event Title'></td>
			</tr>
			<tr>
				<th>Details:</th>
				<td><textarea class='wccw-new-details' rows='2' name='details'>##DETAILS##</textarea></td>
			</tr>
			<tr class='wccw-new-private'>
				<th>Private:</th>
				<td><input type='checkbox' name='private' id='private' value='ON' ##PRIVATE_CHECKED##>
					<label for='private'>(Event will be viewable only by invitees)</label>
				</td>
			</tr>
			<tr class='wccw-new-invitee-group'>
				<th>Select Invitees from:</th>
				<td>
					<input type='radio' value='all' id='all' name='invitee_group' onchange='this.form.submit()' ##SELECT_ALL## />
					<label for='all'> All</label>
					<input type='radio' value='dbc' id='dbc' name='invitee_group' onchange='this.form.submit()' ##SELECT_DBC## />
					<label for='dbc'> DBC</label>
					<input type='radio' value='gen3' id='gen3' name='invitee_group' onchange='this.form.submit()' ##SELECT_GEN3## />
					<label for='gen3'> Gen3</label>
					<input type='radio' value='family_heads' id='family_heads' name='invitee_group' onchange='this.form.submit()' ##SELECT_FAMILY_HEADS## />
					<label for=family_heads> Family Heads</label>
					<br>
					<input type='radio' value='family' id='select_family' name='invitee_group' ##SELECT_FAMILY## onfocus='dropdowns("family","clan");' />
					<label for=select_family>Family:</label>
					<select name='invitee_family' id='invitee_family' onchange='this.form.submit();' class='##FAMILY_INITIAL_CLASS##'>
						<option disabled selected>Pick a family to choose from</option>
						##FAMILY_OPTIONS##
					</select>

					<br>
					<input type='radio' value='clan' id='select_clan' name='invitee_group' ##SELECT_CLAN## onfocus='dropdowns("clan","family");' />
					<label for=select_clan>Clan:</label>
					<select name='invitee_clan' id='invitee_clan' onchange='this.form.submit();' class='##CLAN_INITIAL_CLASS##'>
						<option disabled selected>Pick a clan to choose from</option>
						##CLAN_OPTIONS##
					</select>
					<br>

				</td>
			</tr>
			<tr>
				<th>Invitees:</th>
				<td>
					##INVITEES##
				</td>
			</tr>
			<tr class='wccw-new-dates'>
				<th>Proposed Dates:</th>
				<td>
					<textarea id='multi999Picker' name='dates' style='width:100%' placeholder='Click here to select dates'></textarea>
				</td>
			</tr>
		</table>
		<input type='submit' value='Save Event' name='save_event'>
		<input type='reset' value='Reset' name='reset'>
	</form>
		<button onclick="window.location.href='_wccw.php'">Cancel</button>

	<div class='wccw-new-instructions inactive' id='instructions'>
		<h3>To add a new event:</h3>
		<ol>
			<li>
				Enter the <span class='wccw-new-instruction-highlight'>Event Description</span> in the text area above.
			</li>
			<li>
				Check the <span class='wccw-new-instruction-highlight'>Private</span> check box if you wish to
				keep this event from being viewed by non-invitees.
				(This would be useful for, say, planning a surprise party.)
			</li>
			<li>The Events application starts with the assumption that you wish to invite only the
				DBC (Ollie and Jinny&#39;s children plus their spouses). If you wish to select invitees from a different
				group, indicate that group in the <span class='wccw-new-instruction-highlight'>Select invitees from</span>
				section and click on the <span class='wccw-new-instruction-highlight'>Update Invitees</span> button.
				<br />E.g.: To schedule an event for all of the married grandchildren use the
				<span class='wccw-new-instruction-highlight'>Family Heads</span> group and check only the grandchildren in that group.
				<br>To schedule an event for only Nancy &amp; Fred&#39;s descendant, use the
				<span class='wccw-new-instruction-highlight'>Members of the Fred &amp; Nancy Lloyd Clan</span> option.
			</li>
			<li>
				Check the names of all invitees to the event
			</li>
			<li>
				Select all of the dates that you wish to be considered for this event in<br>
				the pop-up calendar, or type them in manually separated by semicolons.
			</li>
			<li>
				Click the <span class='wccw-new-instruction-highlight'>Save Event</span> button.
			</li>
		</ol>

		<p><a href='#top'>Back to Top</a></p>
	</div>
</div>

<!-- END wccw_new_.php ++++++++++++++++++++++++++++++++++++++++++ -->