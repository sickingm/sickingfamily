<!--****************************************************************************
			START	forgot_id.php
-->
<form method="POST" action="user_admin.php">

	<p>Enter your full name to retrieve
		<br>your User ID and Password. </p>
	<div>
		<table class='rowtable'>
			<tr>
				<th>First Name:</th>
				<td><input name="first_name" /></td>
			</tr>
			<tr>
				<th>Last Name:</th>
				<td><input type="text" name="last_name" /></td>
			</tr>
			<tr>
				<td colspan=2 r></td>
			</tr>
		</table>
		<input class="button" type="submit" value="Submit" name="forgot_id">
	</div>
</form>
<!--****************************************************************************
			END	forgot_id.php
-->