<?php
// ini_set('display_errors', '1');
session_start();

if (isset( $_SESSION['token'])) {
	$token = $_SESSION['token'];
	$cPanelUser = 'u5223431';
	
	$db_host = "mitradb.com";
	$db_user = $cPanelUser . "_mitrakapital";
	$db_pass = "pahamantapryza";
	$db_name = $cPanelUser . "_mitrakapital";
	
	$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
	
	if (!$connection) {die("connection-error");}
	
	$sql = "SELECT * FROM directus_users WHERE token = '$token'";
	$result = mysqli_query($connection, $sql);
	
	if (!$result) {
		echo "email-not-found";
	} else {
		echo "email-found";
	}
} else {
    echo 'null';
}

