<?php
	$bottom = file_get_contents('wbw_template_4_bottom.htm');
	$bottom = str_replace("##MEMBER_ID##", $member_ptr, $bottom);
	$bottom = str_replace("##EVENT_PTR##", $wbw_event_ptr, $bottom);
	$page .= $bottom;