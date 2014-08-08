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
<title>About(Leader)
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

<div style="top:150; left:250; position:absolute; z-index:1;">
<font face="Broadway" size = "6">ABOUT</font>
</div>


</body>
</html>