<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Analytics Dashboard</h1>
                    <small>View your summerided purchasings</small>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Purchases</span>
                                <small>Number of purchases</small>
                            </div>
                            <?php 
                                $customer = $_SESSION['id'];
								$sql2 = "SELECT * FROM tbl_order WHERE customer_id=$customer";
								$res2 = mysqli_query($conn,$sql2);
								$count2 = mysqli_num_rows($res2)
							?>
                            <h2><?php echo $count2; ?></h2>
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
                                <span>Cancelled Orders</span>
                                <small>Numer of cancelled orders</small>
                            </div>
                            <?php 
								$sql = "SELECT * FROM tbl_order WHERE customer_id=$customer AND status='Cancelled'";
								$res = mysqli_query($conn,$sql);
								$count = mysqli_num_rows($res)
							?>
                            <h2><?php echo $count; ?></h2>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-chart-line"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Total Cost</span>
                                <small>Value of all delivered orders</small>
                            </div>
                            <?php 
                                $sql10 = "SELECT SUM(total_price) AS Total FROM tbl_order WHERE customer_id=$customer AND status='Delivered'";
                                $res10 = mysqli_query($conn,$sql10);
                                $row10 = mysqli_fetch_assoc($res10);
                                $total_revenue10 = $row10['Total'];
                            ?>
                            <h2><?php echo $total_revenue10; ?>LKR</h2>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-coins"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jobs-grid">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h3>10 Days Orders</h3>
                    </div>
                    <?php 
                        $sql3 = "SELECT * FROM tbl_order WHERE customer_id=$customer AND status='Delivered' LIMIT 10";
                        $res3 = mysqli_query($conn,$sql3);
                        $chart_data3 = '';
                        while($row3 = mysqli_fetch_array($res3)){
                            $chart_data3 .= "{ date:'".$row3["date"]."',amount:".$row3["amount"].",total_price:".$row3["total_price"]."}, ";
                        }
                        $chart_data3 = substr($chart_data3,0,-2);
                    ?>

                    <div id="chart3"></div>

                    <script>
                        Morris.Area({
                            element : 'chart3',
                            data: [<?php echo $chart_data3; ?>],
                            xkey: 'date',
                            ykeys: ['total_price','amount'],
                            labels: ['total_price','amount'],
                            hideHover: 'auto',
                        });
                    </script>

                    <div class="analytics-note">
                        <small>Note: This chart shows the 10 days delivered orders.</small>
                    </div>
                </div>
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h3>10 Days Cancelled Orders</h3>
                    </div>
                    <?php 
                        $sql5 = "SELECT * FROM tbl_order WHERE customer_id=$customer AND status='Cancelled' LIMIT 10";
                        $res5 = mysqli_query($conn,$sql5);
                        $chart_data5 = '';
                        while($row5 = mysqli_fetch_array($res5)){
                            $chart_data5 .= "{ date:'".$row5["date"]."',total_price:".$row5["total_price"]."}, ";
                        }
                        $chart_data5 = substr($chart_data5,0,-2);
                    ?>

                    <div id="chart5"></div>

                    <script>
                        Morris.Bar({
                            element : 'chart5',
                            data: [<?php echo $chart_data5; ?>],
                            xkey: 'date',
                            ykeys: ['total_price'],
                            labels: ['total_price'],
                            hideHover: 'auto',
                            barColors: function (row, series, type) {
                                    if (type === 'bar') {
                                    var red = Math.ceil(255 * row.y / this.ymax);
                                    return 'rgb(' + red + ',0,0)';
                                    }
                                    else {
                                    return '#000';
                                    }
                                }
                        });
                    </script>

                    <div class="analytics-note">
                        <small>Note: This chart shows the 10 days cancelled orders.</small>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>