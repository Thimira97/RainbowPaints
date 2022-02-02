<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Order Dashboard</h1>
                    <small>Manage your Orders and view order details.</small>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Dilivered Orders</span>
                                <small>Number of delivered orders.</small>
                            </div>
                            
							<?php 
                                $customer = $_SESSION['id'];
								$sql1 = "SELECT * FROM tbl_order WHERE customer_id=$customer AND status='Delivered'";
								$res1 = mysqli_query($conn,$sql1);
								$count1 = mysqli_num_rows($res1)
							?>
                            <h2><?php echo $count1; ?></h2>

                            <div class="card-footer">
                                <a href="order-history.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart danger">
                            <span class="las la-table"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>New Order</span>
                                <small>Add new order</small>
                            </div>

							<div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-order.php">Add Now</a>
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
                                <span>Orders</span>
                                <small>Find new orders</small>
                            </div>
                            <?php 
								$sql = "SELECT * FROM tbl_order WHERE customer_id=$customer AND status!='Delivered'";
								$res = mysqli_query($conn,$sql);
								$count = mysqli_num_rows($res)
							?>
                            <h2><?php echo $count; ?></h2>

                            <div class="card-footer">
                                <a href="pending-orders.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-check-circle"></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>