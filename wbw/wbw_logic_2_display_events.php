<?php
fill_comment("  BEGIN  ", __FILE__);

$page = str_replace('##EVENT_TITLE##', $event, $page);
$page = str_replace('##EVENT_ID##', $event_id, $page);
$page = str_replace('##DATE##', $date, $page);
$page = str_replace('##TIME##', $time, $page);
$page = str_replace('##VENEe##', $venue, $page);
$page = str_replace('##COMMENTS##', $comments, $page);
$page = str_replace('##HOST##', $posted_by, $page);

fill_comment("  END  ", __FILE__);