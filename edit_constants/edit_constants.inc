<?php
    $body_id = "edit_constants";
    $title = "Edit DBC Constants";
    $style = "constants";
	require_once "../initialize.php";
    require "../header.php";
	authenticate_user('Sicking Family Website (www.sickingfamily.com)');
    ob_end_flush();
    
    require_once('../constants.inc');
    
    /*
    add edit logic here
    */
    
?>