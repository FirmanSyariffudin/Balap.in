<?php

ini_set('display_errors', '1');
session_start();

if (isset($_POST['token']) || isset($_SESSION['token'])) {

    if (isset($_POST['token'])) $token = $_POST['token'];
    else $token = $_SESSION['token'];
    
    $cPanelUser = 'u5223431';

    $db_host = "mitradb.com";
	$db_user = $cPanelUser . "_balap";
	$db_pass = "balap.in@456";
	$db_name = $cPanelUser . "_balap";

    $connection = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if (!$connection) {
        die("connection-error");
    }

    $sql = "SELECT * FROM directus_users WHERE token = '$token'";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        echo "email-not-found";
    } else {
        $userData = mysqli_fetch_assoc($result);
        $id= $userData["id"];
        $sql = "SELECT * FROM user_data WHERE user_id = '$id'";
        $result = mysqli_query($connection, $sql);

        if (!$result) {
            echo "email-not-found";
        } else {
            $data = mysqli_fetch_assoc($result);

            // $role = $row["role"];
            // $userData["role"]=$role;
            // unset($userData['token']);
            // unset($userData['password']);
            // unset($userData['last_page']);
            // unset($userData['last_access_on']);
            // unset($userData['locale_options']);
            // unset($userData['email_notifications']);
            // unset($userData['external_id']);
            echo json_encode($data);
        }
    }
} else {
    echo 'null';
}
