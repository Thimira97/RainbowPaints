<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Update Profile</h1>
                    <small>Add new details about you.</small>
                </div>
            </div>
            <?php 
                if(isset($_SESSION['id'])){
                    $id = $_SESSION['id'];
                    
                    $sql = "SELECT * FROM tbl_employeee WHERE id=$id";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $name=$row['name'];
                        $username=$row['username'];
                        $age=$row['age'];
                        $cur_gender=$row['gender'];
                        $address=$row['address'];
                        $contact=$row['contact'];
                        $email=$row['email'];
                        $current_image=$row['image_name'];

                    } else {
                        $_SESSION['empoyee-not-found']= "<div class='Failed-to-do'>Employee Not Founded.</div>";
                        header('location:'.SITEURL.'employee/login.php');
                    }
                } else {
                    header('location:'.SITEURL.'employee/login.php');
                }
            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="name" value="<?php echo $name; ?>" required>
                                <div class="underline"></div>
                                <label>Full Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="username" value="<?php echo $username; ?>" required>
                                <div class="underline"></div>
                                <label>User Name</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="email" value="<?php echo $email ; ?>" required>
                                <div class="underline"></div>
                                <label>Email Address</label>
                            </div>
                            <div class="input-data">
                                <input type="hidden">
                                <div class="underline"></div>
                                <label></label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="address" value="<?php echo $address; ?>"required>
                                <div class="underline"></div>
                                <label>Address</label>
                            </div>
                            <div class="input-data">
                                <input type="number" name="contact" value="<?php echo $contact; ?>" required>
                                <div class="underline"></div>
                                <label>Contact Number</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="age" value="<?php echo $age; ?>"required>
                                <div class="underline"></div>
                                <label>Age</label>
                            </div>
                            <div class="input-data">
                                <select name="gender">
                                    <option <?php if($cur_gender=="Male"){ echo "selected" ;} ?> name="male" value="Male">Male</option>
                                    <option <?php if($cur_gender=="Female"){ echo "selected" ;} ?> name="female" value="Female">Female</option>
                                </select>
                                <div class="underline-before"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data image-update">
                                <?php 
                                    if($current_image != ""){
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/employee/<?php echo $current_image; ?>" style="width: 50px; border-radius: 50%;">
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
                                <input type="hidden" name="id" value="<?php echo $id ; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $id = $_POST['id'];
                            $name = $_POST['name'];
                            $username = $_POST['username'];
                            $age = $_POST['age'];
                            $email = $_POST['email'];
                            $address = $_POST['address'];
                            $contact = $_POST['contact'];
                            $gender = $_POST['gender'];
                            $current_image=$_POST['current_image'];

                            if(isset($_FILES['image']['name'])){
                                $image_name = $_FILES['image']['name'];

                                if($image_name != ""){
                                    $ext = end(explode('.',$image_name));
                                    $image_name = "Employee_Image_".rand(000, 999).'.'.$ext;
                                    $source_path = $_FILES['image']['tmp_name'];
                                    $destination_path = "../images/employee/".$image_name;
                                    $upload = move_uploaded_file($source_path,$destination_path);
                                    if($upload==false){
                                        $_SESSION['upload'] = "<div class='Failed-to-do'>Failed to Upload Image.</div>";
                                        header('location:'.SITEURL.'employee/profile.php');
                                        die();
                                    }

                                    if($current_image != ""){
                                        $remove_path="../images/employee/".$current_image;

                                        $remove = unlink($remove_path);

                                        if($remove==false){
                                            $_SESSION['file-remove'] = "<div class='Failed-to-do'>Failed to Remove Current Image.</div>";
                                            header('location:'.SITEURL.'employee/profile.php');
                                            die();
                                        }
                                    }
                                } else {
                                    $image_name= $current_image;
                                }
                            } else {
                                $image_name = $current_image;
                            }

                            $sql = "UPDATE tbl_employeee SET 
                            name='$name',
                            username='$username',
                            age='$age',
                            address='$address',
                            email='$email',
                            gender='$gender',
                            contact='$contact',
                            image_name = '$image_name' 
                            WHERE id=$id ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['employee-update'] = "<div class='successfuly-done'>Employee Updated Successfully.</div>";
                                header('location:'.SITEURL.'employee/profile.php');
                            } else {
                                $_SESSION['employee-update'] = "<div class='Failed-to-do'>Failed to Update Employee.</div>";
                                header('location:'.SITEURL.'employee/profile.php');
                            }
                        }
                    ?>
                </div>
            </div>
        </main>
    </div>
<?php include('partials/footer.php'); ?>