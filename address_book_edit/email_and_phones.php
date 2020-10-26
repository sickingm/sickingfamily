<?php
identifier_comment("BEGIN ".__FILE__);
//
//	NAME:	email_and_phones.php
//
//	CALLED BY:
//			address_book_edit_main.php
//
//	CALLS:	bottom_table.php
//			spacer.php
//			bottom.php
//
//Creates the table of emails and phones at the bottom of the list

db_text(__FILE__); // show where I am
	include "bottom_table.php";		// header for the bottom table
	email_and_phone("email", $who, $allowed_to_edit);	// enters email data in first column of table
	include "spacer.php";			// puts a borderless center column in table to separate both halves
	email_and_phone("phone", $who, $allowed_to_edit);	// enters phone data in last column of table
	include "bottom.php";			// housekeeping commands to complete table
			
function email_and_phone($ep, $who, $allowed_to_edit)
{
/*
	Generates a 2 column table in which the first column lists the phones or 
	emails of the family member and the second column is a drop down list of all 
	possible types of emails or phones.
	
	If the current type matches one of the types that type is set as the 
	default
	
	$ep = switch variable - has the value of either "email" or "phone"
	$who = member_id of the selected family member.  Used to query the phones
	or emails tables for records pointing to this member  
*/
// Print table header
	printf("<table class=coltable><tr>\n");
	printf("<th>%s</th> \n",ucfirst($ep));
	print "<th>Type</th></tr>\n";

// get all email or phone records for the current user ($who)
	$query = "SELECT * FROM {$ep}s where member_ptr=$who";
	$result=do_query($query);
	if($ep=="phone")$size=10;else $size=36;
	$i=0;
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{		
		print "<tr><td valign='top'>\n";

		If($allowed_to_edit)printf("\n<input type='text' name='%s[%s]' size='%s' value='%s'></td>",$ep,$i,$size,$row[$ep]);
   		Else printf("\n<b><font face='Microsoft Sans Serif' size='2'>%s</td>",$row[$ep]);

  		print_types($row[$ep."_type"],$i,$ep,$allowed_to_edit);	
		print "</tr>\n";
		$i++;
	}
	if($allowed_to_edit)for ($j = 1; $j <=max(1,3-$i); $j++) 
	{
		printf('<tr><td><input type="text" name="%s[%s]" size="%s" value=""></td>',$ep,$i,$size);
		print_types("",$i,$ep, $allowed_to_edit);
		echo "</tr>";
		$i++;
	}
		
	print "</table>\n";
}

function print_types($type, $i, $ep, $allowed_to_edit)
{
	if(!$allowed_to_edit)
	{	
		echo "<td><b>$type</b>";
		return;
	}
 // define list of relevant types
 // First three types pertain to both email and phones
 $types[$ntypes=0]="&nbsp;";
 $types[++$ntypes]="home";
 $types[++$ntypes]="work";
 // Remaining types are peculiar to only email or phones - as indicated
 if ($ep=="email")$types[++$ntypes]="DBC";
 else
 {
  $types[++$ntypes]="cell"; //
  $types[++$ntypes]="fax";
  $types[++$ntypes]="pager";
 }
 $types[++$ntypes]="other";//last type is always "other"
 
	printf("\n<td><select size='1' name='%s_type[%s]'>",$ep,$i);
	for ($t=0; $t<=$ntypes; $t++)
	{
		if($type==$types[$t])$selected="selected"; else $selected="";
		printf("\n<option %s>%s</option>",$selected,$types[$t]);
	}
	print "\n</select></td>";
}
identifier_comment("END ".__FILE__);