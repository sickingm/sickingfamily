<!-- BEGIN address_book_edit_main.php -->

<?php
//////////////////////////////////////////////////////////
//                                                      //
// a d d r e s s _ b o o k _ e d i t _ m a i n . p h p  //
//                                                      //
//////////////////////////////////////////////////////////
//
//	NAME:	address_book_edit_main.php
//
//	CALLED BY:
//			_address_book_edit.php
//
//	CALLS:
//			authenticate_user (from common/authentication.php)	
//
//	INCLUDES:
//			top.php
//			select_member.php
//	 		member_data.php
//			email_and_phones.php
//			cancel_button.php
//
//	CONTAINS:
//			edit_submit_button();
//
//	USES STYLES:
//			master.css
//			<other>.css
//			
//	Description
//			Provides ability to edit member data
//	
////////////////////////////////////////////////////////////////////////////////
//

identifier_comment("START " . __FILE__);

extract($_REQUEST); // load all the post &get variables 

?>
<div align="center">
	<p style="margin-bottom: 5px"><u><b>
				<font size="5" color="#000000">Sicking Family Address Book</font>
			</b></u></p>
	<?php
	// Validate User

	if (!empty($do_update) && $do_update == 1) include "update.php";

	include "select_member.php";
	if (isset($who)) {
		include "get_privileges.php";  // Determine edit permission level for current user
		include "member_data.php";  // Output the data for the selected member
		include "email_and_phones.php"; // Output email and phone data 
	}
	include "cancel_button.php";

	echo "</div>";

	function edit_submit_button($priv)
	{
		if ($priv)
			echo '<input type="submit" value="Submit" name="B2">&nbsp;&nbsp;
		  <input type="reset" value="Reset" name="B3">';
		else echo "<b><font color='#FF0000'>You do not have permission to edit this record!</font></b><br>\n";
		return;
	}

	identifier_comment("END " . __FILE__);
	?>
	.