<?php ob_start(); ?>
<!-- BEGIN _events.php ***************************************************** -->

<?php
//////////////////////////
//                      //
// e v e n t s . p h p  //
//                      //
//////////////////////////

    $body_id = 'events';
    $title = 'SFDC Events';
    $style = 'events';
    
    require_once '../initialize.php';

$headers =
<<<HDR
<script>
    $(function() {
        $('#new_date').datepick({
            minDate: 0,
            dateFormat: 'DDDD M d, yyyy',
            autoSize: true
        });
    });
</script>

HDR;


    require '../header.php';
	authenticate_user('Sicking Family Website (www.sickingfamily.com)');
    
ob_end_flush();
flush();
     
// Check for posted variables.
    extract($_POST);
    require 'events_main.inc';
    require '../footer.inc';
    
    identifier_comment('END '.__FILE__); 
?>