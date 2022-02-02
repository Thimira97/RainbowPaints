<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_rawmatirial WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['raw-delete'] = "<div class='successfuly-done'>Successfully Deleted Raw Matirial.</div>";
            header('location:'.SITEURL.'vendor/view-rawmaterial.php');
        } else {
            $_SESSION['raw-delete'] = "<div class='Failed-to-do'>Failed to Delete Raw Matirial.</div>";
            header('location:'.SITEURL.'vendor/view-rawmaterial.php');
        }
    } else {
        header('location:'.SITEURL.'vendor/view-rawmaterial.php');
    }
?>