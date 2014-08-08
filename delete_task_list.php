<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: login.php");
}

$taskkey = $_REQUEST['key'];
$tsk = $_REQUEST['key'];
include 'sql.php';

$SQL = "DROP TABLE $tsk";
mysql_query($SQL);

$SQL = "DELETE FROM task_list WHERE taskname = '$taskkey'";
mysql_query($SQL);


$SQL = "SELECT * FROM info WHERE group_task = '$taskkey'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$grp = $db_field['groups'];
	$SQL = "UPDATE info SET individ_task = '' WHERE groups = '$grp'";
	mysql_query($SQL);
	
	$SQL = "UPDATE info SET task_status_indi = '' WHERE groups = '$grp'";
	mysql_query($SQL);
}


$SQL = "SELECT * FROM info WHERE group_task = '$taskkey'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$unem = $db_field['username'];
	$SQL = "UPDATE info SET group_task = '' WHERE username = '$unem'";
	mysql_query($SQL);
}

mysql_close($db_handle);
print "<script>location.href = 'task_list.php'</script>";
?>