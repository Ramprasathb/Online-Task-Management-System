<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: login.php");
}

$msg = "";

if (!isset($_POST['set'])) {
	$ctrlkey = $_REQUEST['key'];
	include 'sql.php';

	$SQL = "SELECT * FROM info WHERE username = '$ctrlkey'";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)){
		$grp = $db_field['groups'];
		$user = $db_field['username'];
	}
		
	print("<div style='top:220; left:350; position:absolute; z-index:1;'>");
	print("<form name='add_group_task_form' method='post' action='add_group_task.php'>");
	print("<table border = '0' >");
	print("<tr><td><b>Group:</b></td>");
	print("<td><input name = 'grpnem' type = 'text' value = '$grp' readonly = 'true'></td>");
	print("</tr>");
	print("<tr><td><b>Leader:</b></td>");
	print("<td><input name = 'unem' type = 'text' value = $user readonly = 'true'></td>");
	print("</tr>");
	print("<tr><td><b>Task:</b></td>");
	print("<td><select name = 'seltask' style='width:100%;height:100%;'>");

	$SQL = "SELECT * FROM task_list ORDER BY taskname ASC";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)){
		$list = $db_field['taskname'];
		print("<option>$list");
	}
	mysql_close($db_handle);
	
	print("</select></td>");
	print("</tr>");
	print("<tr>");
	print("<td></td>");
	print("<td align = 'right'><input name = 'cancel' type = 'submit' value = 'CANCEL'><input name = 'set' type = 'submit' value = 'SET'></td>");
	print("</tr>");
	print("</table>");
	print("</form>");
	print("</div>");
		
	print("<div style='top:150; left:250; position:absolute; z-index:1;'>");
	print("<font face='Broadway' size = '6'>Assign Group Task:</font>");
	print("</div>");
	
	if (isset($_POST['cancel'])) {
		print("<script>location.href = 'group_task.php'</script>");
	}
}
else{
	$user = $_POST['unem'];
	$grp = $_POST['grpnem'];
	$gtask = $_POST['seltask'];
	// $user_name = "root";
	// $password = "";
	// $database = "dbase";
	// $server = "127.0.0.1";
	// $db_handle = mysql_connect($server, $user_name, $password);
	// $db_found = mysql_select_db($database, $db_handle);

	include 'sql.php';
	if (!$db_found) {
		die("DATABASE not found!");
	}

	$SQL = "UPDATE info SET group_task = '$gtask' WHERE username = '$user'";
	$result = mysql_query($SQL);
	
	if($result){
		mysql_close($db_handle);
		$msg = "Task save to group <b><font color = 'red'>".$grp."</font></b>.";
	}
	else{
		mysql_close($db_handle);
		$msg = "Error saving task!";
	}
	print("<div style='top:260; left:600; position:absolute; z-index:1;'>");
	print("<form name='ok_form' method='post' action='group_task.php'>");
	print("<input name = 'ok' type = 'submit' value = 'OK'>");
	print("</div>");
}

?>

<html>
<head>
<title>ADMIN(add_group_task)
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


</body>
</html>