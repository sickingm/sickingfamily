<?php
require_once "$doc_root/common/utility_functions.php";
identifier_comment('BEGIN ' . __FILE__);
global $db_link, $doc_root;

//debug_on();


require_once("$doc_root/creds/creds_db.inc");
require_once('../data_base.php');

$db_link = connect_and_select();

class WCCW
{
    /*
*  Who Can Come When
*      
*  This class provides all of the creation, editing, and deleting functions required for a WCCW
*  including the database reads, writes and deletes
*  includes the following methods: 
*       int new - Creates a new event object
*                 
*      bool save() - Saves current WCCW details in database
*       int load_event($id) - loads all data from db for the event whose event_id=$id 
*       int add_dates(array $dates) - adds dates to the list of proposed dates
*       int remove_dates(array $dates) - removes dates from the list (also removes all related ynms of those dates)
*       int add_invitees($invitee_IDs) - adds names top the list of invitees
*       int remove_invitees($invitee_IDs) - removes names from the list of invitees
*       int set_ynms(int $invitee_ptr, date $date_ptr) - For a given user and date, defines the ynm
*/
    public $event_id;       // Key to WCCW in the MySQL database (wccw_events table)
    public $title;          // Short title of event
    public $details;        // Detailed details of event
    public $organizer_ptr;  // member_id of event organizer
    public $organizer_name; // name of organizer
    public $is_private;     // ENUM: 'private' if visible only to invitees; 'public' is default.
    public $dates;          // Array of proposed dates
    public $date_list;      // String of dates comma separated
    public $invitees;       // Array of invitees
    public $chkbox;         // Helper vector (=on when invitee is invited)
    public $comments;       // Array of comments by invitee
    public $ynm;            // Array of ynm by invitee and date


    /*
 Member functions are:
    function __construct() 
    function load()
    function save()
    function delete()
    function get_title()
    function set_title($title)
    function get_details($member_id)
    function set_details($details)
    function get_is_private()
    function set_is_private($is_private)
    function add_dates($new_dates)
    function remove_dates($former_dates)
    add_date_list ???
    remove_date_list ???
    function add_invitees($updated_invitees)
    function get_comments($invitee)
    function set_comments($invitee, $comments)
    function set_ynms($invitee_ptr, $date, $ynm)
*/

