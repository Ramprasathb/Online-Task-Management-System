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
<title>Group Task(ADMIN)
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
<font face="Broadway" size = "6">Group Task:</font>
</div>

<div style="top:210px; left:250px; width:500px; height:320px; position:absolute; overflow:auto; z-index:1">
<table border = "2" width = "100%">
<tr>
	<th>Group</th>
	<th>Leader</th>
	<th>Group Task</th>
	<th>Action</th>
	<th>Notify</th>
</tr>
<?php
include 'sql.php';

$SQL = "SELECT * FROM info WHERE position = 'leader' ORDER BY groups ASC";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$a = $db_field['groups'];
	$b = $db_field['username'];
	$c = $db_field['group_task'];
	print("<tr><td align = 'center'>$a</td>");
	print("<td align = 'center'>$b</td>");
	if($c == ""){
		print("<td align = 'center'><b><font color = 'red'>unassign task</font><b></td>");
		print("<td align = 'center' width = '70px'><img src = 'images/edit.jpg' border = '0' alt = 'add group task'></img>");
		print("<a href = 'add_group_task.php?key=".$b."'><img src = 'images/addtask.jpg' border = '0' alt = 'add group task'></img></a></td>");
		print("<td align = 'center' width = '40px'><img src = 'images/mail.jpg' border = '0' alt = 'notify'></img></td></tr>");
	}
	else{
		print("<td align = 'center'>$c</td>");
		print("<td align = 'center' width = '70px'><a href = 'edit_group_task.php?key=".$b."'><img src = 'images/edit.jpg' border = '0' alt = 'add group task'></img></a>");
		print("<img src = 'images/addtask.jpg' border = '0' alt = 'add group task'></img></td>");
		print("<td align = 'center' width = '40px'><a href = 'notify.php?key=".$b."'><img src = 'images/mail.jpg' border = '0' alt = 'notify'></img></a></td></tr>");
	}
}
mysql_close($db_handle);

?>
</table>
</div>



<div style="top:150; left:800; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>
<div style="top:50; left:10; position:absolute; z-index:1;">
<a href = "completion.php"><img src = "images/completion.gif" border = "0"></img></a>
</div>
</div>



</body>
</html>