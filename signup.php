<?php
session_start();
session_destroy();
$msg = "";

include 'sql.php';

if (isset($_POST['register'])) {
	$eadd = $_POST['eadd'];
	$unem = $_POST['unem'];
	$pword = $_POST['pword'];
	$rpword = $_POST['rpword'];
	$fnem = $_POST['fnem'];
	$lnem = $_POST['lnem'];
	
	if(($eadd == "") OR ($unem == "") OR ($fnem == "") OR ($lnem == "")){
		$msg = "Please supply each field.";
	}
	else if($pword != $rpword){
		$msg = "Password did not match.";
	}
	else{
		$SQL = "SELECT * FROM user_profile";
		$result = mysql_query($SQL);
		while ($db_field = mysql_fetch_assoc($result)) {
			$a = $db_field['username'];
			$b = $db_field['email'];
			if($a == $unem){
				$msg = "Username is not available.";
			}
			else if($b == $eadd){
				$msg = "Email address is not available.";
			}
			else{
				$ver = rand();
				$SQL = "INSERT INTO user_profile (`email`, `username`, `password`, `fname`, `lname`, `verification_code`) VALUES ('$eadd', '$unem', '$pword', '$fnem', '$lnem', '$ver')";
				mysql_query($SQL);
				//define the receiver of the email
				$to = $eadd;
				//define the subject of the email
				$subject = 'verification code';
				//define the message to be sent. Each line should be separated with \n
				$message = $ver;
				//define the headers we want passed. Note that they are separated with \r\n
				$headers = "From: ramprasathb@outlook.com\r\nReply-To:ramprasathb@outlook.com";
				//send the email
				$mail_sent = @mail($to, $subject, $message, $headers);
				//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
				print("<script>location.href = 'verify.php'</script>");
			}
		}
	}
}
?>

<html>
<head>
<title>Signup
</title>
</head>
<body link="#0066FF" vlink="#6633CC" bgcolor="#FFFFCC" background="images/image001.jpg" style='margin:0'>

<div style="top:20; left:270; position:absolute; z-index:1;">
<h1>Online Task Management System</h1>
</div>

<div style="top:150; left:20; position:absolute; z-index:1;">

<table>
<tr><td>
<a href = "index.php"><img border = "none" src = "images/home.gif"></img></a>
</td></tr>

<tr><td>
<a href = "about.php"><img border = "none" src = "images/about.gif"></img></a>
</td></tr>

</table>
<div style="top:0; left:170; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>
</div>

</div>

<div style="top:-20; left:38; position:absolute; z-index:1;">
<div style="top:180px; left:310px; width:500px; height:320px; position:absolute; overflow:auto; z-index:1">
<form name='signup_form' method='post' action='signup.php'>
<table border = "0">
<tr>
	<th align = 'right'>Email Address*:</th>
	<td><input name = 'eadd' type = 'text' value = ''></td>
</tr>
<tr>
	<th align = 'right'>Username*:</th>
	<td><input name = 'unem' type = 'text' value = ''></td>
</tr>
<tr>
	<th align = 'right'>Password:</th>
	<td><input name = 'pword' type = 'password' value = ''></td>
</tr>
<tr>
	<th align = 'right'>Retype Password:</th>
	<td><input name = 'rpword' type = 'password' value = ''></td>
</tr>

<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>

<tr>
	<th align = 'right'>First Name*:</th>
	<td><input name = 'fnem' type = 'text' value = ''></td>
</tr>
<tr>
	<th align = 'right'>Last Name*:</th>
	<td><input name = 'lnem' type = 'text' value = ''></td>
</tr>
<tr>
	<td colspan = '2' align = 'right'>
	<font color = 'red' size = '2'><b>
	<?php print $msg; ?>
	</b></font>
	</td>
</tr>
<tr>
	<td></td>
	<td align = 'right'>
		<input name = 'cancel' type = 'reset' value = 'clear'>
		<input name = 'register' type = 'submit' value = 'register'>
	</td>
</tr>
</table>
</form>
</div>
</div>

<div style="top:550; left:300; position:absolute; z-index:1;">
<img border = "none" src = "images/maulawka.gif"></img>
</div>
</body>
</html>