<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Update Profile</h1>
                    <small>Fill the new details about you.</small>
                    </div>
            </div>
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
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="s_name" value="<?php echo $s_name ; ?>" required>
                                <div class="underline"></div>
                                <label>Shop Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="username" value="<?php echo $username ; ?>" required>
                                <div class="underline"></div>
                                <label>User Name</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="owner" value="<?php echo $owner ; ?>" required>
                                <div class="underline"></div>
                                <label>Owner's Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="address" value="<?php echo $address ; ?>" required>
                                <div class="underline"></div>
                                <label>Address</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="email" name="email" value="<?php echo $email ; ?>" required>
                                <div class="underline"></div>
                                <label>Email Address</label>
                            </div>
                            <div class="input-data">
                                <input name="contact" type="number" value="<?php echo $contact ; ?>" required>
                                <div class="underline"></div>
                                <label>Contact Number</label>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $id = $_POST['id'];
                            $s_name = $_POST['s_name'];
                            $username = $_POST['username'];
                            $owner = $_POST['owner'];
                            $email = $_POST['email'];
                            $address = $_POST['address'];
                            $contact = $_POST['contact'];

                            $sql = "UPDATE tbl_customershop SET 
                            s_name='$s_name',
                            username='$username',
                            owner='$owner',
                            address='$address',
                            email='$email',
                            contact='$contact' 
                            WHERE id=$id ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['customer-update'] = "<div class='successfuly-done'>Customer Shop Updated Successfully.</div>";
                                header('location:'.SITEURL.'customerShop/profile.php');
                            } else {
                                $_SESSION['customer-update'] = "<div class='Failed-to-do'>Failed to Update Customer Shop.</div>";
                                header('location:'.SITEURL.'customerShop/profile.php');
                            }
                        }
                    ?>
                </div>
            </div>
        </main>
    </div>
<?php include('partials/footer.php'); ?>