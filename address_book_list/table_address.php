<?php
identifier_comment("START	table_address.php");
//
//	NAME:	table_address.php
//
//	CALLED BY:
//			table_create.php
//
//	CALLS:	<nothing>
//
?>
<td valign="top" align="left">
	<font face="Arial" size="2" align="left">

<?php 
	$r=str_replace(chr(13).chr(10),"<br>",$row["address"]."&nbsp");
	$r=str_replace(" ","&nbsp;",$r); 
	echo $r;
	echo "\n</font>\n</td>";
	
identifier_comment("START	table_address.php");