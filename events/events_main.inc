<?php ob_start(); ?>
<!-- BEGIN _events.php -->

<?php
    // Make sure Session variables for userid and edit_privilege exist
    if(!isset($_SESSION['userid']))        $_SESSION['userid']=' ';   
    if(!isset($_SESSION['edit_privilege']))$_SESSION['edit_privilege']='none'; 
  
    $hp = ($body_id == 'homepage');
    $bidh = ($hp ? " " : "Add or Edit Event"); // Flagged if routine is called in homepage
    include "events_update_fields.inc";

// Create page title, page div, and form header. 
    $page = file_get_contents("../events/event_template_1_top.htm");
    $dh = ($body_id == 'homepage') ? 'style="display:none"' : '';
    $page = str_replace('##DISPLAY_HEADER##', $dh, $page);
    
//Create table headings for existing events
    $page .= file_get_contents("../events/event_template_2_table_header.htm");
    $page = str_replace('##EVENT_CAPTION##', ($hp ? '' : "Edit ").'Upcoming Events', $page);
    $page = str_replace('##SHOW_IT##', ' ', $page); // Always show this if doing the first section of Events

    echo $page;

// Get all of the event data from the db
    connect_and_select(); 
    $query = 'SELECT 
    		event_id,
    		DATE_FORMAT(date,"%M %e, %Y") as event_date, 
    		LOWER(TIME_FORMAT(time,"%h:%i%p")) as event_time, 
    		event, venue, comments, posted_by,
    		DATE_FORMAT(date,"%Y%m%d") as date2
    		FROM events ORDER BY date2';
    $result = do_query($query);

// Cycle thru each record and output to table .
// Start by creating blank page   
    $page = ''; 
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        extract($row);
        if ($_SESSION['userid']==$posted_by OR $_SESSION['edit_privilege']=='all') 
            $page .= file_get_contents("../events/event_template_3_edit_event.htm"); // Use template for editing the event
        else
            $page .= file_get_contents("../events/event_template_3_show_event.htm"); // Use template for just displaying the event
        
            $page = str_replace('##EVENT_ID##',$event_id,$page);
            $page = str_replace('##EVENT_DATE##',$event_date,$page); 
            $page = str_replace('##EVENT_TIME##',$event_time,$page);
            $page = str_replace('##EVENT_NAME##',$event,$page);
            $page = str_replace('##EVENT_VENUE##',$venue,$page);
            $page = str_replace('##EVENT_COMMENTS##',$comments,$page);
            $page = str_replace('##POSTED_BY##',$posted_by,$page);
    }
    echo $page;
    include "event_template_4_middle.htm"; 

//Finish off page; Make sure current user's id is set to the "Posted By" field 
//but only do this for the Events page not the homepage

        $page = file_get_contents("../events/event_template_2_table_header.htm") // Add table header
            . file_get_contents("../events/event_template_5_bottom.htm");
        $page = str_replace('##CURRENT_USER##',$_SESSION["userid"],$page);
        $page = str_replace('##SHOW_IT##', ($hp ? 'no-display' : 'block') ,$page); //Remove bottom section when on homepage (no Add Event))
        $page = str_replace('##EVENT_CAPTION##', 'Add New Event', $page);
        
        echo $page;

    identifier_comment("END " . __FILE__ . "\n"); 
?>