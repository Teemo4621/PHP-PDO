<?php

    include_once 'db.php';
    
    //logout
    if (isset($_POST['logout'])) {
        session_start();
        unset($_SESSION['user_login']);
        unset($_SESSION['admin_login']);
        header('location: ../index.php');
    }
?>