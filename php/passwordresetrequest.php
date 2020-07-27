<?php
    // ini_set('display_errors', '1');
	session_start();

    $options = ['cost' => 11];
    $email = $_POST['email'];
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
    
    $sql = "SELECT * FROM directus_users WHERE email = '$email'";
	$result = mysqli_query($connection, $sql);
	
	if (!$result) {
		echo "email-not-found";
	}
	else {
        if (mysqli_num_rows($result) > 0) {
            $unique = uniqid();
            
            $sql = "INSERT INTO `password_reset`(`email`,`uid`) VALUES ('$email', '$unique')";
            $result = mysqli_query($connection, $sql);
            
            if (!$result) {
                echo "failed";
            }
            else {
                $email_message = "Selamat datang kembali di KLAMBI."."\n";
                $email_message .= "Silahkan klik link berikut untuk mengganti password akun KLAMBI Anda."."\n";
                $email_message .= "https://klambi.id/passwordreset.html?u=$email&uid=$unique";

                $email_to = $email;
                $email_subject = "Reset password akun KLAMBI";
                // create email headers
                $headers = 'From: "KLAMBI" <contact@klambi.id>'."\r\n".
                'Reply-To: contact@klambi.id'."\r\n".
                'X-Mailer: PHP/' . phpversion();
                @mail($email_to, $email_subject, $email_message, $headers);

                echo "success";
            }
    	}
    	else {
            echo "email-not-found";
    	}
	}
	
    exit;
?>