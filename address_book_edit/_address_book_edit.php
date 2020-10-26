<?php ob_start(); ?>
<!-- BEGIN _address_book_edit.php -->

<?php
//////////////////////////////////////
//                                  //
// a d d r e s s _ b o o k . p h p  //
//                                  //
//////////////////////////////////////

    $body_id = "address_book";
    $title = "Address Book - Edit";
    $style = "address_book";
	require_once "../initialize.php";
    require "../header.php";
	authenticate_user('Sicking Family Website (www.sickingfamily.com)');
ob_end_flush();
flush();
    require "address_book_edit_main.php";
    require "../footer.inc";
    identifier_comment("END ".__FILE__); 
?>