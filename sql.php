<?php



$user_name = "root";
$password = "";
$database = "otask";
$server = "localhost";
$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);


if (!$db_found) {
	die("DATABASE not found!");
}

?>
