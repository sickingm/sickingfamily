<?php ob_start(); ?>
<!-- BEGIN culture.php --!>

<?php
header("Content-Type: text/html; charset=ISO-8859-1");
echo "<!-- BEGIN culture.php -->\n";
    $body_id = "culture";
    $title = "Culture Page";
    $style = "culture";

	require_once "../initialize.php";
    require_once "../header.php";

/*
	authenticate_user('Sicking Family Website (www.sickingfamily.com)'); 
   
*/
ob_end_flush();
flush();
    require_once "culture_main.php";
    require_once "../footer.inc";
    identifier_comment("END ".__FILE__); 
?>