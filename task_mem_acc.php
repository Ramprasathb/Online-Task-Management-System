<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['member'];
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
	$lrate = $db_field['task_status_indi'];
	$ytask = $db_field['individ_task'];
	
	if($lrate == 0){
		$lrate = "working";
	}
	else if($lrate == 10){
		$lrate = "working";
	}
	else if($lrate == 100){
		$lrate = "done";
	}
	else{
		$lrate = $lrate."%";
	}
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

print("<div style='top:260; left:268; position:absolute; z-index:1;'>");
print("<font face='Broadway' size = '4'>Your task:</font>");
print("</div>");

print("<div style='top:257; left:380; position:absolute; z-index:1;'>");
print("<table border = '0' width = '370' bgcolor = 'white'>");
print("<tr><td>$ytask</td></tr>");
print("</table>");
print("</div>");


print("<div style='top:400; left:400; position:absolute; z-index:1;'>");
print("<font face='Broadway' size = '4'>Last rate:</font>");
print("</div>");


print("<div style='top:395; left:500; position:absolute; z-index:1;'>");
print("<table border = '0' width = '100' bgcolor = 'white'>");
print("<tr><td align = 'center'><b>$lrate</b></td></tr>");
print("</table>");
print("</div>");


if (isset($_POST['fback'])) {
	$rate = $_POST['group1'];
	
	$SQL = "UPDATE info SET task_status_indi = '$rate' WHERE username = '$user'";
	mysql_query($SQL);
	
	//die("<SCRIPT LANGUAGE='JavaScript'>alert('Checking! $rate')</script>");
	mysql_close($db_handle);
	
	print("<div style='top:310; left:400; position:absolute; z-index:1;'>");
	print("<font face='Broadway' size = '4'>Your rating was sent.</font>");
	print("</div>");
	
	print("<div style='top:340; left:580; position:absolute; z-index:1;'>");
	print("<form name='ok_form' method='post' action='task_mem_acc.php'>");
	print("<input name = 'ok' type = 'submit' value = 'OK'>");
	print("</div>");
}
else{
	print("<div style='top:300; left:300; position:absolute; z-index:1;'>");
	print("<table border = '0'>");
	print("<tr>");
	print("<th colspan = '7'>");
	print("<font face='Broadway' size = '4'>Please rate your completion.</font>");
	print("</th></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>");
	print("<tr>");
	print("<form name='fback_form' method='post' action='task_mem_acc.php'>");
	print("<td><input type='radio' name='group1' value='10' checked> working </td>");
	print("<td><input type='radio' name='group1' value='20'> 20% </td>");
	print("<td><input type='radio' name='group1' value='40'> 40% </td>");
	print("<td><input type='radio' name='group1' value='60'> 60% </td>");
	print("<td><input type='radio' name='group1' value='80'> 80% </td>");
	print("<td><input type='radio' name='group1' value='100'> done </td>");
	print("<td><input type='submit' name='fback' value='Submit'></td>");
	print("</form>");
	print("</tr></div>");
}
?>



</body>
</html>