<?php
identifier_comment("Begin table_create");
/*	____________________
 	|                   |
	| table_create.php  |
	|___________________|
 	
 	CONTAINS:
 		
  	CALLED BY:
			_list.php

	INCLUDED BY:
					
	CALLS:
			table_header.php
			table_name_bd.php
			table_address.php
			table_emails.php
			table_phones.php
			table_comment.php
			connect_and_select (from common/utility_functions)
	
	INCLUDES:
		common/utility_functions.php
		
	DESCRIPTION:
		Generates the actual Address Book table given the requested
		Clan, Family, First Name, and Last Name
*/


	echo "
		<div align='center'>
		<i><font size='2'>(Click on member's name to edit details)</font></i>";
	
	connect_and_select();	
	
	if(!isset($clan))$clan="*";
	if(!isset($family))$family="*";
	if(!isset($first))$first="*";
	if(!isset($last))$last="*";
	
	$query= "SELECT 	
        member_id, family_ptr, first_name, last_name, address, 
		DATE_FORMAT(birthday, '%m-%d-%Y') as birthday,
		comments, userid, password, bot, see_hidden, clan_ptr
		FROM members, families  
		WHERE family_ptr=family_id ";
		
	if($clan!="*")$query.=" AND clan_ptr = '$clan'";
	if($family!="*")$query.= " AND family_ptr = '$family'";
	if($first!="*")$query.= " AND first_name = '$first'";
	if($last!="*")$query.= " AND last_name = '$last'";
	$query.=" ORDER BY last_name, first_name";

//debug_on();
	$result=do_query($query);
//debug_off();

	$nrows=mysqli_num_rows($result);
	echo '<table border="1" id="address_list" bgcolor="#FFFFFF">';
$top_bottom="bottom"; 
	include "table_header.php";
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 	{
		include "table_name_bd.php";
		include "table_address.php";
		include "table_emails.php";
		include "table_phones.php";
		include "table_comment.php";			
	}
	if($nrows>10) {
		$top_bottom="top";// justify upper 
		include "table_header.php";
	}
	echo "\n</tr>\n</table>";
	echo "\n<i><font size='2'>(Click on member's name to edit details)</font></i>";

identifier_comment("End table_create");