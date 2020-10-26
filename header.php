<!-- BEGIN header.php -->

<?php


////////////////////////////////////
//                                //
// S F D C / h e a d e r . p h p  //
//                                //
////////////////////////////////////

// make sure a session has been started
	$sid = session_id();
	if(empty($sid)){
	   $hadToStartANewSession = "YES"; 
       session_start();
    } 
    else {$hadToStartANewSession="NO";}
  
    if(empty($headers))$headers="";
	if(empty($title))$title = "sickingfamily.com (".ucfirst($body_id).")";  
     
	if(empty($style))$style=$body_id;  // usually the style name is the same as the body name
    if(empty($style2))$style2='dummy';  // Some page require a second css.  If not link to dummy (empty) css file.)

$all = (isset($_SESSION['edit_privilege']) AND $_SESSION['edit_privilege']=='all');  //Check if user has full edit privilege

echo
<<<HDR
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
    <title>$title</title>
    
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />   
    
    <link rel="stylesheet" href="../css/reset.css" type="text/css"/>
    <link rel="stylesheet" href="../css/master.css" type="text/css"/>
    <link rel="stylesheet" href="../css/navigation.css" type="text/css"/>
    <link rel="stylesheet" href="../css/collapsible.css" type="text/css"/>
    <link rel="stylesheet" href="/common/js/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="../css/$style.css" type="text/css"/>
    <link rel="stylesheet" href="../css/$style2.css" type="text/css"/>
    <link rel="stylesheet" href="/common/datepicker/css/humanity.datepick.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
    <script src="/common/js/jquery.js"></script>
    <script src="/common/js/jquery-ui/jquery-ui.js"></script>
	<script src="/common/js/jquery.min.js"></script>
    <script src="/common/js/collapsible.js"></script>
    <script src="/common/js/custom_scripts.js"></script>	
	<script src="/common/datepicker/js/jquery.plugin.min.js"></script>
    <script src="/common/datepicker/js/jquery.datepick.js"></script>  
        
    $headers
    
</head>
<body id='$body_id' >
	<header id="menu">	
<ul>
HDR;

    header_menu('Home','homepage','homepage/_homepage.php','Home Page');
    header_menu('Address Book','addressbook','address_book_list/_address_book_list.php','Sicking Family Address Book');
    header_menu('Birthdays','birthday_list','birthday_list/_birthday_list.php','Sicking Family Birthday Listk');
    header_menu('DBC Minutes','dbc','dbc/_dbc.php','DBC Minutes');
    header_menu('Events','events','events/_events.php','Upcoming Family Events');
    header_menu('WCCW?','wccw','wccw/_wccw.php','Who Can Come When??');
    header_menu('Culture','culture','culture/culture.php','Culture page');
    header_menu('User Administration','admin','user_admin/user_admin.php?admin=user_admin_instructions','User Administration');
    header_menu('Enhancement List','enhancements','enhancements/_enhancements.php','Enhancement List');

	echo "\n           </ul>";
	echo "\n</header> <!-- close menu area --><br />";
    if (!empty($header_title))echo "<h1>$header_title</h1>";

global $production;
if (!$production) alert('Error Level is not set for production.<br>Correct this at /common/error_handler.php',"error-msg");

function header_menu($menu, $id, $location, $hover='') {
/*
	Outputs a single menu option fusing the header.css format
	
	$menu - Wording of the menu item
	$id - Prefix for the <li> and <a> tag id's.  Will be postfixed with _left or _right 
			depending on which half of the tab graphic is to be displayed
	$location - link location to jump to
	$hover - Verbiage displayed when cursor hovers over menu tab
*/
	$h = empty($hover) ? $menu : $hover;
	echo "\n   <li id='{$id}-left'><a title='$h' href='../$location' id='{$id}-right' target='_TOP'>";	
	echo $menu;	
	echo "</a></li>";	
    
    }
 
 identifier_comment("END ".__FILE__);
 ?>
