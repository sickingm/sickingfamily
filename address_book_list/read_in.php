<?php
identifier_comment("START	readin.php");
/* 
	 ____________
	|            |
	| readin.php |
	|____________|
 	
 	CONTAINS:
 		read_in_cf()
 		read_in_names()
 		
  CALLED BY:
		_list.php

	INCLUDED BY:
		_list.php		
			
	CALLS:
		read_in_cf()  (internal)
		read_in_names()  (internal)
		connect_and_select() (from common)
		
	INCLUDES:
		utility_functions.php
		
	DESCRIPTION
		Reads in the required data from the database in order to populate
		drop down lists, etc.
________________________________________________________________________________
*/
  	function read_in_cf($cf,$cfs)
	{
		// reads in a list of distinct clan names from the clans table
		// or family names from the families table 
		// and returns them into an array
		// $cf will either be "clan" or "family"
		// $cfs will be the plural of same
		
		// echo "reading in $cf .......<br>";	
		$query = "SELECT DISTINCT {$cf}_id, {$cf}_name FROM $cfs";
		$result=do_query($query);
		return ($result);
	}
/*
________________________________________________________________________________
*/	
	function read_in_names($fl)
	{
	// reads in the list of distinct first_names or last_names from the 
	// members table and returns them into an array
	//
	// $fl specifies whether the first name or last name field is required
	//		may have the value of "first" or "last".  
	//		Any other value is an error
	//
		$query = "SELECT DISTINCT ".$fl."_name FROM members order by ".$fl."_name";
		$result=do_query($query);
		$i=0;
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) 
		{
			$name[$i++]=$row[0];
		}
		return($name);
	}
/*____________________________________________________________________________*/	
	
	connect_and_select();
	
//Get the clan names for drop down list	
	$clan_result=read_in_cf("clan","clans");
	$i=0;
	while ($row = mysqli_fetch_array($clan_result, MYSQLI_ASSOC)) {
	   $clan_id[$i]=$row["clan_id"];
	   $clan_name[$i++]=$row["clan_name"];
	}
	
//Get the family names for drop down list	
	$family_result=read_in_cf("family","families");
	$i=0;
	while ($row = mysqli_fetch_array($family_result, MYSQLI_ASSOC)) {
	   $family_id[$i]=$row["family_id"];
	   $family_name[$i++]=$row["family_name"];
	}

//Get list of unique first names annd last names
	$first_name=read_in_names("first");
	$last_name=read_in_names("last");

identifier_comment("END		readin.php");