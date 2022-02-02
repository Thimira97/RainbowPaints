<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_order WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['order-delete'] = "<div class='successfuly-done'>Successfully Deleted Order.</div>";
            header('location:'.SITEURL.'customerShop/pending-orders.php');
        } else {
            $_SESSION['order-delete'] = "<div class='Failed-to-do'>Failed to Delete Order.</div>";
            header('location:'.SITEURL.'customerShop/pending-orders.php');
        }
    } else {
        header('location:'.SITEURL.'customerShop/pending-orders.php');
    }
?>