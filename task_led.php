<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['leader'];
if ($log != "log"){
	header ("Location: login.php");
}
?>


<html>
<head>
<title>Leader(task)
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
include 'sql.php';

$SQL = "SELECT * FROM info WHERE username = '$user'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$grp = $db_field['groups'];
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

print("<div style='top:250px; left:250px; width:500px; height:320px; position:absolute; overflow:auto; z-index:1'>");
print("<table border = '2' width = '100%'>");
print("<tr>");
print("<th>Members</th>");
print("<th>Task</th>");
print("<th>Status</th>");
print("<th>Action</th>");
print("</tr>");

$SQL = "SELECT * FROM info WHERE groups = '$grp' AND position != 'leader' ORDER BY username ASC";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$mem = $db_field['username'];
	$indi = $db_field['individ_task'];
	$indi_stat = $db_field['task_status_indi'];
	
	if($mem == $user){
		print("<tr><td align = 'center' width = '130'><b>".$mem."<font color = 'red' size = '1'> (leader)</font></b></td>");
	}
	else{
		print("<tr><td align = 'center' width = '120'><b>$mem</b></td>");
	}
	if($indi ==""){
		print("<td align = 'center' width = '200'><font color = 'red'>no task</font>");
		print("<table><tr><td><img src = 'images/delete.jpg'></img></td></tr></table></td>");
	}
	else{
		print("<td align = 'center' width = '200'>$indi");
		print("<table><tr><td><a href = 'del_task_led.php?key=".$mem."'><img src = 'images/delete.jpg' border ='0'></img></a></td></tr></table></td>");
	}
	if($indi_stat == ""){
		print("<td align = 'center' width = '80'><b>---</b></td>");
	}
	else{
		if($indi_stat == 0){
			$indi_stat = "pending";
		}
		else if($indi_stat == 10){
			$indi_stat = "working";
		}
		else if($indi_stat == 100){
			$indi_stat = "done";
		}
		else{
			$indi_stat = $indi_stat."%";
		}
		print("<td align = 'center' width = '80'><font color = 'red'><b>$indi_stat</b></font></td>");
	}
	print("<td align = 'center' width = '70'>");
	if($indi == ""){
		print("<a href = 'add_task_led.php?key=".$mem."'><img src = 'images/addtask.jpg' border = '0'></img></a>");
		print("<img src = 'images/mail.jpg'></img>");
	}
	else{
		print("<img src = 'images/addtask.jpg' border = '0'></a>");
		if($indi_stat == "pending"){
			print("<a href = 'notify_mem.php?key=".$mem."'><img src = 'images/mail.jpg' border = '0'></img></a>");
		}
		else{
			print("<img src = 'images/mail.jpg' border = '0'></img>");
		}
	}
	print("</td></tr>");
}
?>

</body>
</html>