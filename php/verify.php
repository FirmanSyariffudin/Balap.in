<?php
    // ini_set('display_errors', '1');
	session_start();

    $email = $_GET['u'];
    $unique = $_GET['uid'];

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
		echo "email-not-found";
        // echo "<script> location.href='index.php'; </script>";
	}
	else {
	    if (mysqli_num_rows($result) > 0) {
    		while ($row = mysqli_fetch_assoc($result)) {
				if ($row['unique'] == $unique) {
                    $password = $row['password'];
                    $name = $row['name'];
                    $phone = $row['phone'];
					
                    $sql = "INSERT INTO `directus_users`(`email`, `password`, `status`) VALUES ('$email', '$password', 'active')";
                    $result = mysqli_query($connection, $sql);
                    if (!$result) {
                        echo "insert-failure";
                    }
                    else {
                        $sql = "DELETE FROM `temp_account` WHERE `email`= '$email'";
                        $result = mysqli_query($connection, $sql);
                        if (!$result) {
                            echo "removal-failure";
                        }
                        else {
                            $sql = "SELECT * FROM directus_users WHERE email = '$email'";
							$result = mysqli_query($connection, $sql);
							if (!$result) {
								echo "user-initialization-failure";
							}
							else {
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										$id = $row["id"];
										$sql = "INSERT INTO `directus_user_roles` (`user`, `role`) VALUES ('$id','2')";
										$result = mysqli_query($connection, $sql);
										if(!$result){
											echo "user-role-initialization-failure";
										}
										else{
											$sql = "INSERT INTO `user_data`(`name`, `user_id`, `email`, `phone_number`) VALUES ('$name', '$id', '$email', '$phone')";
											$result = mysqli_query($connection, $sql);
											if (!$result) {
												echo "user-creation-failure";
											}
											else {
												echo "success";
												// header( "refresh:3;url=../auth.html#login");
												// echo "Verifikasi sukses, mengarahkan Anda ke halaman login dalam tiga detik...";
											}
										}
									}
								}
							}
                        }
					}
    			}
    			else {
		            echo "wrong-password";
    			}
    		}
    	}
    	else {
		    echo "verified";
    	}
	}
	
    exit;
?>