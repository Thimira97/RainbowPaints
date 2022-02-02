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
                    
                        if(isset($_SESSION['employee-add'])){
                            echo $_SESSION['employee-add'];
                            unset($_SESSION['employee-add']);
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
                                <input type="text" name="name" required>
                                <div class="underline"></div>
                                <label>Employee Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="username" required>
                                <div class="underline"></div>
                                <label>User Name</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="number" name="age" required>
                                <div class="underline"></div>
                                <label>Age</label>
                            </div>
                            <div class="input-data">
                                <!-- <label>Gender</label> -->
                                <select name="gender">
                                    <option name="male" value="Male">Male</option>
                                    <option name="female" value="Female">Female</option>
                                </select>
                                <div class="underline-before"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="address" required>
                                <div class="underline"></div>
                                <label>Address</label>
                            </div>
                            <div class="input-data">
                                <input type="email" name="email" required>
                                <div class="underline"></div>
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="number" name="contact" required>
                                <div class="underline"></div>
                                <label>Contact Number</label>
                            </div>
                            <div class="input-data">
                                <input type="number" name="salary" required>
                                <div class="underline"></div>
                                <label>Salary</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input  class="input" type="date" name="appoinment" required>
                                <div class="underline"></div>
                                <div class="underline-before"></div>
                                <label>Appoinment Date</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="designation" required>
                                <div class="underline"></div>
                                <label>Designation</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="file" name="image">
                            </div>
                            <div class="input-data">
                                <input type="password" name="password" required>
                                <div class="underline"></div>
                                <label>Password</label>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="hidden" name="approvement" value="Yes">
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
                                $approvement=$_POST['approvement'];
                                $password = md5($_POST['password']);
                        
                            if(isset($_FILES['image']['name'])){
                                $image_name = $_FILES['image']['name'];

                                if($image_name != ""){
                                    $ext = end(explode('.',$image_name));

                                    $image_name = "Employee_Image_".rand(000, 999).'.'.$ext;

                                    $source_path = $_FILES['image']['tmp_name'];

                                    $destination_path = "../images/employee/".$image_name;

                                    $upload = move_uploaded_file($source_path, $destination_path);

                                    if($upload==false){
                                        $_SESSION['upload'] = "<div class='Failed-to-do'>Failed to upload Image.</div>";
                                        header('location:'.SITEURL.'admin/add-employee.php');
                                        die();
                                    }
                                }
                            } else {
                                $image_name="";
                            }

                            $sql = "INSERT INTO tbl_employeee SET 
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
                                approvement='$approvement',
                                image_name = '$image_name',
                                password = '$password'
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['employee-add'] = "<div class='successfuly-done'>Employee Added Successfully.</div>";
                                header('location:'.SITEURL.'admin/view-employee.php');
                            } else {
                                $_SESSION['employee-add'] = "<div class='Failed-to-do'>Failed to Add Employee.</div>";
                                header('location:'.SITEURL.'admin/add-employee.php');
                            }
                        }
                    ?>

                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>