<?php 
    if(!isset($_SESSION['user'])){ 
        $_SESSION['no-login-message'] = "<div class='error-text text-center'>Please login to access Vendor Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>