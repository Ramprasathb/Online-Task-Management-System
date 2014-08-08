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
<title>Leader(read_mail)
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

<?php
$ctrl = $_REQUEST['key'];
include 'sql.php';

$SQL = "UPDATE sent_items SET opened = 1 WHERE ctrl_no = '$ctrl'";
mysql_query($SQL);


$SQL = "SELECT * FROM sent_items WHERE ctrl_no = '$ctrl'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$from = $db_field['from_sender'];
	$date = $db_field['date_send'];
	$sub = $db_field['mail_subject'];
	$mess = $db_field['message'];
}

?>
<div style="top:150; left:250; position:absolute; z-index:1;">
<b><font face="Arial" size = "3">From:</font></b>
</div>

<div style="top:150; left:310; position:absolute; z-index:1;">
<b><font face="Arial" size = "3"><?php print $from; ?></font></b>
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
<a href = "delete_mail_sl.php?key=<?php print $ctrl; ?>"><img src = "images/delete.gif" border = "0"></img></a>
</div>

<div style="top:100; left:10; position:absolute; z-index:1;">
<a href = "sent_itemsl.php"><img src = "images/back.gif" border = "0"></img></a>
</div>

</div>

</body>
</html>