<?php
identifier_comment("START clan_message.php");
////////////////////////////////////////////////////////////////////////////////
//
//  +---------------------------------+
//  ¦ c l a n _ m e s s a g e . p h p ¦
//  +---------------------------------+
//
//	NAME:	clan_message.php
//
//	CALLED BY:
//		_list.php
//
//	CALLS:
//		<none>
//
//	INCLUDES:
//		<none>
//
//	CONTAINS:
//		<none>
//
//	USES STYLES:
//		<none>
//			
//	Description
//		Outputs an informational message about where to go (User Admin page)
//		If the user desires to add, delete or update clan or family information;
//
//		It only prints out the message(s) if the user has 'all', 'clan, or 
//		'family' privilege.
//	
////////////////////////////////////////////////////////////////////////////////
//


	if($_SESSION["edit_privilege"] == "self") return;  // No messages required if privilege 
														 // is limited to self

	echo "<br>To add, delete, or edit ";
	
	if($_SESSION["edit_privilege"] == "Clan" OR $_SESSION["edit_privilege"] == "all") echo "Clan or ";
	echo "Family information, go to the <a href='../../user_admin/_user_admin.php'>User Admin</a> page.";

identifier_comment("END clan_message.php");