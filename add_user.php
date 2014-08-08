<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: login.php");
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

<div style="top:150; left:250; position:absolute; z-index:1;">
<font face="Broadway" size = "6">Add user:</font>
</div>


<div style="top:220; left:350; position:absolute; z-index:1;">
<form name='add_form' method='post' action='add_user_out.php'>
	<table border = "0" >
	<tr><td><b>Username:</b></td>
	<td><input name = 'uname' type = 'text' value = ''></td>
	</tr>
	<tr><td><b>Password:</b></td>
	<td><input name = 'pword' type = 'password' value = ''></td>
	</tr>	
	<tr><td><b>Group:</b></td>
	<td>	
	<select name = 'group' style="width:100%;height:100%;">
	
<?php
	include 'sql.php';
	
	$SQL = "SELECT * FROM group_title ORDER BY group_name ASC";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)){
		$list = $db_field['group_name'];
		if($list != "admin"){
			print("<option>$list");
		}
	}
	mysql_close($db_handle);
?>

	</select>
	</td>
	</tr>
	<tr><td><b>Position:</b></td>
	<td>
	<select name = 'position' style="width:100%;height:100%;">
	<option>member
	<option>leader
	</select>
	</td>
	</tr>
	<tr>
	<td align = "right"><input name = 'reset' type = 'reset' value = 'reset'></td>
	<td><input name = 'cancel' type = 'submit' value = 'CANCEL'>
	<input name = 'add' type = 'submit' value = 'A D D'></td>
	</tr>
	</table>
</form>
</div>

</body>
</html>