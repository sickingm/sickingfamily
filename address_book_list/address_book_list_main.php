<?php
identifier_comment("START ".__FILE__);

/*
______________________________________________________________________________

+--------------------------------------------+
� a d d r e s s _ b o o k _ l i s t . p h p  �
+--------------------------------------------+

	NAME:	sickingfamily/address_book_list/_address_book_list.php

	USES STYLES:
			address_book.css
	Description:
		Main entry into the Address Book pages
		Creates the master page for the Address Book
		Includes options to list, edit, and show birthdays
______________________________________________________________________________
*/

// Get the posted responses to this page after Submit Button is hit
	extract($_GET);
	extract($_POST);
?>
<h1>Sicking Family Address Book</h1>
<br />
<div align='center'>
	<form method="GET" action="_address_book_list.php" id='abform'> 
		<h2>
			Select Search Method to find Name(s)
		</h2>
<?php 
	require "read_in.php";	// Get all of the clan, family, first & last names
?>

<table border="0" style="border-collapse: collapse" cellspacing="3">
<tr>
    <?php require "drop_down_top.php"; /* generate the top of the table*/ ?>
</tr>
<tr>
<?php
	require "drop_down_clans.php"; // Generate the list of clans
	require "drop_down_families.php";// Generate the list of families
	require "drop_down_names.php";// Generate the list of names - first and last
?>
 </tr>
 </table>
<?php
	include "buttons.php";
    
	
//Output the requested table	
	if (isset($show_list)||isset($return_to_list)) include "table_create.php"; 
	
	include "clan_message.php";

echo "</div>";
 

function header_cell($label,$other_stuff="") {

// Outputs a single header cell in address book
// Used by table_header.php but since this 
// source may be inserted more than once, the 
// function is defined here to avoid a ddef.

	echo "
		<th class='col_header_left' $other_stuff>
			$label
		</th>
	";
}
 
identifier_comment("END ".__FILE__);