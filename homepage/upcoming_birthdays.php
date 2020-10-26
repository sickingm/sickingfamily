<?php
////////////////////////////////////////////////////////////////////////////////
//
//  +------------------------------------------------+
//  ¦ _ u p c o m i n g _ b i r t h  d a y s . i n c ¦
//  +------------------------------------------------+
//
//	NAME:	_upcoming_birthdays.php
//
//	CALLED BY:
//			<nothing>
//
//	CALLS:	
//			connect_and_select (from /common/utility_functions.php)
//
//	INCLUDES:
//			<nothing>
//
//	CONTAINS:
//			<nothing>
//
//	USES STYLES:
//			<none>  (is part of home_page)
//			
//	Description:
//		Checks the members table for all those with birthdays in the current
//		month or the next month.
//		Displays the names of all of these, current month in red, next month
//		in blue.
//	
////////////////////////////////////////////////////////////////////////////////
//
//	require_once "../initialize.php";
 identifier_comment("BEGIN ".__FILE__);
	connect_and_select();

	$this_array=getdate();
	$this_month=$this_array["mon"];
	$this_month_name=$this_array["month"];
	$this_month_abbrev=substr($this_month_name,0,3);
	
	$next_array=getdate(strtotime("this month +1 month"));
	$next_month=$next_array["mon"];
	$next_month_name=$next_array["month"];
	$next_month_abbrev=substr($next_month_name,0,3);
	
	$fmt="\n<span><b>%s</b>&nbsp;%s&nbsp;(%s&nbsp;<b>%u</b>)</span><br />";

	$q = "SELECT first_name, last_name, DATE_FORMAT(birthday,'%d') as birthday FROM members where MONTH(birthday)=";
	$q1=$q.$this_month." ORDER BY birthday" ;
	$q2=$q.$next_month." ORDER BY birthday";

	print "\n<td id='this-month'><h3>$this_month_name Birthdays</h3>";
	$result = mysqli_query($db_link,$q1) or die(mysqli_error($db_link));
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		printf($fmt, $row["first_name"],$row["last_name"], $this_month_abbrev, $row["birthday"]);
	}
	print "\n</td>\n\n";
    
	print "<td id='next-month'><h3>$next_month_name Birthdays</h3>";
	$result = mysqli_query($db_link,$q2) or die(mysqli_error($db_link));
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		printf($fmt, $row["first_name"],$row["last_name"], $next_month_abbrev, $row["birthday"]);
	}
	print "</td>";
identifier_comment("END ".__FILE__);
?>