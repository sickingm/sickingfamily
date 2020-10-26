<?php
    $body_id = "edit_constants";
    $title = "Edit DBC Constants";
    $style = "constants";
	require_once "../initialize.php";
    require "../header.php";
	authenticate_user('Sicking Family Website (www.sickingfamily.com)');
    ob_end_flush();
    
    connect_and_select();
    $result = mysqli_query($db_link,'SELECT * FROM dbc_constants') or die(mysqli_error($db_link));
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $DBC[strtoupper($row['name'])]=$row['value'];
	}
?>