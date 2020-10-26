<?php
////////////////////////////////////////////////////////////////////////////////
//
//  +-------------------------------------------+
//  ¦ _ r a n d o  m _ t h o u g h t s . p  h p ¦
//  +-------------------------------------------+
//
//	NAME:	_random_thoughts.php
//
//	CALLED BY:
//			home_page.htm
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
//	Description
//		Reads a random record from the deep_thoughts table and prints it
//		at the bottom of the home page.
//	
////////////////////////////////////////////////////////////////////////////////
//
	require_once "../initialize.php";
    identifier_comment("BEGIN ".__FILE__);
	connect_and_select();

	$query='SELECT 
                thought, meeting_number, rand() AS R1, rand() AS R2, DATE_FORMAT(meeting_date,"%M %e, %Y") AS date 
                FROM deep_thoughts 
                ORDER BY R2 
                LIMIT 1';
	$result = mysqli_query($db_link,$query) or die(mysql_error());
	
	
	echo "<td id='thought'>Thought for the Day<br />";
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	   printf("\n<div>%s\n<br /><br /><i>(Meeting #%s - %s)</i></div>", htmlentities($row["thought"]), $row["meeting_number"], $row["date"] );
	}
	echo "	</td>\n";
 identifier_comment("END ".__FILE__);
?>