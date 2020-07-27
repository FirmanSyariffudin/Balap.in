<?php
    ini_set('display_errors', '1');
	session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $cPanelUser = 'u5223431';
    
	$db_host = "mitradb.com";
	$db_user = $cPanelUser . "_balap";
	$db_pass = "balap.in@456";
	$db_name = $cPanelUser . "_balap";

	$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
	
	if (!$connection) {
		die("connection-error");
	}

	$sql = "SELECT * FROM directus_users WHERE email = '$email'";
	$result = mysqli_query($connection, $sql);
	
	if (!$result) {
		echo "email-not-found";
	}
	else {
		// echo json_encode($result);
	    if (mysqli_num_rows($result) > 0) {
    		// while ($row = mysqli_fetch_assoc($result)) {
				$row = mysqli_fetch_assoc($result);
				if (password_verify($password, $row['password'])) {
                    $_SESSION['email'] = $row['email'];
					$curDate = new DateTime("now", new DateTimeZone('UTC'));
					$formattedCurDate = date_format($curDate, 'Y-m-d H:i:s');
					$hashedEmail = password_hash($row['email'], PASSWORD_DEFAULT);
					$hashedCurDate = $hashedEmail."!".$formattedCurDate;
					$sql = "UPDATE directus_users SET token='$hashedCurDate' WHERE email='$email'";
					if ($connection->query($sql) === TRUE) {
						// echo "New record created successfully";
						// echo $hashedCurDate . "\n";
						$explodedHashed= explode("!", $hashedCurDate);
						$_SESSION['token'] = $hashedCurDate;
						// echo $explodedHashed[0] . "\n";
						// echo $explodedHashed[1] . "\n";
						$restoredTime = strtotime($explodedHashed[1]);
						$datetime = new DateTime();
						$addedDate = $datetime->createFromFormat('Y-m-d H:i:s',$explodedHashed[1]);
						$addedDate->add(new DateInterval('P14D'));
						// echo $addedDate->format('Y-m-d') . "\n";
						// if ($addedDate > $curDate) echo "TANGGAL BISA!!!";
						// if (password_verify($row['email'], $hashedEmail)) echo "EMAIL BISA!!!";
						// echo $_SESSION["token"];
						// echo $row['id'];
						$id = $row['id'];
						$sql = "SELECT * FROM directus_user_roles WHERE user = $id";
						$result = mysqli_query($connection, $sql);
						if(!$result){
							echo "role-undefined";
						}else{
							$row = mysqli_fetch_assoc($result);
							$role = $row['role'];

							$sql = "SELECT * FROM directus_roles WHERE id = $role";
							$result = mysqli_query($connection, $sql);
							if(!$result){
								echo "role-undefined";
							}else{
								$row = mysqli_fetch_assoc($result);

								if($row['name']!=="Driver"){
									echo "not-driver";
								}else{
									//Ubah status, masukin ke antrian
									// echo "driver";
									header( "Location:https://balap.in/driver/php/getUserData.php");
								}
							}
						}
					} else {
						echo "token-update-fail";
					}
					
    			}
    			else {
		            echo "wrong-password";
    			}
    		// }
    	}
    	else {
		    echo "email-not-found";
    	}
	}
	
    exit;
?>