<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "UPDATE tbl_customershop SET approvement='Yes' WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['approving'] = "<div class='successfuly-done'>Successfully Approved.</div>";
            header('location:'.SITEURL.'admin/view-customer.php');
        } else {
            $_SESSION['approving'] = "<div class='Failed-to-do'>Failed to Approved.</div>";
            header('location:'.SITEURL.'admin/approve-customer.php');
        }
    } else {
        header('location:'.SITEURL.'admin/approve-customer.php');
    }
?>