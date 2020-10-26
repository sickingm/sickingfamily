<!--****************************************************************************
		START	ui.php
-->
<?php
//______________________________________________________________________________
//
// U I . P H P
//
//	Contains common UI routines for form level io
//______________________________________________________________________________
//
////////////////////////////////////////////////////////////////////////////////
// I O _ B O X _ L E F T ///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
//                                                                            //
function io_box_left($label, $valign = "left")
{
	echo "\n<tr><th class='rowtable'>$label:</th>";
	echo "\n<td align=left>";
}

////////////////////////////////////////////////////////////////////////////////
// I O _ B O X _ R I G H T /////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
//                                                                            //
function io_box_right()
{
	echo "</td></tr>\n";
}

////////////////////////////////////////////////////////////////////////////////
// S H O W _ D A T A ///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
//                                                                            //
function show_data($type, $edit_flag, $label, $name, $current_value, $options = array(''), $optvals = array(''))
{
	// creates a new two-column row in the current table
	// Column one have the question (Label)
	// Column two has the data

	// $type is "text", "textarea", "editable textarea", "dropdown"
	// $edit_flag should be "","all","clan" or "family" 
	//		it is used to form a variable variable $allowed_to_edit_XXX
	// $label is the descriptior that goes in the left hand column of the table row
	// $name is the variable name defined if editing is executed - unused for static display
	// $value is the current value of the variable to be displayed or edited
	// $options are the displayed option descriptions
	// $optvals are the corresponding values to which the variable is set

	global $allowed_to_edit, $allowed_to_edit_all, $allowed_to_edit_clan, $allowed_to_edit_family;
	io_box_left($label, "top");

	if (!$edit_flag) $can_edit = FALSE;
	else if (empty($edit_flag)) {
		$can_edit = $allowed_to_edit;
		db_print("edit_flag is empty");
	} else switch ($edit_flag) {
		case "all":
			$can_edit = $allowed_to_edit_all;
			break;
		case "clan":
			$can_edit = $allowed_to_edit_clan;
			break;
		case "family":
			$can_edit = $allowed_to_edit_family;
			break;
		case "no":
			$can_edit = FALSE;
			break;
		default:
			$can_edit = $allowed_to_edit;
	}

	if ($can_edit) {
		switch ($type) {
			case "text":
				echo "<input type='text' name='$name'  value='$current_value'>";
				break;
			case "textarea":
				echo "<textarea name='$name' rows='3' cols='30'>$current_value</textarea>";
				break;

			case "editable textarea":
				echo "<textarea name='$name' rows='3' cols='30' class='widgedit'>$current_value</textarea>";
				break;

			case "dropdown":
				echo " \n<select size='1' name='$name'>";
				foreach ($options as $k => $p) {
					if ($current_value == $p) $selected = "selected";
					else $selected = "";
					printf("\n<option %s value='%s'>%s</option>", $selected, $optvals[$k], $p);
				}
				echo "\n</select>";
				break;

			default:
				echo "<br>BAD TYPE PASSED TO show_data()<br>\n";
				break;
		}
	} else {
		echo "<b>" . nl2br(htmlentities($current_value)) . "</b>"; // if $editflag is false just diplay the value, don't allow editing of it
		echo "<input type='hidden' name='$name'  value='$current_value'>"; // but remember to include the data in hidden form for the update command
	}

	io_box_right();
	return;
}
////////////////////////////////////////////////////////////////////////////////
// G E T _ D A T E /////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
//                                                                            //
function get_date($def_day = 1, $def_mon = 1, $def_yr = 0, $min_yr = 0, $max_yr = 0, $prfx = "")
//
// generates a drop down list of month, day, year
//
// $prefix is the prefix to append to the input variables month, day, and year
// $def_day is the default day
// $def_mon is the default month
// $def_yr is the default year,
// $min_year is the minimum year for the selection list
// $max_year is the maximum year for the selection list
{
	$this_year = date("Y");

	$def_year = $def_yr == 0 ? $this_year : $def_yr;  // If default year not specified use current year
	$min_year = $min_yr == 0 ? $this_year : $min_yr;  // If min year not specified use current yearr
	$max_year = $max_yr == 0 ? $this_year : $max_yr;  // If max year not specified use current year

	// Make sure default year falls within the min/max range for years
	// If not, extend the range.
	$min_year = min($min_year, $max_year, $def_year);
	$max_year = max($min_year, $max_year, $def_year, $min_yr, $max_yr, $def_yr);

	// Make sure at least 6 years are included in range
	$min_max = $max_year - $min_year;
	if ($min_max < 6) {
		$min_max += 6;
		$d1 = floor(($min_max) / 2);
		if ($min_yr == 0) $min_year -= $d1;  // only adjust year if explicit minimum not given
		if ($max_yr == 0) $max_year += ($min_max - $d1); // only adjust year if explicit maximum not given
	}

	// set up class names
	$prefix = trim($prfx);
	if (empty($prefix)) {
		$cls_table = "";
		$cls_th = "";
		$cls_tr = "";
		$cls_td = "";
	} else {
		$cls_table = " class='{$prefix}-table'";
		$cls_th = " class='{$prefix}-th'";
		$cls_tr = " class='{$prefix}-tr'";
		$cls_td = " class='{$prefix}-td'";
	}


	$month = array(1 => "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	//db_echo("def_mon",$def_mon);
	echo "\n<table$cls_table>";

	echo "\n<tr{$cls_tr}>";
	echo "\n<td{$cls_td}>Month</td>";
	echo "\n<td{$cls_td}>Day</td>";
	echo "\n<td{$cls_td}>Year</td>";
	echo "\n</tr>";
	echo "\n<tr{$cls_tr}>";
	echo "\n<td{$cls_td}>";

	print("\n<select size='1' name='{$prefix}_month'>");
	for ($i = 1; $i <= 12; $i++) {
		if ($i == $def_mon) $selected = " selected";
		else $selected = "";
		printf("\n<option value='%s' %s>%s</option>", $i, $selected, $month[$i]);
	}
	echo "\n</select>\n</td>\n<td{$cls_td}>\n<select size='1' name={$prefix}_day>";

	for ($i = 1; $i <= 31; $i++) {
		if ($i == $def_day) $selected = " selected";
		else $selected = "";
		printf("\n<option %s>%u</option>", $selected, $i);
	}
	echo "\n</select>\n</td>\n<td{$cls_td}>\n<select size='1' name={$prefix}_year>";

	for ($i = $min_year; $i <= $max_year; $i++) {
		if ($i == $def_year) $selected = " selected";
		else $selected = "";
		printf("\n<option %s>%u</option>", $selected, $i);
	}
	echo "\n</select>\n</td>\n</tr>\n</table>";
}
?>
<!--
			END		ui.php
*****************************************************************************-->