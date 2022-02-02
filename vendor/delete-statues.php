<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "UPDATE tbl_purchase SET status='Cancelled' WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['cancell'] = "<div class='successfuly-done'>Successfully Cancell Order.</div>";
            header('location:'.SITEURL.'vendor/add-statues.php');
        } else {
            $_SESSION['cancell'] = "<div class='Failed-to-do'>Failed to Cancell Order.</div>";
            header('location:'.SITEURL.'vendor/add-statues.php');
        }
    } else {
        header('location:'.SITEURL.'vendor/add-statues.php');
    }
?>