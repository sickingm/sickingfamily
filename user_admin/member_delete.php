<?php
identifier_comment("START member_delete.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +----------------------------------+
//  � m e m b e r _ d e l e t e. p h p �
//  +----------------------------------+
//
//	NAME:	member_delete.php
//
//	CALLED BY:
//			XX
//
//	CALLS:
//		<none>
//
//	INCLUDES:
//		<none>
//
//	CONTAINS:
//		<none>
//
//	USES STYLES:
//		<none>
//			
//	Description
//		<none>
//	
////////////////////////////////////////////////////////////////////////////////
?>
<script>
function memberButtons() {
 	thisSelect = document.member_delete_form.member_delete;
 	choice = thisSelect.options[thisSelect.selectedIndex].text;
 	document.member_delete_form.member_delete_submit.value='Delete '+choice+"?";
	showElement('member_delete_buttons','inline'); // display submit button
}
</script>
<?php
// Get a list of all members and save in array
	$result = do_query("SELECT member_id, first_name, last_name FROM members WHERE family_ptr='$family'");
	if(mysqli_num_rows($result) == 0) return;
		echo "
			\n<form name='member_delete_form' method='POST' 
				action='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family'
				onReset=\"showElement('member_delete_buttons','none');\" 
				> 
				
			\nDelete a member:<br>
			
			\n<input type='hidden' name='clan' value='$clan'>
			\n<input type='hidden' name='family' value='$family'>
			\n<select size='1' name='member_delete' onChange='memberButtons();' >
			\n<option value='' selected disabled>---Select a Member to Delete</option>
		";
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo "\n<option value='{$row['member_id']}'>{$row['member_id']} - {$row['first_name']} {$row['last_name']}</option>";
		}
?>
	</select>
		<span id='member_delete_buttons' style='display:none'>
			<input type='submit' value='' id='member_delete_submit'>
			<input type='reset' value='Reset'>
		</span>
	<br>
	</form>
<?php
identifier_comment("END member_delete.php");