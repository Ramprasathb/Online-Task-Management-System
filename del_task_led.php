<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['leader'];
if ($log != "log"){
	header ("Location: login.php");
}
$currentuser = $_SESSION['username'];

$mem_nem = $_REQUEST['key'];
include 'sql.php';

$SQL = "SELECT * FROM info WHERE username = '$currentuser'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$grp_task = $db_field['group_task'];
}

$SQL = "DELETE FROM '$grp_task' WHERE username = '$mem_nem'";
mysql_query($SQL);


$SQL = "UPDATE info SET task_status_indi = '', individ_task = '' WHERE username = '$mem_nem'";
mysql_query($SQL);

$SQL = "SELECT * FROM info WHERE username = '$currentuser'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$gt = $db_field['group_task'];
}

$SQL = "DELETE FROM $gt WHERE username = '$mem_nem'";
mysql_query($SQL);

mysql_close($db_handle);
print "<script>location.href = 'task_led.php'</script>";
?>