<?php 
    connect_and_select();
    $result = mysqli_query($db_link,'SELECT * FROM dbc_constants') or die(mysqli_error($db_link));
	while ($row=mysqli_fetch_array($result,MYSQL_ASSOC)) {
        $DBC[strtoupper($row['name'])]=$row['value'];
	}
?>