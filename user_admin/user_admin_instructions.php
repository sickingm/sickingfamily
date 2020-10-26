<?php 
identifier_comment("START instructions.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +---------------------------------+
//  ¦ i n s t r u c t i o n s . p h p ¦
//  +---------------------------------+
//
//	NAME:	instructions.php
//
//	CALLED BY:
//			_user_administration_navigation.php
//
//	CALLS:
//		<none>
//
//	INCLUDES:
//		<none>
//
//	CONTAINS:
//		href_if (Utility functions to conditionally wrap a string in an <a href> link)
//
//	USES STYLES:
//		<none>
//			
//	Description
//		Prints out some bare-bones instructions on how to use the User Admin  (aka LogIn/LogOut) page
//			
////////////////////////////////////////////////////////////////////////////////
// 

	$logged_in = !empty($_SESSION["authenticated"]);
	$clan_family = isset($_SESSION["edit_privilege"]) && $_SESSION["edit_privilege"]!="self" && $logged_in;
/*
alert('This is an error-msg  Alert','error-msg');
alert('This is a message Alert','message');
alert('This is an info Alert','info');
alert('This is a success Alert','success');
*/
?>

<h2>Instructions</h2>
<p>
	This page should be generally self explanatory to Sicking Family members.&nbsp;&nbsp;You must 
	<?php href_if(!$logged_in,'../user_admin/user_admin.php?admin=login','Log In'); ?>
	in order to access those pages of this website with sensitive data 
	(<?php href_if($logged_in,'../address_book_list/address_book_list.php','Address Book'); ?>)
	or those that need to know who you are in order to work properly 
	(<?php 
	href_if($logged_in,'../events/events.php','Events'); 
	echo ", ";
	href_if($logged_in,'../wccw/wccw.php','Who Can Come When');
	?>)
</p>
<p>
	You have been assigned an initial User ID 
	- generally it&#39;s your first name.&nbsp;&nbsp;
	If there is another older family member with the same first name as you, 
	then your member name will be your first name followed by your last initial, 
	or by your middle and last initial.&nbsp;&nbsp;
</p>
<p>
	You also have been assigned an initial password,
	which you should 
<?php
	href_if($logged_in,'user_admin.php?admin=change_id','change');
?>
	to something you find more convenient to remember.&nbsp;&nbsp;
	User ID&#39;s and passwords are not case sensitive,
	nor are they required to be any particular length, 
	or contain at least one special character or whatever.&nbsp;&nbsp; 
	That seems overkill for what we need them for. 
</p>
<p>
	You may 
	<?php href_if($logged_in,'user_admin.php?admin=change_id','change your User ID or Password'); ?> 
	to anything you prefer as long as it&#39;s not already taken by someone else.&nbsp;&nbsp;
	If you don&#39;t remember your password, click on the 
	"<?php href_if(!$logged_in,'user_admin.php?admin=forgot_id','Forgot User ID or Password');?>"
	option to have your username and password will be mailed to you.
</p>
<p>
	If you are the head of a clan or family an additional option will appear: 
	"<?php href_if($clan_family, 'user_admin.php?admin=edit_clan_and_family', 'Edit Family and Clan data'); ?>".
	&nbsp;&nbsp;This will allow you to:
	<ol>
		<li>Add new families to your clan.</li>
		<li>Edit the information associated with families in your clan.</li>
		<li>Delete families from your clan.</li>
		<li>Add new members to your family.</li>
		<li>Delete members from your family.</li>
	</ol>
<p>
(Note, to edit details of a particular family member, use the 
<a href='../address_book_edit/address_book_edit.php'>Address Book Edit</a>
function)
<?php
	echo "\n</p>";
function href_if($switch, $href, $text) {
// Outpouts text and, optionally if $switch is true, surrounds it with an <a> tag with href
	if($switch) echo "<a href='$href'>";
	echo $text;
	if($switch) echo "</a>";
}
identifier_comment("END instructions.php"); 