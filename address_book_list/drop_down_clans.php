<?php
identifier_comment("START	drop_down_clans.php");
/*
  	NAME: 	drop_down_clans.php
  
  	CALLED BY:
  			read_in.php
  
 	CALLS:	<nothing>
  
  	DESCRIPTION:
  		Creates the Clan drop-down list in the Address Book header 
________________________________________________________________________________
*/
?>
<td align="center">
	<font color="#FFFFFF" face="Arial">
		<select size="1" name="clan"   onchange='document.getElementById("display_button").click();'>
			<option value="*">[any]</option>

			<?php

			for ($i = 0; $i < sizeof($clan_id); $i++) {
				echo '<option value="' . $clan_id[$i] . '">' . $clan_name[$i] . '</option>';
				echo "\n";
			}
			echo "\n
        </select>\n</font>
    </td>";

			identifier_comment("END		drop_down_clans.php");
