<?php ob_start(); ?>
<!-- BEGIN blank.php --!>

<?php
////////////////////////
//                    //
// b l a n k . p h p  //
//                    //
////////////////////////

    $body_id = "blank";
    $title = "SFDC BLANK TEST PAGE";
    $style = "blank";

	require_once "../initialize.php";
    require "../header.php";
//	authenticate_user('Sicking Family Website (www.sickingfamily.com)');
ob_end_flush();
flush();
    require "blank_main.php";
    require "../footer.php";
    identifier_comment("END ".__FILE__); 
?>