<?php
identifier_comment("START	drop_down_names.php");
/*   ______________________
 	|                      |
	| drop_down_names.php  |
	|______________________|
 	
 	CONTAINS:
 		drop_names()
 		
  	CALLED BY:
		n/a

	INCLUDED BY:
		read_in.php
			
	CALLS:
		drop_names()
	
	INCLUDES:
		<nothing>

	DESCRIPTION:
		Creates the First and Last name drop-down lists in the Address Book header
________________________________________________________________________________

*/
drop_names($first_name, "first");
drop_names($last_name, "last");


function drop_names($name, $fl)
{
?>
	<td align="center">
		<font color="#FFFFFF" face="Arial">
			<select size="1" name="<?php echo $fl; ?>" onchange='document.getElementById("display_button").click();'>
				<option value="*">[any]</option>

			<?php
			for ($i = 0; $i < sizeof($name); $i++) {
				echo "<option value=\"$name[$i]\">$name[$i]</option>\n";
			}
			echo "</select></font>
</td>\n";
		}

		identifier_comment("END		drop_down_names.php");
