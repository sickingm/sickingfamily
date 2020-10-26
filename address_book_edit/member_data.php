<!--****************************************************************************
			START	member_data.php
-->
<?php
//
//	NAME:	member_data.php
//
//	CALLED BY:
//			address_book_edit_main.php
//
//	CALLS:
//			../../common/utility_functions.php
//
//	DESCRIPTION:
//		Outputs the basic data (name, address, etc.) of the specified member ($who)

require_once("ui.php");

db_text(__FILE__); // show where I am

echo "<form id= 'edit_request' method='POST' action='_address_book_edit.php?who={$who}&do_update=1'>";

// display Submit and Reset buttons or else message indicating that user
// does not have permission
edit_submit_button($allowed_to_edit);

// Build table of user data
echo '
<table border="1" id="table1" bgcolor="#E6FFFF">';

//Always just display ID, don't allow editing
show_data("text", "no", "ID", "userid", $who);

// Can't change clan -- it's a function of family
show_data("text", "no", "Clan", "clan_id", sprintf(" %s - %s\n", $clan_ptr, get_clan_name($clan_ptr)));

// Display or offer for edit the family name, depending on privilege
// read in data from families table
$query = "SELECT * FROM families";
if ($allowed_to_edit == "clan") $query .= " WHERE clan_ptr='$clan_ptr'";
elseif (!$allowed_to_edit_clan) $query .= " WHERE family_id='$family_ptr'";
$result = do_query($query);
$i = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$families[$i] = sprintf("%02s - %s", $row["family_id"], $row["family_name"]);
	$family_value[$i] = $row["family_id"];
	if ($family_value[$i] == $family_ptr) $family_display = $families[$i];
	$i++;
}
show_data("dropdown", "clan", "Family", "family_ptr", $family_display, $families, $family_value);

// Display/Edit first name & last name			
show_data("text", "default", "First Name", "first", $first_name);
show_data("text", "default", "Last Name", "last", $last_name);

// Display/Edit birthday
io_box_left("Birthday", "bottom");
if ($allowed_to_edit) {
	get_date($bd_day, $bd_month, $bd_year, 1920, date("Y"), "bd");
} // default day, mon, year, start year, endyear, prefix 
else printf("<b>%s %s, %s</b>", date("F", mktime(0, 0, 0, 0, $bd_month)), $bd_day, $bd_year);
io_box_right();

// Display/Edit Address and Comments
show_data("textarea", "default", "Address", "addr", $address);
show_data("editable textarea", "default", "Comments", "comments", $comments);

// Display (encrypted) password, only if user has edit permission
show_data("text", "default", "User ID", "userid", $userid);
if ($allowed_to_edit) show_data("text", "default", "Password", "password", $password);

// Only Superusers (allowed_to_edit="all) can view and change Hidden view BOT privs
if ($allowed_to_edit_all) {
	$yesno = array("Y", "N");
	show_data("dropdown", "all", "See Hidden DBC Minutes", "see_hidden", $see_hidden, $yesno, $yesno);
	show_data("dropdown", "all", "Allow BOT input", "bot", $bot, $yesno, $yesno);
}


//  Display/Edit privilege level
//debug_on();db_echo("allowed_to_edit",$allowed_to_edit);debug_off();
$opts[0] = "self";
if ($allowed_to_edit_family) $opts[] = "family";
if ($allowed_to_edit_clan) $opts[] = "clan";
if ($allowed_to_edit_all) $opts[] = "all";
if (sizeof($opts) < 2) $priv = "no";
else $priv = "default";
show_data("dropdown", $priv, "Edit Privilege", "edit_privilege", $edit_privilege, $opts, $opts);

echo '</table>';

function multi_line_fix($ml_text)
{
	$r = str_replace(chr(13) . chr(10), "<br>", $ml_text . "&nbsp");
	$r = str_replace(" ", "&nbsp;", $r);
	return $r;
}

identifier_comment("END " . __FILE__);
