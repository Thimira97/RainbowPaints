<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Update the Admin</h1>
                    <small>Fill the new details about the admin.</small>
                    <?php 
                        if(isset($_SESSION['add-admin'])){
                            echo $_SESSION['add-admin'];
                            unset($_SESSION['add-admin']);
                        }

                        if(isset($_SESSION['upload'])){
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
                    ?>
                </div>
            </div>

            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
                    $res= mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $full_name=$row['full_name'];
                        $username= $row['username'];
                        $email= $row['email'];
                        $current_image = $row['image_name'];
                    } else {
                        $_SESSION['no-admin-found']= "<div class='Failed-to-do'>Admin Not Founded.</div>";
                        header('location:'.SITEURL.'admin/view-admin.php');
                    }
                } else {
                    header('location:'.SITEURL.'admin/view-admin.php');
                }

            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="full_name" value="<?php echo $full_name ; ?>" required>
                                <div class="underline"></div>
                                <label>Full Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="username" value="<?php echo $username ; ?>" required>
                                <div class="underline"></div>
                                <label>User Name</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="email" name="email" value="<?php echo $email ; ?>" required>
                                <div class="underline"></div>
                                <label>Email Address</label>
                            </div>
                            <div class="input-data">
                                <input type="hidden" name="id" value="<?php echo $id ; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data image-update">
                                <?php 
                                    if($current_image != ""){
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/profile/<?php echo $current_image; ?>" style="width: 50px; border-radius: 50%;">
                                        <?php
                                    } else {
                                       ?>
                                            <img src="<?php echo SITEURL; ?>images/avatar3.png" style="width: 50px; border-radius: 50%;">
                                       <?php
                                    }
                                ?>
                                <input type="file" name="image">
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $id = $_POST['id'];
                        $full_name= $_POST['full_name'];
                        $username= $_POST['username'];
                        $email= $_POST['email'];
                        $current_image=$_POST['current_image'];

                        if(isset($_FILES['image']['name'])){
                            $image_name = $_FILES['image']['name'];

                            if($image_name != ""){
                                $ext = end(explode('.',$image_name));
                                $image_name = "Profile_Image_".rand(000, 999).'.'.$ext;
                                $source_path = $_FILES['image']['tmp_name'];
                                $destination_path = "../images/profile/".$image_name;
                                $upload = move_uploaded_file($source_path,$destination_path);
                                if($upload==false){
                                    $_SESSION['upload'] = "<div class='Failed-to-do'>Failed to Upload Image.</div>";
                                    header('location:'.SITEURL.'admin/view-admin.php');
                                    die();
                                }

                                if($current_image != ""){
                                    $remove_path="../images/profile/".$current_image;

                                    $remove = unlink($remove_path);

                                    if($remove==false){
                                        $_SESSION['file-remove'] = "<div class='Failed-to-do'>Failed to Remove Current Image.</div>";
                                        header('location:'.SITEURL.'admin/view-admin.php');
                                        die();
                                    }
                                }
                            } else {
                                $image_name= $current_image;
                            }
                        } else {
                            $image_name = $current_image;
                        }

                        $sql = "UPDATE tbl_admin SET
                                full_name='$full_name',
                                username='$username',
                                email='$email',
                                image_name='$image_name'
                                WHERE id=$id
                        ";
                        $res = mysqli_query($conn,$sql);

                        if($res==true){
                                $_SESSION['update'] = "<div class='successfuly-done'>Admin Updated Successfully.</div>";
                                header('location:'.SITEURL.'admin/view-admin.php');
                        } else {
                                $_SESSION['update'] = "<div class='Failed-to-do'>Failed to Update Admin.</div>";
                                header('location:'.SITEURL.'admin/view-admin.php');
                        }
                        } 
                    ?>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>