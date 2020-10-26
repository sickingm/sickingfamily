<?php
identifier_comment("Begin table_header.php");
//
// 	NAME:	table_header.php
//
//	CALLED BY:
//		table_create.php
//
//	CALLS:	<nothing>
//

echo "
<tr>
<th class='col_header_left'>
	<b>Name</b>
	<font size='2'><br>Birthday</font>
</th>
";
	header_cell("Address", "width='0%'");
	header_cell("E-Mail");
	header_cell("Telephone", "width='0%'");
	header_cell("Comments", "width='20%'");
	
	echo "</tr>";

identifier_comment("End table_header.php");