<?php
    function get_member_name($member_id) 
    //returns full member name given the member id
    {
        $result=do_query("Select concat(first_name,' ',last_name) AS full_name from members where member_id=$member_id");
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
        if(mysqli_num_rows($result) >0)
            return $row['first_name'].' '.$row['last_name'];
        else 
            return "Unknown Member ID";
    }
?>