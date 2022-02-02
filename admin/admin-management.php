<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Admin Dashboard</h1>
                    <small>Manage your admins. Add and update the system admins.</small>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Admins</span>
                                <small>Number of admins</small>
                            </div>
                            <?php 
                                $sql2 = "SELECT * FROM tbl_admin";
                                $res2= mysqli_query($conn,$sql2);
                                $count2 = mysqli_num_rows($res2);
                            ?>

                            <h2><?php echo $count2; ?></h2>

                            <div class="card-footer">
                                <a href="view-admin.php">View All</a>
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
                                <span>New Admins</span>
                                <small>Add new admins</small>
                            </div>

                            <div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-admin.php">Add Now</a>
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