<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="Itr">
<head>
	<meta charset="utf-8">
	<title>Rainbow Paints - Vendor Approvement Pending</title>
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

    <div class="bodyTextpending">
        <?php 
            if(isset($_SESSION['user'])){
                $username = $_SESSION['user'];
            }
        ?>

        <h1 class="text2">Hello, <?php echo $username; ?>...</h1>
        <p>Your Account is not Approved till now.</p>
        <p>Our Team is Checking your Profile.</p>
        <p>Soon you will be Hired as a Vendor.</p>
        <hr>
        <h6 class="check">Check Later</h6>
        <a class="logoutfornow" href="../vendorCompany.php">Logout For Now</a>
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

</html>