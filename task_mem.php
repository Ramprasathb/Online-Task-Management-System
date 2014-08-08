<?php
session_start();
$user = $_SESSION['username'];
$led_nem =$_SESSION['username'];
$log = $_SESSION['member'];
$dsc = "";
$acc=0;
if ($log != "log"){
	header ("Location: login.php");
}
?>

<html>
<head>
<title>Task(Member)
</title>
</head>
<body link="#0066FF" vlink="#6633CC" bgcolor="#FFFFCC" background="images/image001.jpg" style='margin:0'>

<div style="top:20; left:270; position:absolute; z-index:1;">
<h1>Online Task Management System</h1>
</div>

<div style="top:150; left:20; position:absolute; z-index:1;">

<table>
<tr><td>
<a href = "member.php"><img border = "none" src = "images/home.gif"></img></a>
</td></tr>

<tr><td>
<a href = "task_mem.php"><img border = "none" src = "images/task.gif"></img></a>
</td></tr>

<tr><td>
<a href = "mess_mem.php"><img border = "none" src = "images/messages.gif"></img></a>
</td></tr>

<tr><td>
<a href = "about_mem.php"><img border = "none" src = "images/about.gif"></img></a>
</td>

<tr><td>
<a href = "index.php"><img border = "none" src = "images/logout.gif"></img></a>
</td></tr>

</table>

<div style="top:0; left:170; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>
</div>

</div>

<div style="top:170; left:250; position:absolute; z-index:1;">
<font face="Broadway" size = "4">Group Task:</font>
</div>

<?php
include 'sql.php';

$SQL = "SELECT * FROM info WHERE username = '$user'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$grp = $db_field['groups'];
}

$SQL = "SELECT * FROM info WHERE groups = '$grp' AND position = 'leader'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$led_nem = $db_field['username'];
}

$SQL = "SELECT * FROM info WHERE username = '$led_nem'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$tsk = $db_field['group_task'];
}

//alsdhasldhlashdlas hdlkas hdlas hdlkasdh alskdha lshdlaksdh ls adhkl
if($tsk != ""){
	$SQL = "SELECT * FROM $tsk WHERE username = '$user'";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$acc = $db_field['accepted'];
	}


	if($acc == 1){
		die("<script>location.href = 'task_mem_acc.php'</script>");
	}
}	

if($tsk == ""){
	$tsk = "no task yet";
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

if($dsc == ""){
	$dsc = "no description given";
}

print("<div style='top:200; left:250; position:absolute; z-index:1;'>");
print("<font face='Broadway' size = '4'>Description:</font>");
print("</div>");

print("<div style='top:197; left:380; position:absolute; z-index:1;'>");
print("<table border = '0' width = '370' bgcolor = 'white'>");
print("<tr><td>$dsc</td></tr>");
print("</table>");
print("</div>");

print("<div style='top:230; left:227; position:absolute; z-index:1;'>");
print("<font face='Broadway' size = '4'>Group Leader:</font>");
print("</div>");

print("<div style='top:227; left:380; position:absolute; z-index:1;'>");
print("<table border = '0' width = '370' bgcolor = 'white'>");
print("<tr><td>$led_nem</td></tr>");
print("</table>");
print("</div>");

if (isset($_POST['notif'])) {
	$val = $_POST['hid_val'];
	$grp_tsk = $_POST['hid_grp_task'];
	
//	print("<SCRIPT LANGUAGE='JavaScript'>alert('Checking! $grp_tsk')</script>");

	$SQL = "UPDATE $grp_tsk SET $val = 'working' WHERE username = '$user'";
	mysql_query($SQL);
	
	$SQL = "UPDATE $grp_tsk SET accepted = 1 WHERE username = '$user'";
	mysql_query($SQL);
	
	$SQL = "UPDATE info SET task_status_indi = '10' WHERE username = '$user'";
	mysql_query($SQL);
	
	mysql_close($db_handle);
	
	print("<script>location.href = 'task_mem_acc.php'</script>");
}

else{
	print("<div style='top:300; left:263; position:absolute; z-index:1;'>");
	print("<font face='Broadway' size = '4'>Your Task:</font>");
	print("</div>");
	
	$SQL = "SELECT * FROM info WHERE username = '$user'";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$indi_task = $db_field['individ_task'];
	}
	
	print("<form name='notify_form' method='post' action='task_mem.php'>");
	print("<div style='top:295; left:380; position:absolute; z-index:1;'>");
	print("<table border = '0' width = '370' bgcolor = 'white'>");
	print("<tr><td width = '80%'>$indi_task</td>");
	if($indi_task == ""){
		print("<td><input name = 'notif' type = 'submit' value = 'ACCEPT' disabled>");
	}
	else{
		print("<td><input name = 'notif' type = 'submit' value = 'ACCEPT'>");
	}
	print("<input name = 'hid_val' type = 'hidden' value = $indi_task>");
	print("<input name = 'hid_grp_task' type = 'hidden' value = $tsk>");
	print("</form></td></tr></table>");
	print("</div>");

		
	print("<div style='top:335; left:330; position:absolute; z-index:1;'>");
	print("<font size = '2'><b>Click ACCEPT button to notify your leader that you receive your task.</b></font>");
	print("</div>");
}
?>


</body>
</html>