<?php ob_start(); ?>
<!-- BEGIN _wccw.php -->

<?php

///////////////////////
//                   //
// w c c w .  p h p  //
//                   //
///////////////////////
$body_id = 'wccw';
$title = 'Who can come when?';
$style = 'wccw';

require_once '../initialize.php';
html_comment('LINE ' . __LINE__ . ' in ' . __FILE__ . ' (FUNCTION ' . __FUNCTION__ . ')');
// Define script for capturing multidates.  Dates are stored directly from the calendar into the date_list textarea
$headers =
<<<HDR
<script>
    $(function() {
        $('#multi999Picker').datepick({
            multiSelect: 999,
            minDate: 0,
            showTrigger: '#calImg',
            dateFormat: "yyyy-mm-dd",
            showButtonPanel: true,
            autoSize: true,
            altFormat: "mmm d"
        });
    });


    function dropdowns(on, off) {
        document.getElementById('invitee_' + on).className = "wccw-new-visible";
        document.getElementById('invitee_' + off).className = "wccw-new-invisible";
    }

    function cycle(id) {
        switch (id.value) {
            case 'Y':
                id.value = 'N';
                id.setAttribute("class", 'circle N');
                break;
            case 'N':
                id.value = 'M';
                id.setAttribute("class", 'circle M');
                break;
            case 'M':
                id.value = '?';
                id.setAttribute("class", 'circle');
                break;
            default:
                id.value = 'Y';
                id.setAttribute("class", 'circle Y');
        };

    }

    function note_change(chgid){
        var cid = document.getElementById(chgid);
        cid.value = "changed";
        document.getElementById("ynm_form").submit();
    }
</script>

<style>
    tr.wccw_ynm_header>th {
        background-color: green;
        font-size: 7em;
    }
</style>

HDR;

html_comment('LINE ' . __LINE__ . ' in ' . __FILE__ . ' (FUNCTION ' . __FUNCTION__ . ')');
require "../header.php";
authenticate_user('Sicking Family Website (www.sickingfamily.com)');
ob_end_flush();
//debug_on();
flush();

require "wccw__main.php";

require "../footer.inc";
identifier_comment("END " . __FILE__ . ' Line Number:' . __LINE__);
?>