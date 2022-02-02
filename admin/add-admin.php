<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Add a New Admin</h1>
                    <small>Fill the details about the new admin.</small>
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

            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="full_name" required>
                                <div class="underline"></div>
                                <label>Full Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="username" required>
                                <div class="underline"></div>
                                <label>User Name</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="email" required>
                                <div class="underline"></div>
                                <label>Email Address</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="password" required>
                                <div class="underline"></div>
                                <label>Password</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
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
                            $full_name = $_POST['full_name'];
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = md5($_POST['password']);

                            if(isset($_FILES['image']['name'])){
                                $image_name = $_FILES['image']['name'];

                                if($image_name != ""){
                                    $ext = end(explode('.',$image_name));

                                    $image_name = "Profile_Image_".rand(000, 999).'.'.$ext;

                                    $source_path = $_FILES['image']['tmp_name'];

                                    $destination_path = "../images/profile/".$image_name;

                                    $upload = move_uploaded_file($source_path, $destination_path);

                                    if($upload==false){
                                        $_SESSION['upload'] = "<div class='Failed-to-do'>Failed to upload Image.</div>";
                                        header('location:'.SITEURL.'admin/add-admin.php');
                                        die();
                                    }
                                }
                            } else {
                                $image_name="";
                            }

                            $sql = "INSERT INTO tbl_admin SET
                                full_name = '$full_name',
                                username = '$username',
                                email = '$email',
                                image_name = '$image_name',
                                password = '$password'
                            ";

                            $res = mysqli_query($conn, $sql) or die(mysqli_error());

                            if($res==true){
                                $_SESSION['add-admin'] = "<div class='successfuly-done'>Admin Added Successfully.</div>";
                                header("location:".SITEURL.'admin/view-admin.php');
                            } else {
                                $_SESSION['add-admin'] = "<div class='Failed-to-do'>Failed to Added Admin.</div>";
                                header("location:".SITEURL.'admin/add-admin.php');
                            }
                        }
                    ?>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>