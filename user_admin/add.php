<?php

////////////////////////////////////////////////////////////////////////////////
//
//  +--------------+
//  ¦ a d d. p h p ¦
//  +--------------+
//
//	NAME:	add.php
//
//	CALLED BY:
//		clan_add.php
//		family_add.php
//		member_add.php
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
//		Performs the "add clan", "add family" and add member" function depending on input
//
//	$acf can be any of "clan", "family", "member"
//	
////////////////////////////////////////////////////////////////////////////////
 

function add($acf) {  
identifier_comment("START add.php ($acf)");
global $clan, $family;

// $acf can be either "admin", 'clan", or "family"

$uacf = ucfirst($acf); // Capitalize it for user prompt
echo "
	<form name='{$acf}_add_form' 
			method='POST' 
			action='{$_SERVER['PHP_SELF']}?admin=edit_clan_and_family'
			onReset=\"showElement('{$acf}_add_buttons','none');\">
		Add a new {$uacf}:<br />
		<input 
			type='text' 
			name='new_{$acf}' 
			size='32' 
			onKeyDown=\"showElement('{$acf}_add_buttons', 'inline');\">";

if ($acf == "family" OR $acf=="member") echo "<input type='hidden' name='clan' value='$clan'>";
if ($acf == "member") echo "<input type='hidden' name='family' value='$family'>";

echo "
		<span id='{$acf}_add_buttons' style='display:none'>
			<input type='submit' value='Submit'>
			<input type='reset' value='Reset'>
		</span>
	</form>
"; 
identifier_comment("END add.php ($acf)");
}