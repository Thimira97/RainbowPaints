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
                    
                        if(isset($_SESSION['employee-update'])){
                            echo $_SESSION['employee-update'];
                            unset($_SESSION['employee-update']);
                        }

                    ?>
                </div>
            </div>

            <?php 
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];

                        $sql = "SELECT * FROM tbl_employeee WHERE id=$id";

                        $res = mysqli_query($conn,$sql);

                        $count = mysqli_num_rows($res);

                        if($count==1){
                            $row = mysqli_fetch_assoc($res);
                            $name = $row['name'];
                            $username = $row['username'];
                            $age = $row['age'];
                            $current_gender = $row['gender'];
                            $address = $row['address'];
                            $email = $row['email'];
                            $contact = $row['contact'];
                            $salary = $row['salary'];
                            $appoinment = $row['appoinment'];
                            $designation = $row['designation'];
                            $current_image = $row['image_name'];
                        } else {
                            $_SESSION['no-employee-found']= "<div class='Failed-to-do'>Employee Not Founded.</div>";
                            header('location:'.SITEURL.'admin/view-employee.php');
                        }
                    } else {
                        header('location:'.SITEURL.'admin/view-employee.php');
                    }
                
                ?>


            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="name" value="<?php echo $name ; ?>" required>
                                <div class="underline"></div>
                                <label>Employee Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="username" value="<?php echo $username ; ?>" required>
                                <div class="underline"></div>
                                <label>User Name</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="number" name="age" value="<?php echo $age ; ?>" required>
                                <div class="underline"></div>
                                <label>Age</label>
                            </div>
                            <div class="input-data">
                                <!-- <label>Gender</label> -->
                                <select name="gender">
                                    <option <?php if($current_gender == "Male"){ echo "selected"; }?>  name="male" value="Male">Male</option>
                                    <option <?php if($current_gender == "Female"){ echo "selected"; }?>  name="female" value="Female">Female</option>
                                </select>
                                <div class="underline-before"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="address" value="<?php echo $address ; ?>" required>
                                <div class="underline"></div>
                                <label>Address</label>
                            </div>
                            <div class="input-data">
                                <input type="email" name="email" value="<?php echo $email ; ?>" required>
                                <div class="underline"></div>
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="number" name="contact" value="<?php echo $contact ; ?>" required>
                                <div class="underline"></div>
                                <label>Contact Number</label>
                            </div>
                            <div class="input-data">
                                <input type="number" name="salary" value="<?php echo $salary ; ?>" required>
                                <div class="underline"></div>
                                <label>Salary</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input  class="input" type="date" name="appoinment" value="<?php echo $appoinment ; ?>" required>
                                <div class="underline"></div>
                                <div class="underline-before"></div>
                                <label>Appoinment Date</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="designation" value="<?php echo $designation ; ?>" required>
                                <div class="underline"></div>
                                <label>Designation</label>
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
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>

                    <?php 
                            if(isset($_POST['submit'])){
                                $name = $_POST['name'];
                                $username = $_POST['username'];
                                $age = $_POST['age'];
                                $gender = $_POST['gender'];
                                $address = $_POST['address'];
                                $email = $_POST['email'];
                                $contact = $_POST['contact'];
                                $salary = $_POST['salary'];
                                $appointment = $_POST['appoinment'];
                                $designation = $_POST['designation'];
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
                                         header('location:'.SITEURL.'admin/view-employee.php');
                                         die();
                                     }
             
                                     if($current_image != ""){
                                         $remove_path="../images/employee/".$current_image;
             
                                         $remove = unlink($remove_path);
             
                                         if($remove==false){
                                             $_SESSION['file-remove'] = "<div class='Failed-to-do'>Failed to Remove Current Image.</div>";
                                             header('location:'.SITEURL.'admin/view-employee.php');
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
                                gender='$gender',
                                address='$address',
                                email='$email',
                                contact='$contact',
                                salary='$salary',
                                appoinment='$appointment',
                                designation='$designation',
                                image_name = '$image_name',
                                image_name = '$image_name'
                                WHERE id=$id
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['employee-update'] = "<div class='successfuly-done'>Employee Updated Successfully.</div>";
                                header('location:'.SITEURL.'admin/view-employee.php');
                            } else {
                                $_SESSION['employee-update'] = "<div class='Failed-to-do'>Failed to Update Employee.</div>";
                                header('location:'.SITEURL.'admin/update-employee.php');
                            }
                        }
                    ?>

                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>