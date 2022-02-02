<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Update the vendor</h1>
                    <small>Fill the new details about the vendor.</small>
                    <?php 
                        
                        if(isset($_SESSION['vendor-update'])){
                            echo $_SESSION['vendor-update']; 
                            unset($_SESSION['vendor-update']);
                        }

                    ?>
                    </div>
            </div>

            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_vendor WHERE id=$id";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $c_name = $row['c_name'];
                        $username = $row['username'];
                        $manager = $row['manager'];
                        $address = $row['address'];
                        $email = $row['email'];
                        $contact = $row['contact'];
                    } else {
                        $_SESSION['no-vendor-found']= "<div class='Failed-to-do'>Vendoer Company Not Founded.</div>";
                        header('location:'.SITEURL.'admin/view-vendor.php');
                    }
                } else {
                    header('location:'.SITEURL.'admin/view-vendor.php');
                }
            ?>

            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="c_name" value="<?php echo $c_name ; ?>" required>
                                <div class="underline"></div>
                                <label>Company Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="username" value="<?php echo $username ; ?>" required>
                                <div class="underline"></div>
                                <label>User Name</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="manager" value="<?php echo $manager ; ?>" required>
                                <div class="underline"></div>
                                <label>Manager Name</label>
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
                            $c_name = $_POST['c_name'];
                            $username = $_POST['username'];
                            $manager = $_POST['manager'];
                            $address = $_POST['address'];
                            $email = $_POST['email'];
                            $contact = $_POST['contact'];

                            $sql = "UPDATE tbl_vendor SET 
                                c_name='$c_name',
                                username='$username',
                                manager='$manager',
                                address='$address',
                                email='$email',
                                contact='$contact'
                                WHERE id=$id
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['vendor-update'] = "<div class='successfuly-done'>Vendor Company Updated Successfully.</div>";
                                header('location:'.SITEURL.'admin/view-vendor.php');
                            } else {
                                $_SESSION['vendor-update'] = "<div class='Failed-to-do'>Failed to Update Vendor Company.</div>";
                                header('location:'.SITEURL.'admin/update-vendor.php');
                            }

                        }
                    ?>
                    </div>
                </div>
            </main>
        </div>
<?php include('partials/footer.php'); ?>