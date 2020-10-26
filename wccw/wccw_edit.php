<?php
function wccw_edit($event_id) { // Edits event $event_id

        global $my_event;
        extract($_REQUEST);
        $my_event = new WCCW();
        $my_event->load($event_id);
        $where = '';
        // Get the overall Page Template for entering a new Event
        // and load with any items that have just been entered 
        // (Page could have been submitted without Save request 
        // in order to load the set of users to select invitees from)
        $page = file_get_contents('wccw_edit_1_master.php');

        // Organizer is always whoever is logged on
        $page = str_replace('##ORGANIZER_NAME##', $_SESSION['first_name'] . ' ' . $_SESSION['last_name'], $page);
        $page = str_replace('##MEMBER_ID##', $_SESSION['member_id'],  $page);

        // And Organizer is always on the invitee list
        $my_event->chkbox[$_SESSION['member_id']] = 'on';

        // Put the title and details into the form
        if (empty($my_event->title)) $my_event->title = "";
        $page = str_replace("##TITLE##", $my_event->title, $page);
        $page = str_replace("##EVENT_ID##", $my_event->event_id, $page);
        if (empty($my_event->details)) $my_event->details = "";
        $page = str_replace("##DETAILS##", $my_event->details, $page);

        // Show privacy status
        $page = str_replace("##PRIVATE_CHECKED##", (isset($my_event->is_private) ? "checked" : ""), $page);


    // This section is the logic for choosing among the various ways of selecting invitees
    // It allows for selectin from All members, DBC , Gen3 , Family heads, or specific families or clans.
    // This is effected by defining a variable $where which will be the WHERE clause to append to
    // the MySQL statement selecting the potential invitees.
        if (isset($invitee_group)) {
            switch ($invitee_group) {
                case 'all':
                    $where = 'TRUE';
                    break;
                case 'dbc':
                    $where = "dbc='Y'";
                    break;
                case 'gen3':
                    $where = "dbc != 'Y'";
                    break;
                case 'family_heads':
                    $where = "edit_privilege IN ('family','clan','all')";
                    break;
                case 'family':
                    $where = "family_ptr='$invitee_family'";
                    $page = str_replace("//##DROPDOWN_PICKED##", 'dropdowns("family", "clan");', $page);
                    break;
                case 'clan':
                    $where = "family_ptr=family_id AND clan_ptr = '$invitee_clan'";
                    $page = str_replace("//##DROPDOWN_PICKED##", 'dropdowns("clan", "family");', $page);
                    break;
                default:
                    $where = "FALSE";
            }

            // Now ensure that the proper radio button istill checked when resending the page
            $page = selectability($invitee_group, $page);
        } else $where = 'FALSE';
        $where .= " OR member_id IN (" . implode(',', array_keys($my_event->chkbox)) . ')';

        $cmax = 5;
        $ccnt = 0;
        $clist = '';

        // Display selected family or clan, as appropriate
        if (isset($invitee_group)) {
            $fclass = 'wccw-new-' . ($invitee_group == 'family' ? '' : 'in') . 'visible';
            $cclass = 'wccw-new-' . ($invitee_group == 'clan' ? '' : 'in') . 'visible';
        } else {
            $fclass = 'wccw-new-invisible';
            $cclass = 'wccw-new-invisible';
        }
        $page = str_replace('##FAMILY_INITIAL_CLASS##', $fclass, $page);
        $page = str_replace('##CLAN_INITIAL_CLASS##', $cclass, $page);

    //Get the candidate invitees

        if (empty($my_event->chkbox)) $my_event->chkbox = array(null);
        foreach ($my_event->invitees as $i=>$inv){
            $my_event->chkbox[$i]='on';
        }
        $query = "SELECT 
            member_id, userid, edit_privilege, dbc, 
            concat(first_name,' ',last_name) AS full_name, 
            family_ptr, 
            member_id IN (" . implode(',', array_keys($my_event->chkbox)) . ")  AS checked
            FROM members,families 
            WHERE family_ptr=family_id AND ($where  OR member_id='{$_SESSION['member_id']}')";

        $query .= ' ORDER BY checked DESC, last_name, first_name';
        $result = do_query($query);
        while ($row = mysqli_fetch_assoc($result)) {
            $candidates[$row['member_id']] = $row['full_name'];
        }
        // Load the candidates onto the page
        if (empty($candidates)) $candidates = array("");
        foreach ($candidates as $c => $candidate) {
            if ($ccnt++ >= $cmax) {
                $clist .= "<br>\n";
                $ccnt = 1;
            }
            $clist .= "<input type='checkbox' name = 'chkbox[$c]' id='$c'";
            if (isset($my_event->chkbox[$c])) $clist .= ' checked ';
            $clist .= ">\n<label for='$c'>$candidate</label>\n";
        }
        $page = str_replace("##INVITEES##", $clist, $page);


        // Load the Families into the drop down list
        if (empty($invitee_family)) $invitee_family = null;
        $query = 'SELECT family_id, family_name FROM families';
        $result = do_query($query);
        $flist = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $flist .= "<option value='" . $row['family_id'] . "'";
            if ($row['family_id'] == $invitee_family) $flist .= " selected";
            $flist .= ">" . $row['family_name'] . "</option>\n";
        }
        $page = str_replace('##FAMILY_OPTIONS##', $flist, $page);

        // Load the Clans into the drop down list
        if (empty($invitee_clan)) $invitee_clan = null;
        $query = 'SELECT clan_id, clan_name FROM clans';
        $result = do_query($query);
        $clist = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $clist .= "<option value='" . $row['clan_id'] . "'";
            if ($row['clan_id'] == $invitee_clan) $clist .= " selected";
            $clist .= ">" . $row['clan_name'] . "</option>\n";
        }
        $page = str_replace('##CLAN_OPTIONS##', $clist, $page);

        if (isset($my_event->date_list)) $page = str_replace("placeholder='Click here to select dates'>", ">$my_event->date_list", $page);

        echo $page;
        if (isset($save_event)) echo "SAVING....<br/>";
    }

    function selectability($selection, $page) {
        /* of the five types of groupings (all, dbc, gen3, family heads, family and clan)
        one will be set "checked" (the $seletion on) 
        and the others will be unset (no "checked" indicator)
    */

        $sel_types = array('all', 'dbc', 'gen3', 'family_heads', 'family', 'clan');
        foreach ($sel_types as $st) {
            $page = str_replace("##SELECT_" . strtoupper($st) . "##", ($st == $selection ? "checked" : ""), $page);
        }
        return $page;
    }

    identifier_comment("END " . __FILE__ . " Line # " . __LINE__ . " FUNCTION: " . __FUNCTION__);