<?php
identifier_comment("START clan_delete.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +------------------------------+
//  � c l a n _ d e l e t e. p h p �
//  +------------------------------+
//
//	NAME:	clan_delete.php
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
function clanButtons() {
 	thisSelect = document.clan_delete_form.clan_delete;
 	choice = thisSelect.options[thisSelect.selectedIndex].text;
 	document.clan_delete_form.clan_delete_submit.value='Delete '+choice+"?";
	showElement('clan_delete_buttons','inline'); // display submit button
}
</script>
<?php
// Get a list of all clans and save in array
	$result = do_query("SELECT clan_id, clan_name FROM clans");

// But only if there are no families that belong to the clan		
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$possible_clan_to_delete = $row["clan_id"];
		$result2 = do_query("
			SELECT * FROM clans, families 
				WHERE clan_id='$possible_clan_to_delete'
				AND families.clan_ptr = clans.clan_id
				");
		if(mysqli_num_rows($result2) == 0) // 0 rows indicates an empty clan (contains no families)
			$clans_to_delete[$possible_clan_to_delete] = $row["clan_name"]; // save clan id and name in array
	}
	if(!empty($clans_to_delete)) {
		echo "\n
<form name='clan_delete_form' method='POST' 
	action='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family'
	onReset=\"showElement('clan_delete_buttons','none');\" >
    <label for='clan-delete'>Delete Clan<br /></label>
	<select size='1' name='clan_delete' id='clan-delete' onChange='clanButtons();' >
	<option value='' disabled selected>Select a Clan</option>";
		foreach ($clans_to_delete as $cid => $cname) {
			echo "\n<option value='$cid'>$cid - $cname</option>";
		}
echo <<<OUT
    </select>
    </td>
    <td>
    	<span id='clan_delete_buttons' style='display:none'>
	       <input type='submit' value='' id='clan_delete_submit'><input type='reset' value='Reset'>
    	</span>
     </td>	
    </tr><tr>
        <td colspan=2>&nbsp;</td>
        <td colspan=2><span style='display:inline-block; font-size:0.8em; color:red; font-weight:bold; line-height:1'>
        Note: Only empty clans may be deleted.&nbsp;</span>
</form>

OUT;
	}
identifier_comment("END clan_delete.php");