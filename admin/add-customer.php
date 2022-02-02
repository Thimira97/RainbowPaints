<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Add a New Customer</h1>
                    <small>Fill the details about the new customer.</small>

                    <?php 
                        
                        if(isset($_SESSION['customer-add'])){
                            echo $_SESSION['customer-add'];
                            unset($_SESSION['customer-add']);
                        }

                    ?>
                    </div>
            </div>

            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="s_name" required>
                                <div class="underline"></div>
                                <label>Shop Name</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="username" required>
                                <div class="underline"></div>
                                <label>User Name</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="owner" required>
                                <div class="underline"></div>
                                <label>Owner Name</label>
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
                                <label>Email</label>
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
                            $s_name = $_POST['s_name'];
                            $username = $_POST['username'];
                            $owner = $_POST['owner'];
                            $address = $_POST['address'];
                            $email = $_POST['email'];
                            $contact = $_POST['contact'];
                            $password = md5($_POST['password']);
                            $approvement=$_POST['approvement'];

                            $sql = "INSERT INTO tbl_customershop SET 
                                s_name='$s_name',
                                username='$username',
                                owner='$owner',
                                address='$address',
                                email='$email',
                                contact='$contact',
                                password='$password',
                                approvement='$approvement'
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['customer-add'] = "<div class='successfuly-done'>Customer Shop Added Successfully.</div>";
                                header('location:'.SITEURL.'admin/view-customer.php');
                            } else {
                                $_SESSION['customer-add'] = "<div class='Failed-to-do'>Failed to Add Customer Shop.</div>";
                                header('location:'.SITEURL.'admin/add-customer.php');
                            }

                        }
                    ?>
                </div>
            </div>
        </main>
    </div>
<?php include('partials/footer.php'); ?>