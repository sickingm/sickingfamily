<?php
//
//	NAME:	table_comment.php
//
//	CALLED BY:
//			table_create.php
//
//	CALLS:	<nothing>
//
identifier_comment("START	table_comment.php");
?>
<td valign="top">
	<font face="Arial" size="2">
		<?php 
		$r=str_replace(chr(13).chr(10),"<br>",$row["comments"]."&nbsp");
		echo $r;
	echo "\n</font>\n</td>";

identifier_comment("END		table_comment.php");