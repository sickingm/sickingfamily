<?php ob_start(); ?>
<!-- BEGIN homepage.php -->
<?php
////////////////////////////////////////////////
//                                            //
// h o m e p a g e / h o m e p a g e . p h p  //
//                                            //
////////////////////////////////////////////////

    $body_id = "homepage";
    $title = "Sicking Family Home Page";
    $style = "homepage";
	require_once "../initialize.php";
    require "../header.php";
/*	authenticate_user('Sicking Family Website (www.sickingfamily.com)');  not needed for homepage */
ob_end_flush();
flush();
    require "homepage_main.php";
    require "../footer.inc";
    identifier_comment("END ".__FILE__); 
?>