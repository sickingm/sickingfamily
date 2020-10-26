<?php 
identifier_comment("START	change_id.php");
//debug_on();
?>
<!-- Change USER ID and/or Password		-->
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
<table class='rowtable'>
	<caption>Change your User ID and/or Password:</caption>
	<tr><th>New User ID:</th>
        <td><input name="new_userid"  value = <?php if(isset($_SESSION["userid"])) echo $_SESSION["userid"]; ?>
	></td></tr>
	<tr><td colspan=2</td></tr>
	<tr><th>New Password:</th>        <td><input name="new_password" type="text" size="20" /></td></tr>
	<tr><th>Repeat Password:</th> <td><input name="repeat_password" size="20" /></td></tr>
	<tr><td></td></tr>
</table>
<input name="change_id" class="button" type="submit" value="Submit" />
</form>
<?php 
identifier_comment("END	change_id.php")
?>