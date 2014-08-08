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
<title>ADMIN(read_mail)
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

<?php
$ctrl = $_REQUEST['key'];
include 'sql.php';

$SQL = "UPDATE sent_items SET opened = 1 WHERE ctrl_no = '$ctrl'";
mysql_query($SQL);


$SQL = "SELECT * FROM sent_items WHERE ctrl_no = '$ctrl'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$to = $db_field['to_receiver'];
	$date = $db_field['date_send'];
	$sub = $db_field['mail_subject'];
	$mess = $db_field['message'];
}

?>
<div style="top:150; left:270; position:absolute; z-index:1;">
<b><font face="Arial" size = "3">To:</font></b>
</div>

<div style="top:150; left:310; position:absolute; z-index:1;">
<b><font face="Arial" size = "3"><?php print $to; ?></font></b>
</div>

<div style="top:170; left:255; position:absolute; z-index:1;">
<b><font face="Arial" size = "3">Date:</font></b>
</div>

<div style="top:170; left:310; position:absolute; z-index:1;">
<b><font face="Arial" size = "3"><?php print $date; ?></font></b>
</div>

<div style="top:200; left:232; position:absolute; z-index:1;">
<b><font face="Arial" size = "3">Subject:</font></b>
</div>

<div style="top:200; left:310; position:absolute; z-index:1;">
<b><font face="Arial" size = "3"><?php print $sub; ?></font></b>
</div>

<div style="top:250; left:250; position:absolute; z-index:1;">
<table border = "0" width = "500" bgcolor = "white">
<tr><td><?php print $mess; ?></td></tr>
</table>
</div>



<div style="top:150; left:800; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>

<div style="top:50; left:10; position:absolute; z-index:1;">
<a href = "delete_mail_s.php?key=<?php print $ctrl; ?>"><img src = "images/delete.gif" border = "0"></img></a>
</div>

<div style="top:100; left:10; position:absolute; z-index:1;">
<a href = "sent_items.php?key=<?php print $ctrl; ?>"><img src = "images/back.gif" border = "0"></img></a>
</div>

</div>

</body>
</html>