<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
        <div class="page-header">
                <div>
                    <h1>Profile</h1>
                    <small>Update your profile and change password.</small>
                    <?php 
                    
                        if(isset($_SESSION['empoyee-not-found'])){
                            echo $_SESSION['empoyee-not-found'];
                            unset($_SESSION['empoyee-not-found']);
                        }

                        if(isset($_SESSION['employee-update'])){ 
                            echo $_SESSION['employee-update']; 
                            unset($_SESSION['employee-update']); 
                        }

                        if(isset($_SESSION['change_pwd'])){ 
                            echo $_SESSION['change_pwd']; 
                            unset($_SESSION['change_pwd']); 
                        }

                        if(isset($_SESSION['pwd_not_match'])){ 
                            echo $_SESSION['pwd_not_match']; 
                            unset($_SESSION['pwd_not_match']); 
                        }

                        if(isset($_SESSION['user_not_found'])){ 
                            echo $_SESSION['user_not_found']; 
                            unset($_SESSION['user_not_found']); 
                        }

                        if(isset($_SESSION['upload'])){
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }

                        if(isset($_SESSION['file-remove'])){
                            echo $_SESSION['file-remove'];
                            unset($_SESSION['file-remove']);
                        }
                    ?><br><br>
                </div>
            </div>
            <div class="profile">
                <div class="profile-info">
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
                            $gender=$row['gender'];
                            $address=$row['address'];
                            $contact=$row['contact'];
                            $email=$row['email'];
                            $salary=$row['salary'];
                            $image_name = $row['image_name'];

                            if($image_name != ""){
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/employee/<?php echo $image_name; ?>">
                                <?php
                            } else { ?>
                                    <img src="<?php echo SITEURL; ?>images/man.png">
                            <?php
                            }
                        } else {
                            $_SESSION['not-found']= "<div class='error-text'>Employee Not Founded.</div>";
                            header('location:'.SITEURL.'employee/login.php');
                        }
                    } else {
                        header('location:'.SITEURL.'employee/login.php');
                    }
                ?>
                 
                <div>
                    <div class="profile-data">
                        <div class="data-section">
                            <div class="single-data">
                                <h3><?php echo $name ; ?></h3>
                                <label>Full Name</label>
                            </div>
                            <div class="single-data">
                                <h3><?php echo $username ; ?></h3>
                                <label>User Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="profile-data">
                        <div class="data-section">
                            <div class="single-data">
                                <h3><?php echo $age ; ?></h3>
                                <label>Age</label>
                            </div>
                            <div class="single-data">
                                <h3><?php echo $gender ; ?></h3>
                                <label>Gender</label>
                            </div>
                        </div>
                    </div>
                    <div class="profile-data">
                        <div class="data-section">
                            <div class="single-data">
                                <h3 style="font-size: 15px;"><?php echo $address ; ?></h3>
                                <label>Address</label>
                            </div>
                            <div class="single-data">
                                <h3><?php echo $email ; ?></h3>
                                <label>Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="profile-data">
                        <div class="data-section">
                            <div class="single-data">
                                <h3><?php echo $salary ; ?>LKR</h3>
                                <label>Salary</label>
                            </div>
                            <div class="single-data">
                                <h3>+94<?php echo $contact ; ?></h3>
                                <label>Contact</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-btn">
                        <a href="update-profile.php?id=<?php echo $id; ?>">
                            <span class="las la-edit"></span>Update Profile
                        </a>
                        <a href="update-password.php?id=<?php echo $id; ?>">
                            <span class="las la-lock"></span>Update Password
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>