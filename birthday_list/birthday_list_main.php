<?php
identifier_comment("START ".__FILE__);

/*
______________________________________________________________________________

+-----------------------------------------------+
� b i r t h d a y _ l i s t _ m a i n . p h p  �
+-----------------------------------------------+

	NAME:	sickingfamily/birthday_list/_birthday_list.php

	USES STYLES:
			birthday_list.css
	Description:
         Generates a list of all family members and their birthdays
         The list is sortable by family, name, and birthday
         
______________________________________________________________________________
*/

//set up sort direction (sd) array.  Default direction is Ascending (0)

    $_sort_by = isset($_GET["sort_by"]) ? $_GET["sort_by"] : "last_name";
    $_sort_dir = isset($_GET["sort_dir"]) ? $_GET["sort_dir"] : 0;

//    import_request_variables("g","_"); // Get the sort_by variable passed in from the header href -- this is considered a "get" variable

	$sd = array(
		"family"=>"0",
		"last_name"=>"0",
		"bd_md"=>"0",
		"full_age"=>"0",
	);

	$dir=array("ASC","DESC");
	
	if(isset($_sort_by)) {
	 	$sd[$_sort_by] = 1 - $_sort_dir;  // toggle sort direction if same sort_by is selected
	} else {
		$_sort_by="last_name";  // default sort for the list should be by name
		$_sort_dir=0;
	}

	$col_head=array(
		"family"=>"Family",
		"last_name"=>"Name",
		"bd_md"=>"Birthday",
		"full_age"=>"Age");
?>


<h2><u><b>Sicking Family Birthday List</b></u></h2>
<div align="center">
<h3>(Click on a column header to sort by that column.)</h3>

	<table class="coltable" border="1" id="table1" >
		<tr>
<?php
	foreach ($sd as $key => $value) {
    	echo "<th><a href='_birthday_list.php?sort_by=$key&sort_dir=$value'>{$col_head[$key]}</a></th>";
	}
?>
		</tr>
<?php
	require_once "$doc_root/common/utility_functions.php";
	connect_and_select();
	$ad = $dir[$sd[$_sort_by]];
	$query="
			SELECT 
			family_name AS Family, 
			first_name, last_name, 
			DATE_FORMAT(birthday,'%m-%d') AS bd_md,
			DATE_FORMAT(birthday,'%Y%m%d') AS bd_ymd,
			DATE_FORMAT(birthday,'%Y') AS bd_year,
			TIMESTAMPDIFF(YEAR,birthday,CURDATE()) AS age,
			TIMESTAMPDIFF(DAY,birthday,CURDATE()) AS full_age
			from families, members 
			WHERE family_ptr=family_id AND first_name!='zzzGuest'
			ORDER BY $_sort_by $ad , first_name $ad
		";
		
	$result = do_query($query);

	$today=date("Ymd");
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	 	$age=(integer)(($today-$row["bd_ymd"])/10000);
		echo "<tr>
				<td>&nbsp;{$row["Family"]}&nbsp;</td>
				<td>&nbsp;{$row["first_name"]}&nbsp;{$row["last_name"]}&nbsp;</td>
				<td>&nbsp;{$row["bd_md"]}-{$row["bd_year"]}&nbsp;</td>
				<td>&nbsp;$age&nbsp;</td>
			</tr>";
	}
?>
	</table>
</div>

<?php identifier_comment("END ".__FILE__);