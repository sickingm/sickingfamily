<!-- BEGIN culture_header.php --!>
<?php
	$body_id = "culture_header";
	$title = "Culture Page/Header";
	$style = "culture";
	require_once "../initialize.php";
	require_once "../header.php";
	
/*	authenticate_user('Sicking Family Website (www.sickingfamily.com)'); */
	ob_end_flush();
	
/*  require "culture_main.php"; */
	require "../footer.php";
	identifier_comment("END ".__FILE__); 
?>
<body style="margin-top:0px">
<h1 align="center">The Culture Page</h1>
<h2 align="center">Great works of high class literature and art<br>authored by Sicking Family Members</h2>
..
</body>

</html>