<?php
identifier_comment("START    forgot_id_action.php");

$first_name=ucfirst(strtolower($first_name));
$last_name=ucfirst(strtolower($last_name));
$full_name = $first_name." ".$last_name;
$result=do_query("
	SELECT userid, password, email
		FROM members, emails
		WHERE first_name='$first_name '
		AND last_name='$last_name'
		AND emails.member_ptr=members.member_id
	");
	
	$nr=mysqli_num_rows($result);
	if($nr<1) {
	 	alert( "No such member in the sickingfamily database: <font color=blue>".
		 		$full_name."</font>");
	 	return;
	}
	
	$first=TRUE;
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		$email = $row["email"];
		if($first) {
			$msg = sprintf("
				\n<br><b>
				User Name: </font><font color=red>{$row['userid']}</font>
				</p>
				Password: </font><font color=red>{$row['password']}</font>
			");
			$to = $email;
			$first = FALSE;
		}
		else $to .= ", $email";	
	}

	$subject = "sickingfamily.com username";
	$body ="
	<head>
	<style type='text/css'>
	body {font-family: Arial; margin-left: 20px; color: #69340F; background: #FFE; }
	</style>
	</head>
	<body>
	<br><br>$first_name,<br><br>
	Per your request, this is a reminder of your 
	<a href='www.sickingfamily.com'>sickingfamily.com</a> User Name and Password:<br>
	$msg
	<p>
	</body>
	";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: matt@sickingfamily.com';
	
	$success_msg = "\nA message indicating your current userid and password has been sent to each of the 
					\nemail addresses listed for you ($full_name) in the sickingfamily.com Address Book.
					\n<br><br>
					\nIf you would prefer to have a different userid or password, please log in using the 
					\nmenu item on the left, and click on the 'Change User ID or Password' option.";
	if (mail($to, $subject, $body, $headers)) {
		echo("<p>$success_msg</p>");
	}	
	else {
		echo("<p>Message delivery failed...\n(forgot_id_action.php)\n</p>");
		echo "\nTo: $to<br>";
		echo "\nSUBJECT: $subject<br>";
		echo "\nHEADERS: $headers<br>";
		echo "\nBODY: $body ";
	}
   
   
   identifier_comment("END    forgot_id_action.php"); 
