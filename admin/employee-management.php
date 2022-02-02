<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Employee Dashboard</h1>
                    <small>Manage your employees. Add and Approve your employees.</small>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Employees</span>
                                <small>Number of employees</small>
                            </div>
                            <?php 
                                $sql0 = "SELECT * FROM tbl_employeee WHERE approvement='Yes'";
                                $res0= mysqli_query($conn,$sql0);
                                $count0 = mysqli_num_rows($res0);
                            ?>
                            <h2><?php echo $count0; ?></h2>

                            <div class="card-footer">
                                <a href="view-employee.php">View All</a>
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
                                <span>New Employees</span>
                                <small>Add new employees</small>
                            </div>

                            <div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-employee.php">Add Now</a>
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
                                <span>Approve Employees</span>
                                <small>Hire new employees</small>
                            </div>
                            <?php 
                                $sql1 = "SELECT * FROM tbl_employeee WHERE approvement=''";
                                $res1= mysqli_query($conn,$sql1);
                                $count1 = mysqli_num_rows($res1);
                            ?>
                            <h2><?php echo $count1; ?></h2>

                            <div class="card-footer">
                                <a href="approve-employee.php">Approve Now</a>
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
                                <span>Attendence</span>
                                <small>Add employee's attendence</small>
                            </div>

                            <div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="view-attendence.php">Add Attendence Now</a>
                            </div>
                        </div>
                        <div class="card-chart orange">
                            <span class="las la-check-square"></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>