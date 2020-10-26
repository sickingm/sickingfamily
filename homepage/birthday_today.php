<?php
////////////////////////////////////////////////////////////////////////////////
//
//  +---------------------------------------+
//  ¦ _ b i r t h d a y _ t o d a y . p h p ¦
//  +---------------------------------------+
//
//	NAME:	_birthday_today.php
//
//	CALLED BY:
//			homepage.php
//
//	CALLS:	
//			connect_and_select (from /common/utility_functions.php)
//
//	INCLUDES:
//			<nothing>
//
//	USES STYLES:
//			master.css
//			<other>.css
//			
//	Description
//	-----------
//	Checks the members table to determine if anyone's birthday is today
//	If so, it displays a large, red, personalized "Happy Birthday" greeting
////////////////////////////////////////////////////////////////////////////////
//

//	connect_and_select();
	$bd_today=date("m-d"); // format today's date as string MM-DD with leading zeros

//Check for feast days first	
	$feasts = array("03-07"=>"Joseph", "05-06"=>"Oliver");
	foreach ($feasts as $fd=>$saint) {
		if ($fd == $bd_today) echo "<p class='birthday-today'>Happy Feast of St. $saint</p>";
	}

	
	$query=
		"SELECT first_name, last_name, birthday 
		 FROM members 
		 WHERE DATE_format(birthday,'%m-%d')='$bd_today'"; // get all birthdays for today

	$result = do_query($query);
	if (mysqli_num_rows($result) > 0) {  // Are there any birthdays today?
		print("<p class='birthday-today'>Happy Birthday!!<br>");
		while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
		printf("%s %s<br>", $row["first_name"],$row["last_name"]);
		}	
		print ("</p>");	
	}

?>