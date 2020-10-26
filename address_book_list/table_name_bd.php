<?php
//
//	NAME:	table_name_bd.php
//
//	CALLED BY:
//		table_create.php
//
//	CALLS:	
//		has_privilege from /common/authentication.php
//
identifier_comment("START table_name_bd.php");
?>
<tr>
	<td valign="top">
		<font face="Arial" size="2">
		
				<?php 
				if(has_privilege($row["member_id"],$row["family_ptr"],$row["clan_ptr"]))
				{
				printf ("<b><A href=\"../address_book_edit/_address_book_edit.php?who=%s&clan=%s&first=%s&last=%s\">%s %s</A></b><br> %s"
				,$row["member_id"]
				,$clan, $first, $last
				,$row['first_name'],$row['last_name'],$row['birthday']);
				}
				Else
				{				
				printf ("<b>%s %s</b><br> %s"
				,$row['first_name'],$row['last_name'],$row['birthday']); 
				}
				?>
				
		</font>
	</td>
	
<?php identifier_comment("END table_name_bd.php");