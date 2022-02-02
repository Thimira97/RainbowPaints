<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Analytics Dashboard</h1>
                    <small>View all of the availabilities and profits.</small>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Production</span>
                                <small>Total Value of Production</small>
                            </div>
                            <?php 
                                $sql10 = "SELECT SUM(total_price) AS Total FROM tbl_production";
                                $res10 = mysqli_query($conn,$sql10);
                                $row10 = mysqli_fetch_assoc($res10);
                                $total_revenue10 = $row10['Total'];
                            ?>

                            <h2><?php echo $total_revenue10; ?>LKR</h2>
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
                                <span>Purchase</span>
                                <small>Total Expenditure for Purchasings</small>
                            </div>
                            <?php 
                                $sql11 = "SELECT SUM(total_price) AS Total FROM tbl_purchase WHERE status='Delivered' ";
                                $res11 = mysqli_query($conn,$sql11);
                                $row11 = mysqli_fetch_assoc($res11);
                                $total_revenue11 = $row11['Total'];
                            ?>

                            <h2><?php echo $total_revenue11; ?>LKR</h2>
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
                                <span>Sales</span>
                                <small>Total Income from Sales</small>
                            </div>
                            <?php 
                                $sql12 = "SELECT SUM(total_price) AS Total FROM tbl_order WHERE status='Delivered' ";
                                $res12 = mysqli_query($conn,$sql12);
                                $row12 = mysqli_fetch_assoc($res12);
                                $total_revenue12 = $row12['Total'];
                            ?>

                            <h2><?php echo $total_revenue12; ?>LKR</h2>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-hand-holding-usd"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jobs-grid">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h3>10 Days Sales And Sale Amount</h3>
                    </div>
                    <?php 
                        $sql3 = "SELECT * FROM tbl_order WHERE status='Delivered' LIMIT 10";
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
                            color: 'red',
                            hideHover: 'auto',
                        });
                    </script>

                    <div class="analytics-note">
                        <small>Note: This chart shows the 10 days sales of the paints and it's amounts.</small>
                    </div>
                </div>
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h3>10 Days Purchesing Prices And Sale Amount</h3>
                    </div>
                    <?php 
                        $sql4 = "SELECT * FROM tbl_purchase WHERE status!='Cancelled' LIMIT 10";
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

            <div class="jobs-grid1">
                <div class="analytics-card">
                        <div class="analytics-head">
                            <h3>Production Amount</h3>
                        </div>
                        <?php 
                            $sql5 = "SELECT * FROM tbl_production LIMIT 10";
                            $res5 = mysqli_query($conn,$sql5);
                            $chart_data5 = '';
                            while($row5 = mysqli_fetch_array($res5)){
                                $paint_id = $row5['paint_id'];

                                $sql7 = "SELECT * FROM tbl_paint WHERE id=$paint_id";
                                $res7 = mysqli_query($conn,$sql7);
                                $count7 = mysqli_num_rows($res7);
                                if($count7>0){
                                    while($row7=mysqli_fetch_array($res7)){
                                        $paint_name = $row7['paint_name'];
                                        
                                    }
                                }
                                $chart_data5 .= "{ paint_name:'".$paint_name."',producted_amount:".$row5["producted_amount"]."}, ";
                            }
                            $chart_data5 = substr($chart_data5,0,-2);
                        ?>

                        <div id="chart5"></div>

                        <script>
                            Morris.Bar({
                                element : 'chart5',
                                data: [<?php echo $chart_data5; ?>],
                                xkey: 'paint_name',
                                ykeys: ['producted_amount'],
                                labels: ['producted_amount'],
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
                            <small>Note: This shows the production of paints.</small>
                        </div>
                    </div>
                </div>
                
             <div class="jobs-grid">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h3>Raw Material and Total Prices</h3>
                    </div>
                    <?php 
                        $sql = "SELECT * FROM tbl_exist_raw LIMIT 10";
                        $res = mysqli_query($conn,$sql);
                        $chart_data1 = '';
                        while($row = mysqli_fetch_array($res)){
                            $chart_data1 .= "{ raw_name:'".$row["raw_name"]."',total_price:".$row["total_price"]."}, ";
                        }
                        $chart_data1 = substr($chart_data1,0,-2);
                    ?>

                    <div id="chart1"></div>

                    <script>
                        Morris.Bar({
                            element : 'chart1',
                            data: [<?php echo $chart_data1; ?>],
                            xkey: 'raw_name',
                            ykeys: ['total_price'],
                            labels: ['total_price'],
                            hideHover: 'auto',
                        });
                    </script>

                    <div class="analytics-note">
                        <small>Note: This shows the top 10 raw materials and it's total value.</small>
                    </div>
                </div>
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h3>Raw Materials and Amount</h3>
                    </div>
                    <?php 
                        $sql2 = "SELECT * FROM tbl_exist_raw LIMIT 10";
                        $res2 = mysqli_query($conn,$sql2);
                        $chart_data2 = '';
                        while($row2 = mysqli_fetch_array($res2)){
                            $chart_data2 .= "{ raw_name:'".$row2["raw_name"]."',total_amount:".$row2["total_amount"]."}, ";
                        }
                        $chart_data2 = substr($chart_data2,0,-2);
                    ?>

                    <div id="chart2"></div>

                    <script>
                        Morris.Bar({
                            element : 'chart2',
                            data: [<?php echo $chart_data2; ?>],
                            xkey: 'raw_name',
                            ykeys: ['total_amount'],
                            labels: ['total_amount'],
                            hideHover: 'auto',
                        });
                    </script>

                    <div class="analytics-note">
                        <small>Note: This shows the availability of top 10 raw materials.</small>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>