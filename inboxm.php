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
<title>Message(Member)
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

<div style="top:150; left:250; position:absolute; z-index:1;">
<font face="Broadway" size = "6">Inbox:</font>
</div>

<div style="top:210px; left:250px; width:500px; height:320px; position:absolute; overflow:auto; z-index:1">
<table border = "2" width = "100%">
<tr>
	<th></th>
	<th>From</th>
	<th>Subject</th>
	<th>Date</th>
	<th>Action</th>
</tr>

<?php
include 'sql.php';

$SQL = "SELECT * FROM messaging WHERE to_receiver = '$user' ORDER BY date_send DESC";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$ctrl = $db_field['ctrl_no'];
	$a = $db_field['opened'];
	$b = $db_field['from_sender'];
	$c = $db_field['mail_subject'];
	$d = $db_field['date_send'];
	print("<tr>");
	if($a == 0){
		print("<td align = 'center' width = '1'><a href = 'read_mail_mem.php?key=".$ctrl."'><img src = 'images/unopened.jpg' border = '0'></img></a></td>");
	}
	else{
		print("<tr><td align = 'center' width = '1'><a href = 'read_mail_mem.php?key=".$ctrl."'><img src = 'images/opened.jpg' border = '0'></img></a></td>");
	}
	print("<td align = 'center'><b>$b</b></td>");
	if($c == ""){
		print("<td align = 'center' width = '150'>no subject</td>");
	}
	else{
		print("<td align = 'center' width = '150'>$c</td>");
	}
	print("<td align = 'center'>$d</td>");
	print("<td align = 'center' width ='75'><a href = 'reply_mail_mem.php?key=".$b."'><img src = 'images/reply.jpg' border = '0'></img></a>");
	print("<a href = 'delete_mail_mem.php?key=".$ctrl."'><img src = 'images/deletemail.jpg' border = '0'></img></a></td>");
	print("</tr>");
}
?>


</table>
</div>

<div style="top:150; left:800; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>

<div style="top:50; left:10; position:absolute; z-index:1;">
<a href = "com_mes_mem.php"><img src = "images/compose.gif" border = "0"></img></a>
</div>

<div style="top:100; left:10; position:absolute; z-index:1;">
<a href = "inboxm.php"><img src = "images/inbox.gif" border = "0"></img></a>
</div>

<div style="top:150; left:10; position:absolute; z-index:1;">
<a href = "sent_itemsm.php"><img src = "images/sentitems.gif" border = "0"></img></a>
</div>


</body>
</html>