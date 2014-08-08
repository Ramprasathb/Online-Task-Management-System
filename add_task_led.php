<?php
session_start();
$uname = $_SESSION['username'];
$log = $_SESSION['leader'];
if ($log != "log"){
	header ("Location: login.php");
}
?>


<html>
<head>
<title>Leader(add_task)
</title>
</head>
<body link="#0066FF" vlink="#6633CC" bgcolor="#FFFFCC" background="images/image001.jpg" style='margin:0'>

<div style="top:20; left:270; position:absolute; z-index:1;">
<h1>Online Task Management System</h1>
</div>

<div style="top:150; left:20; position:absolute; z-index:1;">

<table>
<tr><td>
<a href = "leader.php"><img border = "none" src = "images/home.gif"></img></a>
</td></tr>

<tr><td>
<a href = "task_led.php"><img border = "none" src = "images/task.gif"></img></a>
</td></tr>

<tr><td>
<a href = "mess_led.php"><img border = "none" src = "images/messages.gif"></img></a>
</td></tr>

<tr><td>
<a href = "about_leader.php"><img border = "none" src = "images/about.gif"></img></a>
</td>

<tr><td>
<a href = "index.php"><img border = "none" src = "images/logout.gif"></img></a>
</td></tr>

</table>

<div style="top:0; left:170; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>
</div>

</div>

<div style="top:170; left:317; position:absolute; z-index:1;">
<font face="Broadway" size = "4">Task:</font>
</div>



<?php
if (isset($_POST['cancel'])) {
	print("<script>location.href = 'task_led.php'</script>");
}
else if (isset($_POST['assign'])) {
	$namekey=$_POST['uname'];
	$atask = $_POST['task'];
	$table_task = $_POST['hid_task'];
	include 'sql.php';
	
	$SQL = "ALTER TABLE $table_task ADD $atask VARCHAR(255) NOT NULL";
	mysql_query($SQL);
	
	$SQL = "UPDATE info SET individ_task = '$atask' WHERE username = '$namekey'";
	mysql_query($SQL);
	
	//print("<SCRIPT LANGUAGE='JavaScript'>alert('Checking! $atask')</script>");
	
	$SQL = "INSERT INTO $table_task (`username`, $atask) VALUES ('$namekey', 'pending')";
	mysql_query($SQL);
	
	$SQL = "UPDATE info SET task_status_indi = 'pending' WHERE username = '$namekey'";
	mysql_query($SQL);
	
	mysql_close($db_handle);
	print("<script>location.href = 'task_led.php'</script>");
}
else{
	$namekey = $_REQUEST['key'];
	$user = $_SESSION['username'];
    
	include 'sql.php';
	
	$SQL = "SELECT * FROM info WHERE username = '$user'";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$grp = $db_field['groups'];
		$tsk = $db_field['group_task'];
	}
	
	print("<div style='top:167; left:380; position:absolute; z-index:1;'>");
	print("<table border = '0' width = '370' bgcolor = 'white'>");
	print("<tr><td>$tsk</td></tr>");
	print("</table>");
	print("</div>");
	
	$SQL = "SELECT * FROM task_list WHERE taskname = '$tsk'";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$dsc = $db_field['ds'];
	}
	
	print("<div style='top:200; left:250; position:absolute; z-index:1;'>");
	print("<font face='Broadway' size = '4'>Description:</font>");
	print("</div>");
	
	print("<div style='top:197; left:380; position:absolute; z-index:1;'>");
	print("<table border = '0' width = '370' bgcolor = 'white'>");
	print("<tr><td>$dsc</td></tr>");
	print("</table>");
	print("</div>");

	
	print("<div style='top:270; left:350; position:absolute; z-index:1;'>");
	print("<form name='add_form' method='post' action='add_task_led.php'>");
	print("<table border = '0' >");
	print("<tr><td><b>Name:</b></td>");
	print("<td><input name = 'uname' type = 'text' readonly = 'true' value = $namekey></td>");
	print("</tr>");
	print("<tr><td><b>Task:</b></td>");
	print("<td><input name = 'task' type = 'text' value = ''></td>");
	print("<input name = 'hid_task' type = 'hidden' value = $tsk>");
	print("</tr>");	
	print("<tr>");
	print("<td align = 'right'><input name = 'reset' type = 'reset' value = 'reset'></td>");
	print("<td><input name = 'cancel' type = 'submit' value = 'cancel'>");
	print("<input name = 'assign' type = 'submit' value = 'ASSIGN'></td>");
	print("</tr>");
	print("</table>");
	print("</form>");
	print("</div>");
	mysql_close($db_handle);
}
?>

<div style='top:400; left:300; position:absolute; z-index:1;'>
<b><font color = "red" size = "5">Warning!</b></font><font color = "black" size = "4"><b> Do not use space in giving the task!</b><font>
</div>
</body>
</html>