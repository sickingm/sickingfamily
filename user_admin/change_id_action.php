<?php
identifier_comment("START    change_id_action.php");
    global $chg_id_return_code;
    global $chg_pwd_return_code;
extract ($_POST);
    if ($new_password != $repeat_password ) {
    	alert ("New password does not match repeated password.<br />
                Please re-enter ", "error-msg");
    //    	$admin = "change_id";
    	return;
    }

    if (empty($new_password) or $new_password==$_SESSION["password"]) alert("...Password unchanged.");
    else {
        $return_code = change_password($_SESSION['member_id'],$new_password);
        if($return_code > 0)alert($chg_pwd_return_code[$return_code],'error-msg'); 
        else alert ('...Password changed.');
    }
	 
	if (empty($new_userid) or $new_userid==$_SESSION["userid"]) alert ("...User ID unchanged.");
    else {
        $return_code = change_userid($_SESSION["member_id"], $new_userid);
        if($return_code>0)alert($chg_id_return_code[$return_code],'error-msg');
        else alert ("...User ID Changed to '$new_userid'");
    }	
    	
identifier_comment("END   change_id_action.php");