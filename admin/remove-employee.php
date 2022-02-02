<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_employeee WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['employee-delete'] = "<div class='successfuly-done'>Successfully Deleted Employee Request.</div>";
            header('location:'.SITEURL.'admin/approve-employee.php');
        } else {
            $_SESSION['employee-delete'] = "<div class='Failed-to-do'>Failed to Delete Employee.</div>";
            header('location:'.SITEURL.'admin/approve-employee.php');
        }
    } else {
        header('location:'.SITEURL.'admin/approve-employee.php');
    }
?>