<?php
session_start();
session_destroy();
$msg = "";

include 'sql.php';

if (isset($_POST['verify'])) {
	$eadd = $_POST['eadd'];
	$verify = $_POST['ver_code'];
	
	$SQL = "SELECT * FROM user_profile";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$a = $db_field['email'];
		$b = $db_field['verification_code'];
		if(($a == $eadd) AND ($b == $verify)){
			$SQL = "SELECT * FROM user_profile WHERE email = '$eadd'";
			$result = mysql_query($SQL);
			while($db_field = mysql_fetch_assoc($result)){
				$user = $db_field['username'];
				$pass = $db_field['password'];
			}
			$SQL = "INSERT INTO info (`username`, `password`, `position`) VALUES ('$user', '$pass', 'member')";
			mysql_query($SQL);
			$msg = "Account verification is succesful.";
			break;
		}
		else{
			$msg = "Account verification is NOT succesful.";
		}
	}
}
?>
	
<html>
<head>
<title>Verify
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

<div style="top:10; left:38; position:absolute; z-index:1;">
<div style="top:180px; left:310px; width:500px; height:320px; position:absolute; overflow:auto; z-index:1">
<form name='signup_form' method='post' action='verify.php'>
<table border = "0">
<tr>
	<th align = 'right'>Email Address:</th>
	<td><input name = 'eadd' type = 'text' value = ''></td>
</tr>
<tr>
	<th align = 'right'>Verification Code:</th>
	<td><input name = 'ver_code' type = 'text' value = ''></td>
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
		<input name = 'verify' type = 'submit' value = 'verify'>
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