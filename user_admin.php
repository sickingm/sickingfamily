<?php
    echo "<!-- BEGIN " . __FILE__ ."-->\n";
/*****************************************************************************
**                                                                          **
**     u s e r _ a d m i n . p h p                                          **
**                                                                          **
**   Presents all of the adminstrative needs for members                    **
**                                                                          **
**   called by: sickingfamily.com                                           **
**   calls:                                                                 **
**        change_id.inc                                                     **
**        forgot_id.inc                                                     **
**        instructions.inc                                                  **
**        login.inc                                                         **
**        logout.inc                                                        **
**                                                                          **
*****************************************************************************/

    $body_id = "user_admin";   
    $title = "SFDC Administration";
    $style = "user_admin";
	require_once "../initialize.php";
    require "../header.php";

	extract($_POST);// Get any SUBMIT values
	extract($_GET); // get the switchboard variable ("login", "logout", etc.)
    
// create top level container div for the page
    echo "\n<div id='user-admin-page'>";

    
    echo "\n<div id='user-admin-action'>";
// Check if one of the submit buttons has been pressed
	if(isset($login))      include "login.inc";
	if(isset($change_id))  include "change_id_action.inc";
	if(isset($forgot_id))  include "forgot_id_action.inc";
	if(isset($admin))      include $admin.".inc";

// Create the User_admin action section    
    
    echo "\n</div> <!-- Close user-admin-action -->"; 
    
//create overall heading for User Administration    
    echo "
        \n<div id='user-admin-header'>
        \n<h1>Sicking Family Website</h1> 
        \n<h2>User Administration Page</h2>
        \n</div> <!-- Close user-admin-header -->
    ";

// Create the User_admin menu navigation section    
    echo  '<div id="user-admin-menu">';
    require "user_admin_menu.inc";
    echo "\n</div> <!-- Close user-admin-menu -->";   
     
    echo "\n</div> <!-- Close user-admin-page -->";
    
    require "../footer.inc";
    identifier_comment("END ".__FILE__);
ob_end_flush();