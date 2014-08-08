<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['leader'];
if ($log != "log"){
	header ("Location: login.php");
}
$msg = "";
?>


<html>
<head>
<title>Home(LEADER)
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

<div style="top:140; left:250; position:absolute; z-index:1;">
<div style="top:0; left:0; position:absolute; z-index:1;">
<?php
	print("<table>");
	print "<tr><td><h1>". strtoupper($user)."</h1></td><td>(Leader)</td></tr>";
	print("</table>");
?>
</div>
</div>

<div style="top:200; left:255; position:absolute; z-index:1;">
<?php
$mess = "";
$user = $_SESSION['username'];
include 'sql.php';

$count = 0;
$SQL = "SELECT * FROM messaging WHERE to_receiver = '$user' AND opened = 0";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$count = $count + 1;
}
mysql_close($db_handle);
if($count > 0){
	print("You have ".$count." new message!");
}
else{
	print("You have no new message!");
}

?>
</div>

<?php
include 'sql.php';
if (isset($_POST['edit'])) {
	include 'sql.php';
	$pasc = $_POST['upasc'];
	$pas1 = $_POST['upas1'];
	$pas2 = $_POST['upas2'];
	$SQL = "SELECT * FROM info WHERE username = '$user'";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$a= $db_field['password'];
		if ($pasc == $a){
			if($pas1 == $pas2){
				$SQL = "UPDATE info SET password  = '$pas1' WHERE username = '$user'";
				mysql_query($SQL);
				mysql_close($db_handle);
				$msg = "Password change.";
			}
			else{
				$msg = "Password did not match.";
			}
		}
		else{
			$msg = "Current password error.";
		}
	}
}

	print("<div style='top:300; left:320; position:absolute; z-index:1;'>");
	print("<form name='edit_form' method='post' action='changepassl.php'>");
	print("<table>");
	print("<tr>");
	print("<td align = 'right'><b>Current Password:</b></td>");
	print("<td><input name = 'upasc' type = 'password' value = ''></td>");
	print("</tr>");
	print("<tr>");
	print("<td align = 'right'><b>New Password:</b></td>");
	print("<td><input name = 'upas1' type = 'password' value = ''></td>");
	print("</tr>");
	
	print("<tr>");
	print("<td align = 'right'><b>Re-type Password:</b></td>");
	print("<td><input name = 'upas2' type = 'password' value = ''></td>");
	print("</tr>");
	
	print("<tr>");
	print("<td colspan = '2' align = 'right'><font color = 'red' size = '3'><b>$msg</b></font></td>");
	print("</tr>");
	
	print("<tr>");
	print("<td></td>");
	print("<td align = 'center'><input name = 'edit' type = 'submit' value = 'change password'></td>");
	print("</tr>");
	print("</table>");
	print("</form>");
	print("</div>");

?>

<div style="top:550; left:300; position:absolute; z-index:1;">
<img border = "none" src = "images/maulawka.gif"></img>
</div>

<div style="top:150; left:800; position:absolute; z-index:1;">
<img src = "images/image002.gif"></img>
<div style="top:50; left:10; position:absolute; z-index:1;">
<a href = "changepassl.php"><img src = "images/changepass.gif" border = "0"></img></a>
</div>
<div style="top:100; left:10; position:absolute; z-index:1;">
<a href = "userlistl.php"><img src = "images/userlist.gif" border = "0"></img></a>
</div>
</div>
</body>
</html>