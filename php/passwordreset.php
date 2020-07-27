<?php
    // ini_set('display_errors', '1');
	session_start();

    $options = ['cost' => 11];
    $email = $_POST['email'];
    $uid = $_POST['uid'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
    $cPanelUser = 'u5223431';
    
	$db_host = "mitradb.com";
	$db_user = $cPanelUser . "_calcatz";
	$db_pass = "gelut gelut gelut 54";
	$db_name = $cPanelUser . "_klambi";
	
	//make connection
	$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
	
	//check connection
	if (!$connection) {
		die("connection-error");
    }
    
    $sql = "SELECT * FROM password_reset WHERE uid = '$uid' AND email = '$email'";
	$result = mysqli_query($connection, $sql);
	
	if (!$result) {
		echo "email-not-found";
	}
	else {
        if (mysqli_num_rows($result) > 0) {
            $unique = uniqid();
            
            $sql = "UPDATE directus_users SET `password` = '$password'  WHERE email='$email'";
            $result = mysqli_query($connection, $sql);
            
            if (!$result) {
                echo "failed";
            }
            else {
                $sql = "DELETE FROM `password_reset`  WHERE email='$email'";
                $result = mysqli_query($connection, $sql);
                
                if (!$result) {
                    echo "failed";
                }
                else {
                    echo "success";
                }
            }
    	}
    	else {
            echo "email-not-found";
    	}
	}
	
    exit;
?>