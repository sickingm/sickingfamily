<?php
identifier_comment("START	drop_down_families.php");
/*
  	NAME: 	drop_down_families.php
  
  	CALLED BY:
  			read_in.php
  
  	CALLS:	<nothing>
  
  	DESCRIPTION:
  		Creates the Family drop-down list in the Address Book header 
________________________________________________________________________________
*/
?>
<td align="center">
	<font color="#FFFFFF" face="Arial">
		<select size="1" name="family" onchange='document.getElementById("display_button").click();'>
			<option value="*">[any]</option>

			<?php
			for ($i = 0; $i < sizeof($family_id); $i++) {
				echo '<option value="' . $family_id[$i] . '">' . $family_name[$i] . '</option>';
				echo "\n";
			}

			echo "\n
    </select>\n</font>\n
 </td>";
			identifier_comment("END		drop_down_families.php");
