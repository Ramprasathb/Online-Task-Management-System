<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['leader'];
if ($log != "log"){
	header ("Location: login.php");
}
$currentuser = $_SESSION['username'];

$namekey = $_REQUEST['key'];
include 'sql.php';

//$notmsg = "Your leader give you task. Go to TASK to know your task.";
$notmg="";
mysql_query("call Notify_leader(@notmg)");
$s=mysql_query("select @notmg");
 
$row=mysql_fetch_array($s);
$notmsg=$row['@notmg'];
$sub = "notification";
$SQL = "INSERT INTO messaging (`to_receiver`, `from_sender`, `opened`, `mail_subject`, `message`) VALUES ('$namekey', '$currentuser', 0,' $sub', '$notmsg')";
mysql_query($SQL);
$SQL = "INSERT INTO sent_items (`to_receiver`, `from_sender`, `opened`, `mail_subject`, `message`) VALUES ('$namekey', '$currentuser', 0,' $sub', '$notmsg')";
mysql_query($SQL);


mysql_close($db_handle);
print "<script>location.href = 'task_led.php'</script>";
?>