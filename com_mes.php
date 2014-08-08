<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: login.php");
}

$msg = "";
include 'sql.php';

if (isset($_POST['cancel'])) {
	print "<script>location.href = 'messages.php'</script>";
}
else if (isset($_POST['send'])) {
	$user = $_SESSION['username'];
	$nem = $_POST['nem'];
	$sub = $_POST['sub'];
	$mes = $_POST['mes'];
	
	$SQL = "INSERT INTO messaging (`to_receiver`, `from_sender`, `mail_subject`, `message`) VALUES ('$nem', '$user', '$sub', '$mes')";
	$result = mysql_query($SQL);
	if(!$result ){
		die("<SCRIPT LANGUAGE='JavaScript'>alert('Unknown Error Occured!')</script><script>location.href = 'messages.php'</script>");
	}
	
	$SQL = "INSERT INTO sent_items (`to_receiver`, `from_sender`, `mail_subject`, `message`) VALUES ('$nem', '$user', '$sub', '$mes')";
	$result = mysql_query($SQL);
	if(!$result ){
		die("<SCRIPT LANGUAGE='JavaScript'>alert('Unknown Error Occured!')</script><script>location.href = 'messages.php'</script>");
	}
	
	$msg = "Message Sent.";
	print("<div style='top:260; left:550; position:absolute; z-index:1;'>");
	print("<form name='ok_form' method='post' action='messages.php'>");
	print("<input name = 'ok' type = 'submit' value = 'OK'>");
	print("</div>");
}
else{
	print("<div style='top:150; left:270; position:absolute; z-index:1;'>");
	print("<b><font face='Arial' size = '3'>To:</font></b>");
	print("</div>");
	
	print("<div style='top:150; left:310; position:absolute; z-index:1;'>");
	print("<form name = 'reply_form' method = 'post' action = 'com_mes.php'>");
	print("<input name = 'nem' type = 'text' value = '' size = '69'>");
	print("</div>");
	
	print("<div style='top:180; left:232; position:absolute; z-index:1;'>");
	print("<b><font face='Arial' size = '3'>Subject:</font></b>");
	print("</div>");
	
	print("<div style='top:180; left:310; position:absolute; z-index:1;'>");
	print("<input name = 'sub' type = 'text' value = '' size = '69'>");
	print("</div>");
	
	print("<div style='top:230; left:250; position:absolute; z-index:1;'>");
	print("<table border = '0 width = '500' bgcolor = 'white'>");
	print("<tr><td>");
	print("<textarea name = 'mes' rows = '15' cols = '59'>");
	print("</textarea>");
	print("</td></tr>");
	print("</table>");
	print("</div>");
	
	print("<div style='top:505; left:610; position:absolute; z-index:1;'>");
	print("<input name = 'cancel' type = 'submit' value = 'CANCEL'>");
	print("</div>");
	
	print("<div style='top:505; left:690; position:absolute; z-index:1;'>");
	print("<input name = 'send' type = 'submit' value = 'SEND'>");
	print("</div>");
	print("</form>");
}	
?>

<html>
<head>
<title>ADMIN(compose_mail)
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

<div style="top:150; left:800; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>

<div style="top:50; left:10; position:absolute; z-index:1;">
<a href = "com_mes.php"><img src = "images/compose.gif" border = "0"></img></a>
</div>

<div style="top:100; left:10; position:absolute; z-index:1;">
<a href = "inbox.php"><img src = "images/inbox.gif" border = "0"></img></a>
</div>

<div style="top:150; left:10; position:absolute; z-index:1;">
<a href = "sent_items.php"><img src = "images/sentitems.gif" border = "0"></img></a>
</div>

</div>

</body>
</html>