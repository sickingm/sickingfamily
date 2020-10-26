<?php
identifier_comment("BEGIN ".__FILE__);
//get posted name of minutes to be displayed

extract($_GET);  

if(empty($minutes_file)) {
    $minutes_file="minutes_blank.htm" ;   
} 

// if blank then set name to minutes_blank.php

$minutes = file_get_contents($minutes_file);
echo $minutes;
identifier_comment("END ".__FILE__);
?>