<?php
    // ini_set('display_errors', '1');
	session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $_POST['user'];

    $cPanelUser = 'u5223431';
    
	$db_host = "mitradb.com";
	$db_user = $cPanelUser . "_calcatz";
	$db_pass = "gelut gelut gelut 54";
	$db_name = $cPanelUser . "_museumbakso";
	
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
        // echo "<script> location.href='index.php'; </script>";
	}
	else {
	    if (mysqli_num_rows($result) > 0) {
    		while ($row = mysqli_fetch_assoc($result)) {
    			if (password_verify($password, $row['password'])) {
    			    $_SESSION['user'] = $user;
		            echo "success";
                    // echo "<script> location.href='../orderlist.html'; </script>";
    			}
    			else {
		            echo "wrong-password";
    			}
    		}
    	}
    	else {
		    echo "email-not-found";
    	}
	}
	
    exit;
?>