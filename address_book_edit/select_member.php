
<!--****************************************************************************
			START	select_member.php
-->
<?php
//
//	NAME:	select_member.php
//
//	CALLED BY:
//			address_book_edit_main.php
//
//	CALLS:	utility_functions.php
//
db_text(__FILE__); // show where I am

?>
<form id='edit_form' method="get" action="_address_book_edit.php">
	<p style="margin-top: 0; margin-bottom: 0">
		<font color="#000000"><b>Select name of Family Member to be edited:</b></font>
	</p>
	<p style="margin-top: 0; margin-bottom: 0">
<?php

	connect_and_select();
	
	$query= "SELECT 	
	  member_id , clan_ptr, family_ptr, first_name, last_name, address, 
		DATE_FORMAT(birthday,'%M %e, %Y') as birthday,
		DATE_FORMAT(birthday,'%m') as bd_month,
		DATE_FORMAT(birthday,'%Y') as bd_year,
		DATE_FORMAT(birthday,'%e') as bd_day,	
		comments, userid, password, bot, see_hidden, edit_privilege
		FROM members, families 
		WHERE family_ptr=family_id
		ORDER BY last_name, first_name";
		
		$result=do_query($query); //Get member table data
	
//		if this is not the first time through this loop, then the "select member" 
//		request variable will be set to the pointer to the name of the most
//      recent person selected.
//		save this in $who so it can be accessed more easily

		if (isset($_REQUEST["select_member"]))$who=$_REQUEST["select_member"];

//		For each row in the members table create an option row.
//		If $who exists and is equal to the current id, then set it as the default row.

	echo '<select size="1" name="select_member" onchange="document.getElementById(\'edit_form\').submit();" >';

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
		{
			$selected="";
			$id = $row["member_id"];
			{
				if(isset($who)&&$id==$who) // When we get to the selected member, load all data into temp variables
				{
					$selected="selected";
					extract($row); // extract the data into explicit variables (e.g., $first_name=row["first_name"];
				}
			}
			$name=sprintf("\n%03s: %s %s",$id,$row['first_name'],$row['last_name']);
			$cmd=sprintf("\n<option %s value='%s'>%s</option>",$selected,$id,$name);
			echo $cmd;
		}
?>
	</select><input type="submit" value="Edit Member Data" name="edit"></p>
</form>
<!--
			END		select_member.php
*****************************************************************************-->