    /********************************************************
     *  _ _ C O N S T R U C T                               *
     ********************************************************/
    public function __construct()
    {
        // Creates the initial event header data
        // Does not include the events, invitees or ynms for the event

        global $db_link;

        $this->event_id = -1;  // event_id is not defined until object is saved in db (see commit method)
        $this->title = 'TBD';
        $this->details = 'TBD';
        $this->organizer_ptr = $_SESSION['member_id']; // Always the currently logged on member; never changes
        $this->organizer_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];  // Ditto for the organizer name, of couse
        $this->is_private = 'public';
        $this->dates = [];
        $this->date_list = '';
        $this->invitees = [];
        $this->chkbox = [];
        $this->comments = [];
        $this->ynm = []; //2D array: ynm[invitee_id][date]
    }

    /********************************************************
     *  L O A D                                             *
     ********************************************************/
    public function load($event_id)
    {  //Loads stored data from db (for a specified event) into object
        global $db_link;
        if ($event_id <= 0) {
            echo "Cannot load event; Non-existent (zero value) event_id.";
            die();
        }

        $this->event_id = $event_id;
//pre_dump("Event ID is ",$this->event_id);
// Part 1, Load all header data
        $Q = "SELECT * FROM wccw_events WHERE event_id='$this->event_id' LIMIT 1";
        $result = do_query($Q, "Query to load event header data");
        while ($row = $result->fetch_assoc()) {
            $this->title = $row['title'];
            $this->details = $row['details'];
            $this->organizer_ptr = $row['organizer_ptr'];
            $this->is_private = $row['is_private'];
            $this->organizer_name = get_member_name($this->organizer_ptr);
        }


// Part 2. Get all Invitees
        // initialize array
        $this->invitees = array();
        // Get all invitee records for this event,  includes the comments from the invitee
        $Q = "SELECT 
                invitee_id, event_ptr, wccw_invitees.comments, 
                concat(first_name,' ',last_name) AS full_name 
                FROM wccw_invitees, members
                WHERE event_ptr='{$this->event_id}'
                AND member_id=invitee_id 
                AND event_ptr=$event_id;";

        $result = do_query($Q, "Query to get invitees for event_id: $this->event_id");
        // Cycle through all invitee records and store them in this object
        // Also create helper chkbox 
        while ($row = $result->fetch_assoc()) {
            $uid = $row['invitee_id'];
            $this->invitees[$uid] = $row['full_name'];
            $this->comments[$uid] = $row['comments'];
            $this->chkbox[$uid]='on';
        }
   

// Part 3. Get all Dates
        // initialize array
        $this->dates = array();
        // Get all date records for this event
        $Q = "SELECT * FROM wccw_dates WHERE event_ptr='$this->event_id'";
        $result = do_query($Q, "Query to get dates for event_id: $this->event_id");
        // Cycle through all date records and store them in this object
        while ($row = $result->fetch_assoc()) {
            $this->dates[] = $row['date'];
        }
        $this->date_list = implode(',',$this->dates);


// Part 4. Get all ynms
        // Get all date records for this event
        $Q = "SELECT * FROM wccw_ynm WHERE event_ptr='$this->event_id'";
        $result = do_query($Q, "Query to get dates for event_id: $this->event_id");
        // Cycle through all ymn records and store them in this object
        while ($row = $result->fetch_assoc()) {
            $i = $row['ynm_member_id'];
            $d = $row['ynm_date_id'];
            $this->ynm[$i][$d] = $row['ynm'];
        }

    }

    /********************************************************
     *  S A V E                                             *
     ********************************************************/
    public function save()
    {
        // Updates the database with complete event data 
        // if $event_id <0 or doesn't exist this indicates that a new record should be created in the db
        // Otherwise the record indicated by $event_id should be updated
        global $db_link;
        $title_slashed = addslashes($this->title);
        $details_slashed = addslashes($this->details);
        // Save Event Header Info
        if (!isset($this->event_id) or $this->event_id < 0) { // new event not yet saved 
            $Q = "INSERT INTO wccw_events 
                    (        title,          details,          organizer_ptr,         is_private) 
                    VALUES  ('$title_slashed', '$details_slashed', '$this->organizer_ptr', '$this->is_private');";
            $result = do_query($Q, "Save header data");
            $this->event_id = $db_link->insert_id;  // Save newly defined event ID into $this->event_id

        } else {  // Existing event so update record
            $Q = "UPDATE wccw_events 
                    SET 
                    title        = '$title_slashed',
                    details      = '$details_slashed',
                    organizer_ptr= '$this->organizer_ptr',
                    is_private   = '$this->is_private'
                    WHERE event_id='$this->event_id'";
                $result = do_query($Q);
        }

        //Save Dates for this event
        if (!empty($this->dates)) {
            foreach ($this->dates as $date) {
                $Q = "
                    INSERT INTO wccw_dates (date, event_ptr)
                    VALUES ('$date', '{$this->event_id}') 
                    ON DUPLICATE KEY UPDATE
                    event_ptr='{$this->event_id}';";
                $result = do_query($Q);
            }
        }

        //Save Invitee data for this event (including comments)
        if (!empty($this->invitees)) {
            foreach ($this->invitees as $uid => $invitee_ptr) {
                $comments_slashed = isset($invitee[1]) ? addslashes($invitee[1]) : "";
                $Q = "
                    INSERT INTO wccw_invitees (invitee_id, event_ptr, comments) 
                    VALUES('{$invitee_ptr[0]}', '$this->event_id', '$comments_slashed')
                    ON DUPLICATE KEY UPDATE
                    event_ptr='$this->event_id',
                    comments='$comments_slashed';";
d($Q);
                $result = do_query($Q, 'Insert invitee query');
            }
        }
        //Save ynm data for this event
        if (!empty($this->ynm)) {
            foreach ($this->ynm as $member => $dates) {
                foreach ($dates as $date => $ynm) {
                    $Q = "
                        INSERT INTO wccw_ynm (ynm_member_id, ynm_date_id, event_ptr, ynm) 
                        VALUES('$member', '$date', '{$this->event_id}', '$ynm')
                        ON DUPLICATE KEY UPDATE
                        ynm ='$ynm';";
                    $result = do_query($Q);
                }
            }
        }
        return;
    }

    /********************************************************
     *  D E L E T E                                         *
     ********************************************************/
    public function delete()
    {  //deletes an entire event.
        // Cascading database will delete all the associated dates, invitees, and ynms
        //  But it's not clear whether it's important to unset the corresponding variables.
        // I think not because directly after a Delete there should be a return to the list page
        // thereby, resetting the wccw data in memory
        global $db_link;
        do_query("DELETE FROM wccw_availabiliy WHERE event_id='$this->event_id'");
    }

    /********************************************************
     *  G E T _ T I T L E                                   *
     ********************************************************/
    public function get_title() {
        return $this->title;
    }

    /********************************************************
     *  S E T _ T I T L E                                   *
     ********************************************************/
    public function set_title($title) {
        $this->title = $title;
    }

    /********************************************************
     *  G E T _ D E T A I L S                               *
     ********************************************************/
    public function get_details($member_id) {
        return $this->details[$member_id];
    }

    /********************************************************
     *  S E T _ D E T A I L S                               *
     ********************************************************/
    public function set_details($details) {
        $this->details = $details;
    }

    /********************************************************
     *  G E T _ I S _ P R I V A T E                          *
     ********************************************************/
    public function get_is_private() {
        return $this->is_private;
    }

    /********************************************************
     *  S E T _ I S _ P R I V A T E                         *
     ********************************************************/
    public function set_is_private($is_private) {
        $this->is_private = $is_private;
    }

    /********************************************************
     *  A D D _ D A T E S                                   *
     ********************************************************/
    public function add_dates(array $new_dates) {
        if(count($new_dates)==0) return;
        if (empty($this->dates)) { // if doesn't exist then $new_dates contans all dates
            $this->dates = $new_dates;
        } else {
            $added_dates = array_diff($new_dates, $this->dates);
            $this->dates = array_merge($this->dates, $added_dates);
        }
        $this->date_list = implode(',', $this->dates);
    }

    /********************************************************
     *  R E M O V E _ D A T E S                             *
     ********************************************************/
    public function remove_dates(array $former_dates)
    {
        global $db_link;
        if(count($former_dates)==0) return;
        $this->dates = array_diff($this->dates, $former_dates);  //keep dates in $this but not in $former
        if ($this->event_id < 0) return;  

        // Otherwise we need to delete all corresponding date records
        $Q = "DELETE FROM wccw_dates 
                WHERE event_ptr='$this->event_id'
                AND date IN ('" . implode("', '", $former_dates) . "')";
        do_query($Q, "Query to delete some dates");
    }

    /********************************************************
     *  U P D A T E _ D A T E S                             *
     ********************************************************/
    public function update_dates(array $new_dates) {

        if (count($new_dates)==0) return;
        // Drop any dates not in $new_dates
        $dropped = array_diff($this->dates, $new_dates);
        if(count($dropped) >0) $this->remove_dates($dropped);

        // Add any new dates
        $added = array_diff($new_dates,$this->dates);
        if(count($added) >0) $this->add_dates($added);
        
        $this->date_list = implode(",",$this->dates);
    }
    /**************************************************************
     *  U P D A T E _ I N V I T E E S                             *
     **************************************************************/
    public function update_invitees($updated_invitee_list)
    {
        if (!isset($this->invitees)) // if doesn't exist then $updated_invitee_list contans all invitees
            $this->invitees = $updated_invitee_list;
        else {
            //Delete any removed invitees
            foreach ($this->invitees as $i=>$inv){
                if(!in_array($inv,$updated_invitee_list)) {  //Check if saved invitee in db is still in posted vars
                    $Q = "DELETE FROM wccw_invitees WHERE invitee_id=$i";
//pre_dump('Query:',$Q);
                    do_query($Q);
                    unset($this->invitees[$i]);
                    unset($this->invitee_names[$i]);
                }
            }
            foreach ($updated_invitee_list as $updated_invitee) {
                if (!(in_array($updated_invitee, $this->invitees))) {
                    $this->invitees[] = array($updated_invitee, "EMPTY COMMENTS"); // invitee ID, comment 
                }
            }
        }
        // Update invitee names list
        $invitee_list = implode(',', array_column($this->invitees,0));

        $query = "
            SELECT member_id, CONCAT(first_name,' ',last_name) AS full_name
                FROM members
                WHeRE member_id IN ($invitee_list)";
            $result=do_query($query);
        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $i=$row['member_id'];
            $this->invitee_names[$i]=$row['full_name'];
        }
    }

    /********************************************************
     *  G E T _ C O M M E N T S                             *
     ********************************************************/
    public function get_comments($invitee)
    {
        return $this->comments[$invitee];
    }

    /********************************************************
     *  S E T _ C O M M E N T S                             *
     ********************************************************/
    public function set_comments($invitee, $comments)
    {
        $this->comments[$invitee] = $comments;
        return;
    }

    /********************************************************
     *  G E T _ Y N M s                                     *
     ********************************************************/
    public function get_ynms($member_ptr, $date)
    {
        return $this->ynm[$member_ptr][$date];
    }

    /********************************************************
     *  S E T _ Y N M S                                     *
     ********************************************************/
    public function set_ynms($invitee_ptr, $date, $ynm)
    {
        $this->ynm[$invitee_ptr][$date] = $ynm;
    }
} 
// end class
