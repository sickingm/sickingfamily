<!--****************************************************************************
			START	update.php
-->
<?php
//
//	NAME:	update.php
//
//	INCLUDED BY:
//			_list.php
//
//	CALLS:	utility_functions.php
//		

include_once "get_privileges.php";

connect_and_select();

extract($_REQUEST);
db_text(__FILE__); // show where I am

$bd=sprintf("%04s-%02s-%02s",$bd_year,$bd_month,$bd_day);
if($bd=="1921-01-01") $bd=NULL;  // Takes into account null representation of dates

$q1="UPDATE members 
		SET 
		family_ptr = '{$family_ptr}',
        first_name = '{$first}',
		last_name = '{$last}',
		birthday = '$bd',
        address = '{$addr}',
		edit_privilege = '{$edit_privilege}',
		comments = '" . trim(slash_it($comments)) . "'";
		if($_SESSION["edit_privilege"]=="all") //allow editing of other data only if superuser
		{
			$q1.= " ,bot ='{$bot}'
					,see_hidden ='{$see_hidden}'";
		}
		$q1.="	WHERE member_id = {$who}";
		$q1=trim($q1);

$result=do_query($q1) or die(mysqli_error($db_link));

// Update new userid
if(isset($userid) && !empty($userid) && ($userid != $_SESSION['userid'])) {
	$msg=change_userid($who, $userid); // $msg contains any update message
	if (strlen($msg)>0) echo "\n<br><bold><font color='543210'>$msg</font></bold><br>\n";
}
	
// Update password 
if($allowed_to_edit_all) { //allow editing of other data only if superuser
	$q2="UPDATE members 
			SET password='$password' 
			WHERE member_id = {$who}";
	$result=do_query($q2);
}

ep_replace("email",$email,$email_type,$who);
ep_replace("phone",$phone,$phone_type,$who);

echo "<p align= 'center '><font color= '#996633 ' face= 'Century Gothic '>";
echo "Address Book entry for <b>{$first} {$last }</b> has been updated</font></p>";

function ep_replace($ep, $value, $type, $who) {
//Dump old records and replace with new ones.
//$ep may have a value of "email" or "phone"
	if($ep!="email" && $ep!="phone") 	{
		printf("%s is not a valid value for \$ep",$ep);
		exit;
	}
	$query="DELETE FROM {$ep}s WHERE member_ptr=\"$who\"";
	$result=do_query($query);
	for ($i=0; $i<=sizeof($value); $i++) {
	   if(!empty($value[$i])) {
	   	$query="INSERT INTO {$ep}s 
		   (member_ptr,$ep, {$ep}_type) 
		   VALUES
		   (\"$who\", \"$value[$i]\", \"$type[$i]\")";
		do_query($query);
	   }
	}
}
identifier_comment ('END ' . __FILE__);
?>