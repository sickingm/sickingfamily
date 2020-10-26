<?php ob_start(); ?>
<!-- BEGIN address_book_list.php -->

<?php
////////////////////////////////////////////////
//                                            //
// a d d r e s s _ b o o k _ l i s t . p h p  //
//                                            //
////////////////////////////////////////////////

	$body_id = "addressbook";
	$title = "Address Book - List";
	$style = "address_book";

    
	require_once "../initialize.php";
	require "../header.php";
	
	//Validate User
	authenticate_user('Sicking Family Website (www.sickingfamily.com)');
	
ob_end_flush();
flush();
	require "address_book_list_main.php";
	require "../footer.inc";
	identifier_comment("END ".__FILE__); 
?>