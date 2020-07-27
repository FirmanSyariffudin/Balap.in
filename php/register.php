 <?php
    ini_set('display_errors', '1');
	session_start();

    $options = ['cost' => 11];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
    $phone = $_POST['phone'];

    $cPanelUser = 'u5223431';
    
	$db_host = "mitradb.com";
	$db_user = $cPanelUser . "_balap";
	$db_pass = "balap.in@456";
	$db_name = $cPanelUser . "_balap";
	
	//make connection
	$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
	
	//check connection
	if (!$connection) {
		die("connection-error");
    }

    $sql = "SELECT * FROM temp_account WHERE email = '$email'";
	$result = mysqli_query($connection, $sql);
	
	if (!$result) {
		echo "failed";
        // echo "<script> location.href='index.php'; </script>";
	}
	else {
	    if (mysqli_num_rows($result) > 0) {
    		echo "email-found";
    	}
    	else {

            $sql = "SELECT * FROM directus_users WHERE email = '$email'";
            $result = mysqli_query($connection, $sql);
            
            if (!$result) {
                echo "failed";
                // echo "<script> location.href='index.php'; </script>";
            }
            else {
                if (mysqli_num_rows($result) > 0) {
                    echo "email-registered";
                }
                else {
    
                    $unique = uniqid();
                    $sql = "INSERT INTO `temp_account`(`name`, `email`, `password`, `phone`, `unique`) VALUES ('$name', '$email', '$password', '$phone', '$unique')";
                    $result = mysqli_query($connection, $sql);
                    
                    if (!$result) {
                        echo "failed";
                    }
                    else {
                        // $email_message = "Terima kasih telah bergabung dengan Museum Bakso 57-58."."\n";
                        // $email_message .= "Silahkan klik tautan berikut untuk verifikasi akun Anda"."\n";
                        // $email_message .= "https://mitrakapital.id/php/verify.php?u=$email&uid=$unique";
        
                        // $email_to = $email;
                        // $email_subject = "Selamat datang di Museum Bakso 57-58. Verifikasi akun Museum Bakso 57-58 Anda";
                        // // create email headers
                        // $headers = 'From: " Museum Bakso 57-58" <contact@mitrakapital.id>'."\r\n".
                        // 'Reply-To: contact@mitrakapital.id'."\r\n".
                        // 'X-Mailer: PHP/' . phpversion();
                        // $mailsent = @mail($email_to, $email_subject, $email_message, $headers);

                        // if ($mailsent){
                        // echo "success";
                        // } else {
                        //     echo "mail failed";
                        // }
                        echo "https://balap.in/php/verify.php?u=$email&uid=$unique";
                        header( "Location: https://balap.in/php/verify.php?u=$email&uid=$unique");
                        // echo "success";
                    }

                }
            }
    	}
	}
	
    exit;
?>