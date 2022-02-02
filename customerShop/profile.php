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
                    
                        if(isset($_SESSION['customer-update'])){ 
                            echo $_SESSION['customer-update']; 
                            unset($_SESSION['customer-update']); 
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

                    ?><br><br>
                </div>
            </div>
            <div class="profile">
                <div class="profile-info">
                <?php 
                    if(isset($_SESSION['id'])){
                        $id = $_SESSION['id'];
                        
                        $sql = "SELECT * FROM tbl_customershop WHERE id=$id";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);
                        if($count==1){
                            $row = mysqli_fetch_assoc($res);
                            $s_name=$row['s_name'];
                            $username=$row['username'];
                            $owner=$row['owner'];
                            $address=$row['address'];
                            $contact=$row['contact'];
                            $email=$row['email'];
                        } else {
                            $_SESSION['not-found']= "<div class='Failed-to-do'>Customer Not Founded.</div>";
                            header('location:'.SITEURL.'customerShop/login.php');
                        }
                    } else {
                        header('location:'.SITEURL.'customerShop/login.php');
                    }
                ?>
                <img src="<?php echo SITEURL; ?>images/man.png">
                <div>
                    <div class="profile-data">
                        <div class="data-section">
                            <div class="single-data">
                                <h3><?php echo $username ; ?></h3>
                                <label>User Name</label>
                            </div>
                            <div class="single-data">
                                <h3><?php echo $email ; ?></h3>
                                <label>Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="profile-data">
                        <div class="data-section">
                            <div class="single-data">
                                <h3><?php echo $s_name ; ?></h3>
                                <label>Shop Name</label>
                            </div>
                            <div class="single-data">
                                <h3><?php echo $owner ; ?></h3>
                                <label>Owner</label>
                            </div>
                        </div>
                    </div>
                    <div class="profile-data">
                    <div class="data-section">
                        <div class="single-data">
                            <h3><?php echo $address ; ?></h3>
                            <label>Address</label>
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

