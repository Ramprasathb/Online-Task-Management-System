<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
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

if (isset($_POST['cancel'])) {
	print("<script>location.href = 'view_group.php'</script>");
}

if (isset($_POST['change'])) {
	include 'sql.php';
	
	$grp = $_POST['groups'];
	$hv = $_POST['hide_val'];
	
	//unwanted HTML (scripting attacks)
	$grp = htmlspecialchars($grp);
	$hv = htmlspecialchars($hv);

		
	//function
	$grp = quote_smart($grp, $db_handle);
	$hv = quote_smart($hv, $db_handle);	
	
	$SQL = "UPDATE group_title SET group_name = $grp WHERE group_name = $hv";
	$result = mysql_query($SQL);
	if($result){
		$SQL = "UPDATE info SET groups = $grp WHERE groups = $hv";
		mysql_query($SQL);
		$msg = "Changes has been saved.";
	}
	else{
		$msg = "Group name already exist!";
	}
	mysql_close($db_handle);
	print("<div style='top:260; left:550; position:absolute; z-index:1;'>");
	print("<form name='ok_form' method='post' action='view_group.php'>");
	print("<input name = 'ok' type = 'submit' value = 'OK'>");
	print("</div>");
}
else{
	$namekey = $_REQUEST['key'];
	include 'sql.php';

//	$SQL = "SELECT * FROM info WHERE username = '$namekey'";
//	$result = mysql_query($SQL);
//	while ($db_field = mysql_fetch_assoc($result)) {
//		$user = $db_field['username'];
//		$grp = $db_field['groups'];
//		$pos = $db_field['position'];
//	}
	
	print("<div style='top:150; left:250; position:absolute; z-index:1;'>");
	print("<font face='Broadway' size = '6'>Edit groupname:</font>");
	print("</div>");
	print("<div style='top:220; left:350; position:absolute; z-index:1;'>");
	print("<form name='edit_form' method='post' action='edit_group.php'>");
	print("<table border = '0' >");
	print("<tr><td><b>Group:</b></td>");
	print("<td><input name = 'groups' type = 'text' value = $namekey></td>");
	print("<td><input name = 'hide_val' type = 'hidden' value = $namekey></td>");
	print("<tr>");
	print("<td align = 'right'><input name = 'reset' type = 'reset' value = 'reset'></td>");
	print("<td><input name = 'cancel' type = 'submit' value = 'cancel'>");
	print("<input name = 'change' type = 'submit' value = 'CHANGE'></td>");
	print("</tr>");
	print("</table>");
	print("</form>");
	print("</div>");
}


?>

<html>
<head>
<title>ADMIN(edit_group)
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