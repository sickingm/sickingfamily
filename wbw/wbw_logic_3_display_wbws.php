<?php
fill_comment("START", __FILE__);

$coming_yn = array('','CHECKED');// Used to populate the "Coming?" radio button option
// Read any associated wbw's

//Get all of associated wbws from database
$query="SELECT * from wbw WHERE event_ptr='$wbw_event_ptr'";
$result=do_query($query);

$add_current_user=TRUE;
while ($wbw_data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	
extract($wbw_data);
	
	// Get member data for current line item
	$member_query = "SELECT * FROM members where member_id='$member_ptr'";
	//db_echo("member_query",$member_query);
	$member_result = do_query($member_query);
	$member_data = mysqli_fetch_array($member_result, MYSQLI_ASSOC);

	if ($member_data['member_id'] == $_SESSION["member_id"]){
		$wbwrow = file_get_contents('wbw_template_2_middle_edit.htm');
		$add_current_user = FALSE;  //There already is a wbw for the current user, so remember that.
	}
	else{		
		$wbwrow = file_get_contents('wbw_template_2_middle_static.htm');
	}

	$wbwrow=str_replace("##USERID##",$member_data['userid'],$wbwrow);
	$wbwrow=str_replace("##FIRST_NAME##", $member_data['first_name'],$wbwrow);
	$wbwrow=str_replace("##LAST_NAME##", $member_data['last_name'],$wbwrow);
	$wbwrow=str_replace("##BRINGING##",$wbw_data['bringing'],$wbwrow);
	$wbwrow=str_replace("##COMMENTS##", $wbw_data['comments'],$wbwrow);

// The following lines are the logic to determine where to place a SELECTED field 
// in the option list
	$wbwrow=str_replace("##COMING##", $wbw_data['coming'],$wbwrow); //  This just puts the "yes" or "no" on 
	$yes = ($wbw_data['coming']=='Yes') ? 1 : 0 ; // This will be 1 (=SELECTED) if coming and 0 (=null) if not coming
	$no=1-$yes; // This will be 0(=null) if coming and 1 (=CHECKED) if not coming
	$wbwrow=str_replace("##CHECKED_YES##",$coming_yn[$yes],$wbwrow);
	$wbwrow=str_replace("##CHECKED_NO##", $coming_yn[$no], $wbwrow);

	$page .= $wbwrow;  // add line to page 
}

// Add blank wbw for surrent user if he hasn't already got one.

	if($add_current_user){
		$wbwrow = file_get_contents('wbw_template_2_middle_new.htm');
		$wbwrow = str_replace("##USERID##", $_SESSION['userid'], $wbwrow);
		$wbwrow = str_replace("##FIRST_NAME##", $_SESSION['first_name'], $wbwrow);
		$wbwrow = str_replace("##LAST_NAME##", $_SESSION['last_name'], $wbwrow);
		$page .= $wbwrow;
	}

// 


fill_comment(" END ", __FILE__);
?>