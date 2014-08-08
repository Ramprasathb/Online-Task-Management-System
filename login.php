<?php
session_start();
//session_destroy();
$user = "";
$pass = "";
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	include 'sql.php';

	$user = $_POST['uname'];
	$pass = $_POST['pword'];
		
	//unwanted HTML (scripting attacks)
	$user = htmlspecialchars($user);
	$pass = htmlspecialchars($pass);
	
	$SQL = "SELECT * FROM info";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$a = $db_field['username'];
		$b = $db_field['password'];
		$pos = $db_field['position'];
		if(($user == $a) AND ($pass == $b)){
			if($pos == "admin"){
				session_start();
				$_SESSION['username'] = $user;
				$_SESSION['admin'] = "log";
				mysql_close($db_handle);
				header("Location: admin.php");
				break;
			}
			else if($pos == "leader"){
				session_start();
				$_SESSION['username'] = $user;
				$_SESSION['leader'] = "log";
				mysql_close($db_handle);
				header("Location: leader.php");
				break;
			}
			else if($pos == "member"){
				session_start();
				$_SESSION['username'] = $user;
				$_SESSION['member'] = "log";
				mysql_close($db_handle);
				header("Location: member.php");
				break;
			}
		}
	}
	$msg = "Check username and/or password.";
	mysql_close($db_handle);
}
?>


<html>
<head>
<title>Home
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


<div style="top:220; left:370; position:absolute; z-index:1;">
<form name='login_form' method='post' action='login.php'>
	<b>
	<font face = "times new roman" size = "3">
	<div style="top:0; left:0; width:250px; position:absolute; z-index:1;">
	Username: <input name = 'uname' type = 'text' value = ''>
	</div>
	<div style="top:25; left:0; width:250px; position:absolute; z-index:1;">
	Password   : <input name = 'pword' type = 'password' value = ''>
	</div>
	<div style="top:70; left:165; position:absolute; z-index:1;">
	<input name = 'login' type = 'submit' value = 'Login'>
	</div>
	</font>
	</b>
</form>
</div>

<div style="top:270; left:383; position:absolute; z-index:1;">
<?php
	print "<font color = 'red'>$msg</font>";
?>
</div>

<div style="top:150; left:800; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>

<div style="top:50; left:10; position:absolute; z-index:1;">
<a href = "verify.php"><img src = "images/verify.gif" border = "0"></img></a>
</div>

<div style="top:100; left:10; position:absolute; z-index:1;">
<a href = "signup.php"><img src = "images/signup.gif" border = "0"></img></a>
</div>

</div>

<div style="top:550; left:300; position:absolute; z-index:1;">
<img border = "none" src = "images/maulawka.gif"></img>
</div>
</body>
</html>