<?php
identifier_comment("BEGIN " . __FILE__ . " at line " . __LINE__);
//pre_dump('$_REQUEST<br> Process_poll_data', $_REQUEST);

if (isset($changed)) {
    /*
    This extract command will create the following variables:
        $event_id (Event ID)
        $changed (array defining which row was changed)
        $ynm (array of the form $ynm[INVITEE][DATE] with a value of 'y','n',m', '?' or ' ')
        $comments (array of form $comments[INVITEE])

*/
    // Get a vector of the subscripts that have the value 'changed'
    // There really should only be one.
    $changes = array_keys($changed, 'changed');

    foreach ($changes as $c) {  //Note $c will be the invitee's member_id
        //first update the comments field for invitee
        $com = slash_it($comments[$c]);
        $query = <<<QUERY
        INSERT INTO wccw_invitees (invitee_id, event_ptr, comments)
            VALUES ('$c', '$event_id', '$com')
        ON DUPLICATE KEY UPDATE
            invitee_id = '$c', 
            event_ptr='$event_id',
            comments = '$com';  
    QUERY;
        $result = do_query($query); 

        foreach ($ynm[$c] as $d => $ans) {  // Cycle through each date 
            $query = <<<QUERY
        INSERT INTO wccw_ynm (ynm_member_id, ynm_date_id, event_ptr,ynm)
            VALUES ('$c', '$d', '$event_id', '$ans')
            ON DUPLICATE KEY UPDATE
            ynm_member_id = '$c',
            ynm_date_id = '$d',
            event_ptr = '$event_id',
            ynm = '$ans';
    QUERY;
            //pre_dump('YNM Query', $query);
            $result = do_query($query); 
        }
    }
}