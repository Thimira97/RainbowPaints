<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != ""){
            $path = "../images/employee/".$image_name;

            $remove = unlink($path);

            if($remove==false){
                $_SESSION['remove'] = "<div class='Failed-to-do'>Failed to Remove Image.</div>";
                header('location:'.SITEURL.'admin/view-employee.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_employeee WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['delete-employee'] = "<div class='success-text'>Successfully Deleted Employee.</div>";
            header('location:'.SITEURL.'admin/view-employee.php');
        } else {
            $_SESSION['delete-employee'] = "<div class='Failed-to-do'>Failed to Delete Employee.</div>";
            header('location:'.SITEURL.'admin/view-employee.php');
        }
    } else {
        header('location:'.SITEURL.'admin/view-employee.php');
    }
?>