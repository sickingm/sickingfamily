
<?php
	require_once "$doc_root/common/utility_functions.php";  
/* ___________________________________________________________________________________

     data_base.php

	 Contains a number of utility functions to manipulate the sickingf_family database
     
     function get_family_from_member($member_id)
     function get_clan_from_family($family_id)
     function get_families_in_clan($clan_id)
     function get_clan_name($clan_id)
     get_member_name($member_id)

_______________________________________________________________________________________
*/
/*
_______________________________________________________________________________________

    G E T _ F A M I L Y _ F R O M _ M E M B E R     

	Description
			Returns the id of the FAMILY in which the specified family member 
			($member_id) resides.
	INPUT:
		$member_id - integer identifier representing the key of the member to be searched
			
	OUTPUT:
		array of pointers to the family table
_______________________________________________________________________________________
*/
function get_family_from_member($member_id) {
	connect_and_select(); // access database
	$query = "SELECT family_ptr FROM members WHERE member_id='$member_id'"; // find member
	$result=do_query($query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if(mysqli_num_rows($result)==0) return FALSE;
	else return $row["family_ptr"];
}
/*
_______________________________________________________________________________________

    G E T _ C L A N _ F R O M _ F A M I L Y    

	Description
			Returns the id of the clan in which the specified family ($family_id)
			resides.
	INPUT:
		$family_id - integer identifier representing the key of the family to be searched
			
	OUTPUT:
		array of pointers to the clan table
_______________________________________________________________________________________
*/
function get_clan_from_family($family_id)
{
	connect_and_select(); // access database
	$query = "SELECT clan_ptr FROM families WHERE family_id='$family_id'"; // look for all families in clan
	$result=do_query($query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if(mysqli_num_rows($result)==0) return FALSE;
	else return $row["clan_ptr"];
}
/*
_______________________________________________________________________________________

    G E T _ F A M I L I E S _ I N _ C L A N  

	Description
			Returns an array with all of the families included in a given clan
			The array consists of a number of pointers (integers) to the db records
			of the families
	INPUT:
		$clan_id - integer identifier representing the key of the clan to be searched
			in the clans table
			
	OUTPUT:
		array of pointers to the clan table
_______________________________________________________________________________________
*/
function get_families_in_clan($clan_id)
{
	
	connect_and_select(); // access database
	
	$query = "SELECT family_id FROM families WHERE clan_ptr='$clan_id'"; // look for all families in clan
	$result=do_query($query);

	if(mysqli_num_rows($result)==0) return FALSE;
	else while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			$families[]=$row["family_id"];
		}
	return $families;
}
/*
_______________________________________________________________________________________

    G E T _ C L A N _ N A M E 

	Description
			Returns a string containing the name of the clan that has an id of $clan_id
	INPUT:
		$clan_id - integer identifier representing the key of the clan to be searched
			in the clans table
			
	OUTPUT:
		Clan name (string)
_______________________________________________________________________________________
*/
function get_clan_name($clan_id)
{
	
	connect_and_select(); // access database
	
	$query = "SELECT clan_name FROM clans WHERE clan_id='$clan_id'"; 
	$result=do_query($query);

	if(mysqli_num_rows($result)==0) return FALSE;
	else
	{
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row["clan_name"];
	}
}
/**
 *     G E T _ M E M B E R _ N A M E 
 * 
 * 	Description
 * 			Returns a string containing the name of the member that has an id of $member_id
 * 	INPUT:
 * 		$member_id - integer identifier representing the key of the member to be searched
 * 			in the member table
 * 			
 * 	OUTPUT:
 * 		member name (string)
 */

    function get_member_name($member_id) 
    //returns full member name given the member id
    {
        $result=do_query('Select concat(first_name," ",last_name) AS full_name from members where member_id='.$member_id);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
        return $row['full_name'];
    }
?>