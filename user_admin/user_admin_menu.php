<?php
identifier_comment("START ".__FILE__);
//	Builds the left hand menu for User Admin page
//  Includes these options:
//		  Login/Logout
//		**Change username and/or password
//		 *Forgot Username / Password
//		++Edit Family (and Clan) data
//		++Distribution List Management
//		  Instructions
//
// The items preceded by * above are only active if the user is *not* yet logged in
// The items preceded by ** above are only active if the user *is* already logged in
// The item preceded with ++ above is only active if user has family and/or clan edit authorization
// The "Login/Logout" and "Instructions" menus are always active.
//
// The menu and the actions associated with each menu item are governed by three arrays:
//		$menu_choices[] contains the menu verbiage for each choice
//		$admin_choices contains the name of the routine to execute if the menu item is selected
//		$on_if_logged contains a TRUE/False value depending on whether the menu item should be 
//		displayed in the current context.

//	When a menu item is selected the current page is reloaded but with &admin=XXX appennded
//	where XXX is the name f the .php file to be executed.

    echo  "\n\n<div id='user-admin-menu'>";
	$true = TRUE;
	$false = FALSE;
	
	$logged = !empty($_SESSION["authenticated"]);  //Determine if user is logged in
	
		$edit_menu = "Edit Family/Clan";
		$dist_list_menu = "Distribution Lists";
	if ($logged AND $_SESSION["edit_privilege"]!="self" ) { // Determines if clan and/or family editing is allowed
		if ($_SESSION["edit_privilege"] != "family") $edit_menu .= " and Clan"; 
		$edit_menu .= " data";	
		$display_edit = TRUE;
	}
	else {	
		$display_edit = FALSE; 	
	} 
	
// Build arrays of menu choices and corresponding routines

	$menu_choices = array( // Menu option verbiage
		$logged ? "Log Out" : "Log In",
		"Change User ID or Password",
		"Forgot User ID or Password",
		$edit_menu,

		"Instructions"
		); 
		
	$admin_choices = array(	// Names of routine to execute
		$logged ? "logout" : "login",
		"change_id",                 
		"forgot_id",
		"edit_clan_and_family",

		"user_admin_instructions"
		); 
	
	$on_if_logged = array(  // Decides whether menu item is active when member is logged on.
		TRUE,
		$logged,
		!$logged,
		$display_edit,

		TRUE		// 'Instructions' menu item is never grayed out
	);  
	
		for ($i=0; $i<sizeof($menu_choices); $i++) {  // build menu
			if($on_if_logged[$i]) 
                echo sprintf("\n<a href='user_admin.php?admin=%s'>%s</a>"
                    ,$admin_choices[$i]
                    ,$menu_choices[$i]);
			else 
                echo sprintf("\n<span class='dimmed'>%s</span>",$menu_choices[$i]);
			echo "\n<br />";
		}
      
	if ($logged) {
	   echo '<div id="user-info"><br />';
		alert("<span class='user-id' >{$_SESSION["userid"]}</span>
            (<span class='user-name'>{$_SESSION["first_name"]} {$_SESSION["last_name"]}</span>)
            <br />is currently logged in.",'message');
        echo "</div>";
	}        	  

    echo "\n</div> <!-- Close user-admin-menu -->"; 
identifier_comment("END ".__FILE__);