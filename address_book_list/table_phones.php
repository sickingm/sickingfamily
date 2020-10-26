<?php
identifier_comment("START	table_phones.php");
//
//	NAME:	table_phones.php
//
//	CALLED BY:
//			table_create.php
//
//	CALLS:
//			<nothing>
//
?><td valign="top">
	<table border="0" id="table3" style="border-collapse: collapse">
<?php
 	$query_phone = "SELECT * FROM phones WHERE member_ptr = ".$row["member_id"];
		$result_phone=do_query($query_phone);
		if(mysqli_num_rows($result_phone)>0) {
			while ($p = mysqli_fetch_array($result_phone, MYSQLI_ASSOC)) {
				echo "\n<tr>\n<td align='left'>\n<font face='Arial' size='2'>";
				printf ("%s&nbsp;(%s)",$p["phone"],$p["phone_type"]);
				echo "\n</font>\n</td>\n</tr>";
			}
		}
		else echo "&nbsp";
	echo "\n</table>\n</td>";

identifier_comment("END		table_phones.php");