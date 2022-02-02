<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $appointment = date("Y-m-d");

        $sql = "UPDATE tbl_employeee SET approvement='Yes', appoinment='$appointment' WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['approving-employee'] = "<div class='successfuly-done'>Successfully Approved.</div>";
            header('location:'.SITEURL.'admin/view-employee.php');
        } else {
            $_SESSION['approving-employee'] = "<div class='Failed-to-do'>Failed to Approved.</div>";
            header('location:'.SITEURL.'admin/approve-employee.php');
        }
    } else {
        header('location:'.SITEURL.'admin/approve-employee.php');
    }
?>