<?php
session_start();
session_unset(); 
session_destroy(); 
echo 'Logged-Out';
header("Location: ../auth.html#login");
?>