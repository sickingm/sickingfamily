<?php
identifier_comment("START	".__FILE__);
/*
  	NAME: 	drop_down_top.php
   
  	CALLED BY:
  			read_in.php
			  
	CALLS:	<nothing>
  
  	DESCRIPTION:
  		Generates the top header of the address book which allows the 
  		user to select the clan, family, first name, and/or last name
  		for which they want an address book listing
  		(This creates the header only, not the actual drop-downs.)
________________________________________________________________________________
*/
?>
				<td class="drop-down">Clan</td>
				<td class="drop-down">Family</td>
				<td class="drop-down">First Name</td>
				<td class="drop-down">Last Name</td>
<?php
identifier_comment("END		drop_down_top.php");