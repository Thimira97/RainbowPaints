<!DOCTYPE html>
<html lang="en" dir="Itr">
<head>
	<meta charset="utf-8">
	<title>Paint Company Management System</title>
    <link rel="stylesheet" href="css/home-style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(function() {
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 10) {
                    $('.navbar').addClass('active');
                } else {
                    $('.navbar').removeClass('active');
                }
            });
        });
    </script>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container"><a href="index.php" class="navbar-brand text-uppercase font-weight-bold">Paint House</a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="index.php" class="nav-link text-uppercase font-weight-bold">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a href="admin.php" class="nav-link text-uppercase font-weight-bold">Admin</a></li>
                    <li class="nav-item"><a href="customer.php" class="nav-link text-uppercase font-weight-bold">Customer Shop</a></li>
                    <li class="nav-item"><a href="vendorCompany.php" class="nav-link text-uppercase font-weight-bold">Vendor Company</a></li>
                    <li class="nav-item"><a href="employees.php" class="nav-link text-uppercase font-weight-bold">Employee</a></li>
                    <li class="nav-item"><a href="#footer" class="nav-link text-uppercase font-weight-bold">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    </header>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item banner1 active">
                <div class="carousel-caption text-center">
                        <h5>Welcome to Paint House</h5>
                        <p>If yo Wish to Join With Us</p>
                        <a href="employees.php" class="btn btn-outline-light btn-lg">Apply Now</a>
                    </div>
            </div>
            <div class="carousel-item banner2">
                <div class="carousel-caption text-center">
                        <h5>Welcome to Paint House</h5>
                        <p>If yo Wish to be a Vendor for Us</p>
                        <a href="vendorCompany.php" class="btn btn-outline-light btn-lg">Apply Now</a>
                    </div>
            </div>
            <div class="carousel-item banner3">
                <div class="carousel-caption text-center">
                        <h5>Welcome to Paint House</h5>
                        <p>If yo Wish to Buy Products from Us</p>
                        <a href="customer.php" class="btn btn-outline-light btn-lg">Apply Now</a>
                    </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card h-100">
                <img
                    src="images/admin.png"
                    class="card-img-top"
                    alt="..."
                />
                <div class="card-body">
                    <h5 class="card-title">Admin</h5>
                </div>
                <div class="card-footer">
                    <a href="admin.php" class="btn btn-outline-light btn-lg1">View</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img
                    src="images/employee1.png"
                    class="card-img-top"
                    alt="..."
                />
                <div class="card-body">
                    <h5 class="card-title">Employee</h5>
                </div>
                <div class="card-footer">
                    <a href="employees.php" class="btn btn-outline-light btn-lg1">View</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img
                    src="images/vendor.png"
                    class="card-img-top"
                    alt="..."
                />
                <div class="card-body">
                    <h5 class="card-title">Vendor Company</h5>
                </div>
                <div class="card-footer">
                    <a href="vendorCompany.php" class="btn btn-outline-light btn-lg1">View</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img
                    src="images/customer.png"
                    class="card-img-top"
                    alt="..."
                />
                <div class="card-body">
                    <h5 class="card-title">Customer Shop</h5>
                </div>
                <div class="card-footer">
                    <a href="customer.php" class="btn btn-outline-light btn-lg1">View</a>
                </div>
            </div>
        </div>
    </div>

<footer id="footer" class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
        <!--Grid row-->
        <div class="row">
        <!--Grid column-->
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
            <h5 class="text-uppercase">Paint House</h5>

            <p>
            We are the leading paint company in Sri Lanka. We produce various branded paints for you. Mainly wood paints, wall paints, floor paint and steal paints like varous kinds of paints produced by our company.
            If you want to buy execllent paints, visit us quickly. Now we are in arround the Sri Lanka. If you wish to be a employee, customer shop or vendor, Please fill the form. 
            </p>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0 contact">
            <h5 class="text-uppercase">Contact Us</h5>
            <ul class="list-unstyled mb-0">
                <li>
                    <i class="fas fa-envelope-square"></i> - painthouse@gmail.com
                </li>
                <li>
                    <i class="fas fa-phone-square-alt"></i> - 0382245712 / 0714515263
                </li>
                <li>
                    <i class="fas fa-address-card"></i> - No 11, Main Street,<br> Colombo 07.
                </li>
            </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0 links">
            <ul class="list-unstyled">
            <li>
                <a href="index.php" class="text-link">Home</a>
            </li>
            <li>
                <a href="admin.php" class="text-link">Admin</a>
            </li>
            <li>
                <a href="customer.php" class="text-link">customer Shop</a>
            </li>
            <li>
                <a href="vendorCompany.php" class="text-link">Vendor Company</a>
            </li>
            <li>
                <a href="employees.php" class="text-link">Employee</a>
            </li>
            </ul>
        </div>
        <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Section: Social media -->
        <section class="mb-4 social">
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
        © 2020 All Copyright reserved. Paint House - Developed By - Thimira Madusanka
    </div>
    <!-- Copyright -->
</footer>
   
</body>

</html>