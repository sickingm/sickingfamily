<?php ob_start(); ?>
<!-- BEGIN _dbc.php --!>

<?php
////////////////////
//                //
// d b c . p h p  //
//                //
////////////////////

	$body_id = "dbc";
	$title = "DBC Minutes";
	$style = "dbc";

	require_once "../initialize.php";
    require_once "../header.php";
//	authenticate_user('Sicking Family Website (www.sickingfamily.com)');
ob_end_flush();
flush();
	require_once "dbc_main.php";
	require_once "../footer.php";
    identifier_comment("END ".__FILE__); 
?>