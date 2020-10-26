<?php
//
//	NAME:	table_emails.php
//
//	CALLED BY:
//			table_create.php
//
//	CALLS:	<nothing>
//
?>
<td valign="top">
	<table border="0" id="table3" style="border-collapse: collapse">
<?php
 	$query_email = "SELECT * FROM emails WHERE member_ptr = ".$row["member_id"];
	$result_email=do_query($query_email);
	
	if (mysqli_num_rows($result_email)>0) {
		while ($p = mysqli_fetch_array($result_email, MYSQLI_ASSOC)) {
?>
		<tr>
			<td align="left">
				<font face="Arial" size="2">
			<?php printf ("<a href=\"mailto:%s\">%s<a>&nbsp(%s)",$p["email"],$p["email"],$p["email_type"]); ?>
				</font>
			</td>
		</tr>
<?php	}
	}
	Else echo "&nbsp";
	
	echo "\n</table>\n</td>";
	
identifier_comment("START	table_emails.php");