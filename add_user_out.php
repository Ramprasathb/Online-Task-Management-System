<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: login.php");
}

//strip the incoming text of any unwanted characters (SQL Injection attacks)
function quote_smart($value, $handle) {
   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }
   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}

$msg = "";
$exist = false;
$timailhan = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	include 'sql.php';
	
	if (isset($_POST['cancel'])) {
		print("<script>location.href = 'manage_user.php'</script>");
	}
	
	$user = $_POST['uname'];
	$pass = $_POST['pword'];
	$grp = $_POST['group'];
	$pos = $_POST['position'];
	
	if($user == ''){
		die("<SCRIPT LANGUAGE='JavaScript'>alert('Please enter username!')</script><script>location.href = 'add_user.php'</script>");
	}
		
	$SQL = "SELECT * FROM info";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		if ($user == $db_field['username']){
			$exist = true;
			break;
		}
	}

	if ($exist){
		$msg = 'User already exist!';
		mysql_close($db_handle);
	}
	else{
		
		$SQL = "SELECT * FROM info WHERE groups = '$grp' AND position = 'leader'";
		$result = mysql_query($SQL);
		while($db_field = mysql_fetch_assoc($result)){
			$led = $db_field['username'];
			if($led != ""){
				$timailhan = true;
			}
		}
		$bui_pos = $pos;
		$bui_grp = $grp;
		$bui_user = $user;
		if($pos == "leader"){
			if($timailhan){
				die("<SCRIPT LANGUAGE='JavaScript'>alert('Group has already a leader.')</script><script>location.href = 'add_user.php'</script>");
			}
		}
		
		//unwanted HTML (scripting attacks)
		$user = htmlspecialchars($user);
		$pass = htmlspecialchars($pass);
		$grp = htmlspecialchars($grp);
		$pos = htmlspecialchars($pos);
		
		//function
		$user = quote_smart($user, $db_handle);
		$pass = quote_smart($pass, $db_handle);
		$grp = quote_smart($grp, $db_handle);
		$pos = quote_smart($pos, $db_handle);
		
		
		$SQL = "INSERT INTO info (`username`, `password`, `groups`, `position`) VALUES ($user, $pass, $grp, $pos)";
		mysql_query($SQL);
		
		if($bui_pos == "leader"){
			$SQL = "UPDATE group_title SET group_leader = '$bui_user' WHERE group_name = '$bui_grp'";
			mysql_query($SQL);
		}
		
		mysql_close($db_handle);
		$msg = 'User succesfully added.';
	}
}

?>

<html>
<head>
<title>ADMIN(add_user)
</title>
</head>
<body link="#0066FF" vlink="#6633CC" bgcolor="#FFFFCC" background="images/image001.jpg" style='margin:0'>

<div style="top:20; left:270; position:absolute; z-index:1;">
<h1>Online Task Management System</h1>
</div>

<div style="top:150; left:20; position:absolute; z-index:1;">

<table>
<tr><td>
<a href = "admin.php"><img border = "none" src = "images/home.gif"></img></a>
</td></tr>

<tr><td>
<a href = "manage_user.php"><img border = "none" src = "images/manage.gif"></img></a>
</td></tr>

<tr><td>
<a href = "group_task.php"><img border = "none" src = "images/grouptask.gif"></img></a>
</td></tr>

<tr><td>
<a href = "messages.php"><img border = "none" src = "images/messages.gif"></img></a>
</td></tr>

<tr><td>
<a href = "about_login.php"><img border = "none" src = "images/about.gif"></img></a>
</td></tr>

<tr><td>
<a href = "index.php"><img border = "none" src = "images/logout.gif"></img></a>
</td></tr>
</table>
<div style="top:0; left:170; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>
</div>

</div>

<div style="top:200; left:300; position:absolute; z-index:1;">
<font face="Cooper Black" size = "5" color = "blue"><?php print $msg; ?></font>
</div>

<div style='top:260; left:550; position:absolute; z-index:1;'>
<form name='ok_form' method='post' action='manage_user.php'>
<input name = 'ok' type = 'submit' value = 'OK'>
</div>


<div style="top:150; left:800; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>
<div style="top:50; left:10; position:absolute; z-index:1;">
<a href = "add_user.php"><img src = "images/adduser.gif" border = "0"></img></a>
</div>
</div>

</body>
</html>