<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_production WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['delete'] = "<div class='successfuly-done'>Successfully Deleted Production.</div>";
            header('location:'.SITEURL.'admin/view-production.php');
        } else {
            $_SESSION['delete'] = "<div class='Failed-to-do'>Failed to Delete Production.</div>";
            header('location:'.SITEURL.'admin/view-production.php');
        }
    } else {
        header('location:'.SITEURL.'admin/view-production.php');
    }
?>