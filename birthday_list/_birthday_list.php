<?php ob_start(); ?>
<!-- BEGIN birthday_list.php -->

<?php
/////////////////////////////////////////
//                                     //
// b i r t h d a y  _ l i s t . p h p  //
//                                     //
/////////////////////////////////////////

	$body_id = "birthdays";
	$title = "Birthday List";
	$style = "birthday";

    
	require_once "../initialize.php";
	require "../header.php";
	
	//Validate User
	authenticate_user('Sicking Family Website (www.sickingfamily.com)');
	
ob_end_flush();
flush();
	require "birthday_list_main.php";
	require "../footer.inc";
	identifier_comment("END ".__FILE__); 
?>