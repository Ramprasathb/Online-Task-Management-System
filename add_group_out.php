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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	include 'sql.php';
	
	if (isset($_POST['cancel'])) {
		print("<script>location.href = 'view_group.php'</script>");
	}
		
	$grp = $_POST['gname'];
	
	if($grp == ''){
		die("<SCRIPT LANGUAGE='JavaScript'>alert('Please enter group name!')</script><script>location.href = 'add_group.php'</script>");
	}
		
	$SQL = "SELECT * FROM group_title";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		if ($grp == $db_field['group_name']){
			$exist = true;
			break;
		}
	}

	if ($exist){
		$msg = 'Group already exist!';
		mysql_close($db_handle);
	}
	else{
		//unwanted HTML (scripting attacks)
		
		$grp = htmlspecialchars($grp);
		
		//function
		$grp = quote_smart($grp, $db_handle);
		
		$SQL = "INSERT INTO group_title (`group_name`) VALUES ($grp)";
		$result = mysql_query($SQL);
		if($result){
			mysql_close($db_handle);
			$msg = 'Group succesfully added.';
		}
		else{
			mysql_close($db_handle);
			$msg = "Error adding group";
		}
				
	}
}

?>

<html>
<head>
<title>ADMIN(add_group)
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
<form name='ok_form' method='post' action='view_group.php'>
<input name = 'ok' type = 'submit' value = 'OK'>
</div>


<div style="top:150; left:800; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>
<div style="top:50; left:10; position:absolute; z-index:1;">
<a href = "add_group.php"><img src = "images/addgroup.gif" border = "0"></img></a>
</div>
</div>

</body>
</html>