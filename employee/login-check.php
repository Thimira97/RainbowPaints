<?php 
    if(!isset($_SESSION['user'])){
        $_SESSION['no-login-message'] = "<div class='error-text text-center'>Please login to access Admin Panel.</div>";
        header('location:'.SITEURL.'employee/login.php');
    }
?>