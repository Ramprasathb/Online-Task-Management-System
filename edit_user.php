<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
$namekey;
if ($log != "log"){
	header ("Location: login.php");
}

function quote_smart($value, $handle) {
   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }
   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}

$msg = "";
$timailhan = false;

if (isset($_POST['cancel'])) {
	print("<script>location.href = 'manage_user.php'</script>");
}

if (isset($_POST['change'])) {
	include 'sql.php';

	$user = $_POST['uname'];
	$grp = $_POST['groups'];
	$pos = $_POST['position'];
	
	
	$SQL = "SELECT * FROM info WHERE groups = '$grp' AND position = 'leader'";
	$result = mysql_query($SQL);
	while($db_field = mysql_fetch_assoc($result)){
		$led = $db_field['username'];
		if($led != ""){
			$timailhan = true;
		}
	}
	
	if($pos == "leader"){
		if($timailhan){
			die("<SCRIPT LANGUAGE='JavaScript'>alert('Group has already a leader.')</script><script>location.href = 'edit_user.php'</script>");
		}
	}
		
	//unwanted HTML (scripting attacks)
	$user = htmlspecialchars($user);
	$grp = htmlspecialchars($grp);
	$pos = htmlspecialchars($pos);
		
	//function
	$user = quote_smart($user, $db_handle);
	$grp = quote_smart($grp, $db_handle);
	$pos = quote_smart($pos, $db_handle);
	
	
	$SQL = "UPDATE group_title SET group_leader = '' WHERE group_leader = $user";
	$result = mysql_query($SQL);
	
	$SQL = "UPDATE info SET groups = $grp, position = $pos WHERE username = $user";
	$result = mysql_query($SQL);
			
	$SQL = "SELECT * FROM info WHERE username = $user";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$pos = $db_field['position'];
	}
	if($pos == "leader"){
		$SQL = "UPDATE group_title SET group_leader = $user WHERE group_name = $grp";
		mysql_query($SQL);
	}
	else{
		$SQL = "UPDATE info SET group_task = '' WHERE username = $user";
		mysql_query($SQL);
		$SQL = "UPDATE group_title SET group_leader = '' WHERE group_leader = $user";
		mysql_query($SQL);
	}
	$SQL = "UPDATE info SET task_status_indi = '', individ_task = '' WHERE username = $user";
	mysql_query($SQL);
	mysql_close($db_handle);
	$msg = "Changes has been saved.";
	print("<div style='top:260; left:550; position:absolute; z-index:1;'>");
	print("<form name='ok_form' method='post' action='manage_user.php'>");
	print("<input name = 'ok' type = 'submit' value = 'OK'>");
	print("</div>");
}
else{
	$namekey = $_REQUEST['key'];
	include 'sql.php';

	$SQL = "SELECT * FROM info WHERE username = '$namekey'";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)) {
		$user = $db_field['username'];
		$grp = $db_field['groups'];
		$pos = $db_field['position'];
	}
	
	print("<div style='top:150; left:250; position:absolute; z-index:1;'>");
	print("<font face='Broadway' size = '6'>Edit user:</font>");
	print("</div>");
	print("<div style='top:220; left:350; position:absolute; z-index:1;'>");
	print("<form name='edit_form' method='post' action='edit_user.php'>");
	print("<table border = '0' >");
	print("<tr><td><b>Username:</b></td>");
	print("<td><input name = 'uname' type = 'text' value = '$user' readonly = 'true'></td>");
	print("</tr>");
	print("<tr><td><b>Group:</b></td>");
	print("<td><select name = 'groups' style='width:100%;height:100%;'>");

	$SQL = "SELECT * FROM group_title ORDER BY group_name ASC";
	$result = mysql_query($SQL);
	while ($db_field = mysql_fetch_assoc($result)){
		$list = $db_field['group_name'];
		if($list != "admin"){
			print("<option>$list");
		}
	}
	mysql_close($db_handle);	
	
	print("</td>");
	print("</tr>");
	print("<tr><td><b>Position:</b></td>");
	print("<td><select name = 'position' style='width:100%;height:100%;'>");
	print("<option>member</option>");
	print("<option>leader</option>");
	print("</select></td>");
	print("</tr>");
	print("<tr>");
	print("<td align = 'right'><input name = 'reset' type = 'reset' value = 'reset'></td>");
	print("<td><input name = 'cancel' type = 'submit' value = 'cancel'>");
	print("<input name = 'change' type = 'submit' value = 'CHANGE''></td>");
	print("</tr>");
	print("</table>");
	print("</form>");
	print("</div>");
}


?>

<html>
<head>
<title>ADMIN(edit_user)
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

</body>
</html>