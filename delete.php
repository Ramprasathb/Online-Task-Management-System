<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: login.php");
}

$namekey = $_REQUEST['key'];
include 'sql.php';

$SQL = "DELETE FROM info WHERE username = '$namekey'";
mysql_query($SQL);

$SQL = "SELECT * FROM group_title WHERE group_leader = '$namekey'";
$result = mysql_query($SQL);
while ($db_field = mysql_fetch_assoc($result)) {
	$a = $db_field['group_name'];
}

$SQL = "UPDATE group_title SET group_leader = '' WHERE group_name = '$a'";
$result = mysql_query($SQL);

mysql_close($db_handle);
print "<script>location.href = 'manage_user.php'</script>";
?>