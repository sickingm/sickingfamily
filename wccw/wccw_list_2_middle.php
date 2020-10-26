<!-- <?pho identifier_comment("BEGIN " . __PATH__ . " Line Number ".__LINE__); ++++++++++++++++++++++++++++++++++++++++++ -->

<tr class='wccw-list-row'>
    <!-- BEGIN display_description() ++++++++++++++++++++++++++++++++ -->
    <td>
        <a class='wccw-list-title' title='View Event' href='_wccw.php?cmd=poll&event_id=##EVENT_PTR##'>##EVENT_PTR## ++++ ##TITLE##</a>
        <br>
        <p class='wccw-list-description'>##DETAILS##</p>
        <p>Organized by <span class='wccw-list-organizer'>##ORGANIZER##</span> ##PRIVACY##</p>

        <a title='Send email to all invitees' onClick="email_window=window.open(
                            '../wccw_email/wccw_email.php?unknown_responder=0&event_ptr=##EVENT_PTR##', 'email_window', 
                                'width=660, height=730, toolbar=yes, location=yes, menubar=yes, scrollbars=yes'
                            );">
            <img src='../images/envelope_icon.bmp' alt='mail'>
        </a>
        <a title='Send email to only those invitees who have not responded'  onClick="email_window=window.open(
                            '../wccw_email/wccw_email.php?unknown_responder=1&event_ptr=##EVENT_PTR##', 
                            'email_window, width=660, height=730, toolbar=yes, location=yes, menubar=yes, scrollbars=yes'
                        );">
            <img src='../images/envelope_unknown_icon.bmp' alt='mail'>
        </a>
<span style='display:##IS_ORGANIZER##'>
        <a title='Edit This Event' href='_wccw.php?cmd=edit&event_id=##EVENT_PTR##'>
            <img src='../images/edit_icon.png' alt='edit'>
        </a>

        <a title='Delete This Event' href='./_wccw.php?cmd=delete&event_id=##EVENT_PTR##' >
            <img src='../images/delete_icon.png' alt='delete'>
        </a>
</span>
    </td>
    <!-- END display_description() ++++++++++++++++++++++++++++++++++ -->
    <!-- BEGIN display_dates() ++++++++++++++++++++++++++++++++++++++ -->
    <td class='wccw-lists'>
        ##DATES##
    </td>
    <!-- BEGIN display_invitees() +++++++++++++++++++++++++++++++++++ -->
    <td class='wccw-lists'>
        ##INVITEES##
    </td>
</tr>
<!-- END wccw_list_2_middle.php ++++++++++++++++++++++++++++++++++++++++++ -->