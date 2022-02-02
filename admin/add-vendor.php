<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Add a New Vender Company</h1>
                    <small>Fill the details about the new vendor company.</small>
                    <?php 
                        
                        if(isset($_SESSION['vendor-add'])){
                            echo $_SESSION['vendor-add'];
                            unset($_SESSION['vendor-add']);
                        }

                    ?>
                    </div>
            </div>

            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="c_name" required>
                                <div class="underline"></div>
                                <label>Company Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="username" required>
                                <div class="underline"></div>
                                <label>User Name</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="manager" required>
                                <div class="underline"></div>
                                <label>Manager Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="address" required>
                                <div class="underline"></div>
                                <label>Address</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="email" name="email" required>
                                <div class="underline"></div>
                                <label>Email Address</label>
                            </div>
                            <div class="input-data">
                                <input type="number" name="contact" required>
                                <div class="underline"></div>
                                <label>Contact Number</label>
                            </div>
                        </div>
                        <div class="form-row">
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
                            $c_name = $_POST['c_name'];
                            $username = $_POST['username'];
                            $manager = $_POST['manager'];
                            $address = $_POST['address'];
                            $email = $_POST['email'];
                            $contact = $_POST['contact'];
                            $password = md5($_POST['password']);
                            $approvement = $_POST['approvement'];

                            $sql = "INSERT INTO tbl_vendor SET 
                                c_name='$c_name',
                                username='$username',
                                manager='$manager',
                                address='$address',
                                email='$email',
                                contact='$contact',
                                password='$password',
                                approvement= '$approvement'
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['vendor-add'] = "<div class='successfuly-done'>Vendor Company Added Successfully.</div>";
                                header('location:'.SITEURL.'admin/view-vendor.php');
                            } else {
                                $_SESSION['vendor-add'] = "<div class='Failed-to-do'>Failed to Add Vendor Company.</div>";
                                header('location:'.SITEURL.'admin/add-vendor.php');
                            }

                        }
                    ?>

            </div>
        </div>
    </main>
</div>
    
<?php include('partials/footer.php'); ?>