<?php ob_start(); ?>
<!-- BEGIN wbw.php -->

<?php

$body_id = 'WBW';
$title = 'Who\'s Bringing What?';
$style='wbw';

require_once '../initialize.php';
fill_comment("  BEGIN  ",__FILE__);
require_once '../header.php';

extract($_REQUEST);

// Output all header detail, user validation, and the main title.
// Validate User
authenticate_user('Sicking_Family_Website_(www.sickingfamily.com)');

require('_wbw_main.php');

require "../footer.inc";

fill_comment("  END  ", __FILE__);