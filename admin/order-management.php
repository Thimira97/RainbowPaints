<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Order Dashboard</h1>
                    <small>Manage your Orders and Customer Shops. Add and Approve your Customer Shops.</small>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Customer Shops</span>
                                <small>Number of customer shops</small>
                            </div>
                            <?php 
                                $sql2 = "SELECT * FROM tbl_customershop WHERE approvement='Yes'";
                                $res2= mysqli_query($conn,$sql2);
                                $count2 = mysqli_num_rows($res2);
                            ?>
                            <h2><?php echo $count2; ?></h2>

                            <div class="card-footer">
                                <a href="view-customer.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart danger">
                            <span class="las la-user"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>New Customer Shop</span>
                                <small>Add new customer shop</small>
                            </div>

                            <div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-customer.php">Add Now</a>
                            </div>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-plus-circle"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Approve Customer Shop</span>
                                <small>Find new customer shops</small>
                            </div>
                            <?php 
                                $sql3 = "SELECT * FROM tbl_customershop WHERE approvement=''";
                                $res3= mysqli_query($conn,$sql3);
                                $count3 = mysqli_num_rows($res3);
                            ?>
                            <h2><?php echo $count3; ?></h2>

                            <div class="card-footer">
                                <a href="approve-customer.php">Approve Now</a>
                            </div>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-check-circle"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Delivered Orders</span>
                                <small>Number of delivered orders</small>
                            </div>
                            <?php 
                                $sql4 = "SELECT * FROM tbl_order WHERE status='Delivered'";
                                $res4= mysqli_query($conn,$sql4);
                                $count4 = mysqli_num_rows($res4);
                            ?>
                            <h2><?php echo $count4; ?></h2>

                            <div class="card-footer">
                                <a href="view-orders.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart danger">
                            <span class="las la-check-square"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Order</span>
                                <small>Deliver orders</small>
                            </div>
                            <?php 
                                $sql5 = "SELECT * FROM tbl_order WHERE status!='Delivered' AND status!='Cancelled'";
                                $res5= mysqli_query($conn,$sql5);
                                $count5 = mysqli_num_rows($res5);
                            ?>
                            <h2><?php echo $count5; ?></h2>

                            <div class="card-footer">
                                <a href="add-statues.php">Deliver Now</a>
                            </div>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-shopping-cart"></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>