<?php 
?>
<!--
////////////////////////////////////////////////////////////////////////////////
//	Description:
//		Lists out all requested and completed enhncements to this website
//		Not curently driven by a data base.
//	
////////////////////////////////////////////////////////////////////////////////
//
-->
<div align="center">
	<h1>Sicking Family Website</h1>
		<h2>Enhancement Requests</h2>

	<table border='1' style='border-color: #FFFFFF'>
		<tr>
			<td class="TableHeader left">Enhancement</td>
			<td class='TableHeader'>Priority</td>
			<td class='TableHeader'>Done<td>
		</tr>
<?php
        add_row('Add &#10004; character to Enhancement List',2);
        add_row('Add mail list capability to any segment of the family (member, family, clan, etc.',2);
        add_row('Allow members to key in black-out dates in calendar to make it easier to schedule meetings',2);
        add_row('Polling',3);
        add_row('Add nicknames to Address Book',3);
        add_row('Gift Suggestions',2);
        add_row('List of recommended monetary gift by type of event',2);
        add_row(' ',' ');
        add_row('Address Book',2,TRUE);
        add_row('Address Book editing based on privilege level (All, clan, family, self)',2,TRUE);
        add_row('Authenticate: Access control by page and (private) content',2,TRUE);
        add_row('Authenticate: User names &amp; passwords',2,TRUE);
        add_row('Birthday list capability',2,TRUE);
        add_row('Birthdays to Address Book',2,TRUE);
        add_row('Change User ID and/or Password',1,TRUE);
        add_row('Editable Calendar of Events by all members',2,TRUE);
        add_row('Picture gallery - Thanks, Patrick!',2,TRUE);
        add_row('Updatable Address Book',2,TRUE);
        add_row('Updatable Event Lis',2,TRUE);
        add_row('Venue in Event List',2,TRUE);
        add_row('Who&apos;s bringing what - event coordinator for when everyone brings a dish',2,TRUE);
?>
	</table>
	</div>
<hr />
</p>

<?php 
function add_row($enh_text,$pri,$done=false){
    $class = "left";
    $d = ' ';
    if ($done){
        $class = "done left";
        $d = '&#10004;';
    }
    
    echo <<<ENH
    <tr>
        <td class='$class'>$enh_text</td>
        <td>$pri</td>
        <td>$d</td>
    </tr>
ENH;
}
identifier_comment("END ".__FILE__);
?>