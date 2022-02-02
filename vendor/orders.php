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
                                <span>Raw Materials</span>
                                <small>Number of raw materials.</small>
                            </div>
                            
							<?php 
                                $vendor =  $_SESSION['id'];
								$sql = "SELECT * FROM tbl_rawmatirial WHERE vendor_id=$vendor ";
								$res = mysqli_query($conn,$sql);
								$count = mysqli_num_rows($res)
							?>
                            <h2><?php echo $count; ?></h2>

                            <div class="card-footer">
                                <a href="view-rawmaterial.php">View All</a>
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
                                <span>New Raw Material</span>
                                <small>Add new raw material.</small>
                            </div>
							
							<div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-rawmaterial.php">Deliver Now</a>
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
                                <span>Dilivered Orders</span>
                                <small>Number of delivered orders.</small>
                            </div>
                            
							<?php 
								$sql2 = "SELECT * FROM tbl_purchase WHERE vendor_id=$vendor AND status='Delivered'";
								$res2 = mysqli_query($conn,$sql2);
								$count2 = mysqli_num_rows($res2)
							?>
                            <h2><?php echo $count2; ?></h2>

                            <div class="card-footer">
                                <a href="view-delivered-orders.php">View All</a>
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
                                <span>Deliver</span>
                                <small>Deliver orders now.</small>
                            </div>
							<?php 
								$sql3 = "SELECT * FROM tbl_purchase WHERE vendor_id=$vendor AND status!='Delivered' AND status!='Cancelled'";
								$res3 = mysqli_query($conn,$sql3);
								$count3 = mysqli_num_rows($res3)
							?>
							<h2><?php echo $count3; ?></h2>

                            <div class="card-footer">
                                <a href="add-statues.php">Deliver Now</a>
                            </div>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-check-square"></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?php include('partials/footer.php'); ?>