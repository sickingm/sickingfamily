<?php
fill_comment("  BEGIN  ", __FILE__);
/*
Read in info from user and from database.  This acquires:
    - event_id
    - date (%M %e, %Y)
    - time
    - event
    - venue
    - comments
    - date2 (%Y%m%d)

Also reads in any associated wbw's:
    - userid
    - fullname
    - coming
    - bringing
    - comments
debug_vars();
*/

extract($_REQUEST);

// Load the top page template
$page=file_get_contents('wbw_template_1_top.htm');


require 'wbw_logic_1_get_event_data.php'; //Load all the Event data
require 'wbw_logic_2_display_events.php'; //Insert Event data into page
require 'wbw_logic_3_display_wbws.php';
require 'wbw_logic_4_finish_page.php';

echo $page;

fill_comment("  END  ", __FILE__);