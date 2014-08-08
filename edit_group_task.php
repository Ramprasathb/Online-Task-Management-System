<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: login.php");
}

$msg = "";

if (isset($_POST['cancel'])) {
	print("<script>location.href = 'group_task.php'</script>");
}

else if (isset($_POST['change'])) {
	include 'sql.php';

	$grptask = $_POST['grouptask'];
	$lednem = $_POST['ledernem'];
		
	$SQL = "UPDATE info SET group_task = '$grptask' WHERE username = '$lednem'";
	$result = mysql_query($SQL);
	if($result){
		mysql_close($db_handle);
		$msg = "Changes has been saved.";
	}
	else{
		mysql_close($db_handle);
		$msg = "Error saving acccount.";
	}
	print("<div style='top:260; left:550; position:absolute; z-index:1;'>");
	print("<form name='ok_form' method='post' action='group_task.php'>");
	print("<input name = 'ok' type = 'submit' value = 'OK'>");
	print("</div>");
}
else{
	$lednem = $_REQUEST['key'];
	include 'sql.php';

	$SQL = "SELECT * FROM info WHERE username = '$lednem'";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$grpnum = $db_field['groups'];
		$grptask = $db_field['group_task'];
	}
	
	print("<div style='top:150; left:250; position:absolute; z-index:1;'>");
	print("<font face='Broadway' size = '6'>Edit group task:</font>");
	print("</div>");
	print("<div style='top:220; left:350; position:absolute; z-index:1;'>");
	print("<form name='edit_form' method='post' action='edit_group_task.php'>");
	print("<table border = '0' >");
	print("<tr><td><b>Group:</b></td>");
	print("<td><input name = 'groupnem' type = 'text' value = '$grpnum' readonly = 'true'></td>");
	print("</tr>");
	print("<tr><td><b>Leader:</b></td>");
	print("<td><input name = 'ledernem' type = 'text' value = '$lednem' readonly = 'true'></td>");
	print("</tr>");
	print("<tr><td><b>Group task:</b></td>");
	print("<td><select name = 'grouptask' style='width:100%;height:100%;'>");

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
	
	print("<td align = 'right'><input name = 'reset' type = 'reset' value = 'reset'></td>");
	Print("<td><input name = 'cancel' type = 'submit' value = 'cancel'>");
	print("<input name = 'change' type = 'submit' value = 'CHANGE'></td>");
	print("</tr>");
	print("</table>");
	print("</form>");
	print("</div>");
}

?>

<html>
<head>
<title>ADMIN(edit_task)
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