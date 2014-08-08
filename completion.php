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
<font face="Broadway" size = "6">Completion:</font>
</div>

<div style="top:210px; left:250px; width:500px; height:320px; position:absolute; overflow:auto; z-index:1">
<table border = "2" width = "100%">
<tr>
	<th>Group</th>
	<th>Leader</th>
	<th>Status</th>
</tr>
<?php
include 'sql.php';

$SQL = "SELECT * FROM info WHERE position = 'leader' ORDER BY groups ASC";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$a = $db_field['groups'];
	$b = $db_field['username'];
	print("<tr><td align = 'center'><b>$a</b></td>");
	print("<td align = 'center'>$b</td>");
	
	$tot = 0;
	$counter = 0;
	$SQL1 = "SELECT * FROM info WHERE groups = '$a'";
	$result1 = mysql_query($SQL1);
	while ($db_field = mysql_fetch_assoc($result1)) {
		$c = $db_field['task_status_indi'];
		$tot = $tot + $c;
		$counter = $counter + 1;
	}
	if($counter == 0){
		$tot = $tot / ($counter - 1);
	}
	print("<td align = 'center'>".round($tot,2)." %</td>");
}


mysql_close($db_handle);

?>
</table>
</div>

</body>
</html>