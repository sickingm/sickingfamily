<?php ob_start(); ?>
<!-- BEGIN user_admin.php --!>

<?php
/*****************************************************************************
**                                                                          **
**     u s e r _ a d m i n . p h p                                          **
**                                                                          **
**   Presents all of the adminstrative needs for members                    **
**                                                                          **
**   called by: sickingfamily.com                                           **
**   calls:                                                                 **
**        change_id.php                                                     **
**        forgot_id.php                                                     **
**        instructions.php                                                  **
**        login.php                                                         **
**        logout.php                                                        **
**                                                                          **
*****************************************************************************/
/*
    When first entered this page simpley presents a few menu items:
        - Login
        - Forgot User Name /Password
        - Instructions
    More menu items are added after the user logs on.
    
    Typically a comman wil require input.  The name of the routine that 
    accept this input is the same as the menu item.  
    E.g., to login the application executes the Login.php script)
    
    This script will accept user data (E.g., username and password)
    and send it back to the main program with a submit button named 
    the same as the routine (E.g., SUBMIT name='login')
    
    The main program then executes the action part of hte application.  
    (E.g., login_action.php)
*/
    
    $body_id = "user_admin";
    $title = "SFDC Administration";
    $style = "user_admin";

	require_once "../initialize.php";
    require "../header.php";
//	authenticate_user('Sicking Family Website (www.sickingfamily.com)');

	extract($_POST);// Get any SUBMIT values
	extract($_GET); // get the switchboard variable ("login", "logout", etc.)
    
// create top level container div for the page
    echo "\n<div id='user-admin-page'>";

    
    echo "\n<div id='user-admin-action'>";
// Check if one of the submit buttons has been pressed
	if(isset($login))      include "login_action.php";
	if(isset($change_id))  include "change_id_action.php";
	if(isset($forgot_id))  include "forgot_id_action.php";
	if(isset($admin))      include $admin.".php";

// Create the User_admin action section       
    echo "\n</div> <!-- Close user-admin-action -->"; 

// Create the User_admin menu navigation section    
    require "user_admin_menu.php";    
    
//create overall heading for User Administration    
    require "user_admin_header.php";

    echo "\n</div> <!-- Close user-admin-page -->";
    
    identifier_comment("END ".__FILE__);
ob_end_flush();
flush();