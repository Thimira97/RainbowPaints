<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Analytics Dashboard</h1>
                    <small>View your summerized sales.</small>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Raw Materials</span>
                                <small>Number of Raw materials</small>
                            </div>
                            <?php 
                                $vendor =  $_SESSION['id'];
								$sql = "SELECT * FROM tbl_rawmatirial WHERE vendor_id=$vendor ";
								$res = mysqli_query($conn,$sql);
								$count = mysqli_num_rows($res)
							?>
                            <h2><?php echo $count; ?></h2>

                        </div>
                        <div class="card-chart danger">
                            <span class="las la-chart-line"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Total Income</span>
                                <small>Value of selling raw materials</small>
                            </div>
                            <?php 
                                $sql12 = "SELECT SUM(total_price) AS Total FROM tbl_purchase WHERE status='Delivered' AND vendor_id=$vendor ";
                                $res12 = mysqli_query($conn,$sql12);
                                $row12 = mysqli_fetch_assoc($res12);
                                $total_revenue12 = $row12['Total'];
                            ?>
                            <h2><?php echo $total_revenue12; ?>LKR</h2>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-coins"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Delivers</span>
                                <small>Nuber of pending delivers</small>
                            </div>
                            <?php 
                                $sql13 = "SELECT * FROM tbl_purchase WHERE status!='Delivered' AND status!='Cancelled' AND vendor_id=$vendor ";
                                $res13 = mysqli_query($conn,$sql13);
                                $count13 = mysqli_num_rows($res13);
                            ?>
                            <h2><?php echo $count13; ?></h2>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-truck"></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="jobs-grid1">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h3>10 Days Delivering Prices And Amount</h3>
                    </div>
                    <?php 
                        $sql4 = "SELECT * FROM tbl_purchase WHERE vendor_id=$vendor AND status='Delivered' LIMIT 10";
                        $res4 = mysqli_query($conn,$sql4);
                        $chart_data4 = '';
                        while($row4 = mysqli_fetch_array($res4)){
                            $chart_data4 .= "{ date:'".$row4["date"]."',amount:".$row4["amount"].",total_price:".$row4["total_price"]."}, ";
                        }
                        $chart_data4 = substr($chart_data4,0,-2);
                    ?>

                    <div id="chart4"></div>

                    <script>
                        Morris.Area({
                            element : 'chart4',
                            data: [<?php echo $chart_data4; ?>],
                            xkey: 'date',
                            ykeys: ['total_price','amount'],
                            labels: ['total_price','amount'],
                            color: 'red',
                            hideHover: 'auto',
                        });
                    </script>

                    <div class="analytics-note">
                        <small>Note: This chart shows the 10 days purchasing prices of the raw materials and it's amounts.</small>
                    </div>
                </div> 
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>