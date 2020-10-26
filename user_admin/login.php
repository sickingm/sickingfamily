<?php
/*
    This is the first thing that pops up when hte user selects "Login" fron the User Admin menu
    It acceptes user login/password inputs and sends them back the main program
    The main program  in turn requires login_action to execute and determine if the login is vlid.
    If so it returns success
    If not, it calls login.php again.
    
*/
identifier_comment("START	logon.php");
	if(isset($logged_in) && $logged_in)echo "<b>Please log off first.</b><br>";
	else 
	{echo <<<OUT
    <div id="auth-form" >
    	<form method="POST" id="authenticate-form" action="user_admin.php">
    		<table>
    			<caption>
    				Log on:<br />
    				Enter User ID and Password
    			</caption>
    			<tr>
    				<th>User Name:</th>
    				<td><input name="txtUserId" size="20" /> </td>
    			</tr>
    			<tr>
    				<th>Password:</th>
    				<td>
    				<input type="password" name="txtPassword" size="20"  /></td>
    			</tr>
    			<tr>
    				<td>&nbsp;</td>
    				<td><input type="submit" value="Submit" name="login" /></td>
    			</tr>
    		</table>
    	</form>
    </div>
OUT;
       
}
identifier_comment("END	logion.php");