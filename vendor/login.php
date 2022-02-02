<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="Itr">
<head>
	<meta charset="utf-8">
	<title>Rainbow Paints - Vendor Login - Form</title>
    <link rel="stylesheet" href="../css/home-style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-dark py-3">
        <div class="container"><a href="../index.php" class="navbar-brand text-uppercase font-weight-bold">Rainbow Paints</a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="../index.php" class="nav-link text-uppercase font-weight-bold">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a href="../admin.php" class="nav-link text-uppercase font-weight-bold">Admin</a></li>
                    <li class="nav-item"><a href="../customer.php" class="nav-link text-uppercase font-weight-bold">Customer Shop</a></li>
                    <li class="nav-item"><a href="../vendorCompany.php" class="nav-link text-uppercase font-weight-bold">Vendor Company</a></li>
                    <li class="nav-item"><a href="../employees.php" class="nav-link text-uppercase font-weight-bold">Employee</a></li>
                    <li class="nav-item"><a href="../index.php#footer" class="nav-link text-uppercase font-weight-bold">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    </header>

    <div class="bodyText1">
        <div class="container1">
                <h2 class="title">Vendor Login</h2>
                <?php 
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login']; 
                        unset($_SESSION['login']); 
                    }

                    if(isset($_SESSION['no-login-message'])){
                        echo $_SESSION['no-login-message']; 
                        unset($_SESSION['no-login-message']); 
                    }

                    if(isset($_SESSION['not-found'])){
                        echo $_SESSION['not-found']; 
                        unset($_SESSION['not-found']); 
                    }
                ?>
                <br>
            <form action="" method="POST" class="sign-in-form">
                <ul>
                    <li>
                        <div class="input-field">
                            <i class="fas fa-user"></i> 
                            <input type="text" name="username" placeholder="Username">	
                        </div>
                    </li>
                    <li>
                        <div class="input-field">
                            <i class="fas fa-lock"></i> 
                            <input type="password" name="password" placeholder="Password">	
                        </div>
                    </li>
                </ul>
                <input type="submit" name="submit" value="Login" class="btn1">
                <br><br>
                <a href="signup.php" class="linkSingnUp">Don't have an account?</a>
                
            </form>

            <?php 
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);

                    $sql = "SELECT * FROM tbl_vendor WHERE username='$username' AND password='$password'";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $approvement = $row['approvement'];

                    if($count==1){
                        if($approvement=="Yes"){
                            $_SESSION['login'] = "<div class='success-message' style='padding-bottom: 10px;'>Login Successful.</div>";
                            $_SESSION['user'] = $username;
                            $_SESSION['id'] = $id;

                            header('location:'.SITEURL.'vendor/');
                        } else {
                            $_SESSION['user'] = $username;
                            header('location:'.SITEURL.'vendor/pending-approvement.php');
                        }
                        
                    } else {
                        $_SESSION['login'] = "<div class='error-text text-center'>Username and Password did not Match.</div>";
                        header('location:'.SITEURL.'vendor/login.php');
                    }
                }
            
            ?>

        </div>
    </div>
    <footer class="bg-dark text-center text-white ">
    <!-- Section: Social media -->
        <section class="mb-4 social adminFooter">
            <!-- Facebook -->
            <a
                class="btn btn-primary btn-floating m-1"
                style="background-color: #3b5998;"
                href="#!"
                role="button"
                ><i class="fab fa-facebook-f"></i
            ></a>

            <!-- Twitter -->
            <a
                class="btn btn-primary btn-floating m-1"
                style="background-color: #55acee;"
                href="#!"
                role="button"
                ><i class="fab fa-twitter"></i
            ></a>

            <!-- Google -->
            <a
                class="btn btn-primary btn-floating m-1"
                style="background-color: #dd4b39;"
                href="#!"
                role="button"
                ><i class="fab fa-google"></i
            ></a>

            <!-- Instagram -->
            <a
                class="btn btn-primary btn-floating m-1"
                style="background-color: #ac2bac;"
                href="#!"
                role="button"
                ><i class="fab fa-instagram"></i
            ></a>

            <!-- Linkedin -->
            <a
                class="btn btn-primary btn-floating m-1"
                style="background-color: #0082ca;"
                href="#!"
                role="button"
                ><i class="fab fa-linkedin-in"></i
            ></a>
        </section>
    <!-- Section: Social media -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 All Copyright reserved. Rainbow Paints - Developed By - Thimira Madusanka
    </div>
    <!-- Copyright -->
</footer>

</body>
<?php 
    ob_end_flush();
?>
</html>