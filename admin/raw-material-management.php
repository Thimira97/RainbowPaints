<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Raw Material Dashboard</h1>
                    <small>Manage your raw materials. Add and Approve your vendor companies.</small>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Vendor Companies</span>
                                <small>Number of vendor companies</small>
                            </div>
                            <?php 
                                $sql1 = "SELECT * FROM tbl_vendor WHERE approvement='Yes'";
                                $res1= mysqli_query($conn,$sql1);
                                $count1 = mysqli_num_rows($res1);
                            ?>
                            <h2><?php echo $count1; ?></h2>

                            <div class="card-footer">
                                <a href="view-vendor.php">View All</a>
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
                                <span>New Vendor Companies</span>
                                <small>Add new vendor company</small>
                            </div>

                            <div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-vendor.php">Add Now</a>
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
                                <span>Approve Vendor Company</span>
                                <small>Find new vendor companies</small>
                            </div>
                            <?php 
                                $sql5 = "SELECT * FROM tbl_vendor WHERE approvement=''";
                                $res5= mysqli_query($conn,$sql5);
                                $count5 = mysqli_num_rows($res5);
                            ?>
                            <h2><?php echo $count5; ?></h2>

                            <div class="card-footer">
                                <a href="approve-vendor.php">Approve Now</a>
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
                                <span>Exsisting Raw Materials</span>
                                <small>Number of raw materials</small>
                            </div>
                            <?php 
                                $sql0 = "SELECT * FROM tbl_rawmatirial";
                                $res0= mysqli_query($conn,$sql0);
                                $count0 = mysqli_num_rows($res0);
                            ?>
                            <h2><?php echo $count0; ?></h2>

                            <div class="card-footer">
                                <a href="view-exsisting-rawmaterial.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart danger">
                            <span class="las la-oil-can"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Vendor's Raw Materials</span>
                                <small>Number of raw materials</small>
                            </div>
                            <?php 
                                $sql0 = "SELECT * FROM tbl_rawmatirial";
                                $res0= mysqli_query($conn,$sql0);
                                $count0 = mysqli_num_rows($res0);
                            ?>
                            <h2><?php echo $count0; ?></h2>

                            <div class="card-footer">
                                <a href="view-rawmaterial.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-oil-can"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Delivered Purchasings</span>
                                <small>Number of delivered purchasings</small>
                            </div>
                            <?php 
                                $sql2 = "SELECT * FROM tbl_purchase WHERE status='Delivered'";
                                $res2= mysqli_query($conn,$sql2);
                                $count2 = mysqli_num_rows($res2);
                            ?>
                            <h2><?php echo $count2; ?></h2>

                            <div class="card-footer">
                                <a href="view-delivered-purchase.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-check-square"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Purchasings</span>
                                <small>Number of purchasings</small>
                            </div>
                            <?php 
                                $sql3 = "SELECT * FROM tbl_purchase WHERE status!='Delivered'";
                                $res3= mysqli_query($conn,$sql3);
                                $count3 = mysqli_num_rows($res3);
                            ?>
                            <h2><?php echo $count3; ?></h2>

                            <div class="card-footer">
                                <a href="view-raw-purchase.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart danger">
                            <span class="las la-shopping-cart"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Order Raw Materials</span>
                                <small>Add order</small>
                            </div>

                            <div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-raw-purchase.php">Order Now</a>
                            </div>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-plus-circle"></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>