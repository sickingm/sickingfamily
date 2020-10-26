<?php
	identifier_comment("Start buttons.php");
/*
  	NAME: 	buttons.php
  
  	CALLED BY:
  			read_in.php
  
 	CALLS:	<nothing>
  
  	DESCRIPTION:
  		Creates the Submit buttons at the bottom of the menu 
________________________________________________________________________________
*/
?>
	<p>
		<input type="submit" id='display_button' value="Display Selected List" name="show_list" hidden>
	</p>
	</form>
	<form method="POST" action="../address_book_edit/_address_book_edit.php">
		<input type="submit" value="Edit By Name" name="edit_by_name">
	</form>

<?php identifier_comment("End buttons.php");