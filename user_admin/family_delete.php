<?php
identifier_comment("START family_delete.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +----------------------------------+
//  � f a m i l y _ d e l e t e. p h p �
//  +----------------------------------+
//
//	NAME:	family_delete.php
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
function familyButtons() {
 	thisSelect = document.family_delete_form.family_delete;
 	choice = thisSelect.options[thisSelect.selectedIndex].text;
 	document.family_delete_form.family_delete_submit.value='Delete '+choice+"?";
	showElement('family_delete_buttons','inline'); // display submit button
}
</script>
<?php
// Get a list of all families in current clan and save in array
	$result = do_query("
		SELECT family_id, family_name, clan_name 
			FROM families, clans  
			WHERE clan_ptr=clan_id 
			AND clan_ptr=$clan");

    $nf = mysqli_num_rows($result);
    echo "$nf families in \"$clan_name\" clan.";

// But only if there are no members that belong to the family	
	
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<br />The \"{$row['family_name']}\" Family has ";
		$possible_family_to_delete = $row["family_id"];
		$result2 = do_query("
			SELECT * FROM families, members
				WHERE family_id='$possible_family_to_delete'
				AND members.family_ptr = families.family_id
				");
        $nm = mysqli_num_rows($result2);
        echo "$nm members.";
		if($nm==0) // 0 rows indicates an empty family (contains no members)
			$families_to_delete[$possible_family_to_delete] = $row["family_name"]; // save family id and name in array
		}
	
	if(empty($families_to_delete))return;// No families in list, so return
	
	echo "\n<form name='family_delete_form' method='POST' 
		action='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family'
		onReset=\"showElement('family_delete_buttons','none');\" >
			
		\nDelete a family:<br>
		
		\n<input type='hidden' name='clan' value='$clan'>
		\n<select size='1' name='family_delete' onChange='familyButtons();' >
			\n<option value='' selected disabled>---DELETE a Family:</option>";
				
	foreach ($families_to_delete as $fid => $fname) {
		echo "\n<option value='$fid'>$fid - $fname</option>";
	}
echo <<<OUT
	</select>
    <span id='family_delete_buttons' style='display:none'>
    	<input type='submit' value='' id='family_delete_submit'>
    	<input type='reset' value='Reset'>
    </span>
    <br />
    <span style='font-size:0.8em; color:red;'>
        Note: Only families containing no members may be deleted.
    </span>
	</form>
OUT;

identifier_comment("END family_delete.php");