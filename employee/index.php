<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Analytics Dashboard</h1>
                    <small>View your summerized profile.</small>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Salary</span>
                                <small>Value of your salary</small>
                            </div><br>
                            <?php 
                                $employee = $_SESSION['id'];
                                $sql = "SELECT * FROM tbl_employeee WHERE id=$employee";
                                $res = mysqli_query($conn,$sql);
                                $count = mysqli_num_rows($res);
                                $row = mysqli_fetch_assoc($res);
                                $salary=$row['salary'];
                            ?>
                            <h2><?php echo $salary; ?>LKR</h2>
                        </div>
                        <div class="card-chart danger">
                            <span class="las la-hand-holding-usd"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Attendance Presentage</span>
                                <small>Prsentage of the Reporting to Work.</small>
                            </div>
                            <?php 
                                $sql1 = "SELECT * FROM tbl_attendence WHERE employee_id=$employee AND attendence='Present'";
                                $res1= mysqli_query($conn,$sql1);
                                $count1 = mysqli_num_rows($res1);

                                $sql3 = "SELECT * FROM tbl_attendence WHERE employee_id=$employee";
                                $res3= mysqli_query($conn,$sql3);
                                $count3 = mysqli_num_rows($res3);

                                $presentage = ($count1/$count3)*100 ;
                            ?>
                            <h2><?php echo round($presentage,2)."%"; ?></h2>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-percentage"></span>
                        </div>
                    </div>
                </div>

                <?php 
                    $sql5 = "SELECT * FROM tbl_attendence WHERE employee_id=$employee AND attendence='Absent'";
                    $res5= mysqli_query($conn,$sql5);
                    $count5 = mysqli_num_rows($res5);

                    if($count5>=4){
                ?>

                <div class="card-single-war">
                    <div class="card-flex">
                        <div class="card-infor-war">
                            <div class="card-head-war">
                                <span>Warning</span>
                                <small>You got more than recomended leaves.</small>
                            </div>

                            <h2><?php echo $count5; ?></h2>
                        </div>
                        <div class="card-chart white">
                            <span class="las la-exclamation"></span>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="jobs-grid">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h3>Attendence</h3>
                    </div>
                    <?php 
                        $sql4 = "SELECT attendence, count(*) as no_of_attendence FROM tbl_attendence WHERE employee_id=$employee GROUP By attendence ";
                        $res4 = mysqli_query($conn,$sql4);
                        $data = array();
                        while($row4 = mysqli_fetch_array($res4))
                        {
                            $data[] = array(
                                'label' => $row4["attendence"],
                                'value' => $row4["no_of_attendence"]
                            );
                        }
                        $data = json_encode($data);
                    ?>

                    <div id="chart4"></div>

                    <script>
                        Morris.Donut({
                        element: 'chart4',
                        data: <?php echo $data; ?>,
                        labelColor: '#7401DF',
                        colors: [
                            '#642EFE',
                            '#380B61'
                        ]
                        });
                    </script>
                    <div class="analytics-note">
                        <small>Note: This chart shows the your repoting work details.</small>
                    </div>
                </div> 
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>