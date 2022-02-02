<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Production Dashboard</h1>
                    <small>Manage your productions. Add and Update your productions.</small>
                </div>
            </div>

            <div class="cards">
            <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Paint Categories</span>
                                <small>Number of paint categories</small>
                            </div>
                            <?php 
                                $sql0 = "SELECT * FROM tbl_category";
                                $res0= mysqli_query($conn,$sql0);
                                $count0 = mysqli_num_rows($res0);
                            ?>
                            <h2><?php echo $count0; ?></h2>

                            <div class="card-footer">
                                <a href="view-category.php">View All</a>
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
                                <span>New Category</span>
                                <small>Add new paint category</small>
                            </div>

                            <div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-category.php">Add Now</a>
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
                                <span>Paints Types</span>
                                <small>Number of paints type</small>
                            </div>
                            <?php 
                                $sql2 = "SELECT * FROM tbl_paint";
                                $res2= mysqli_query($conn,$sql2);
                                $count2 = mysqli_num_rows($res2);
                            ?>
                            <h2><?php echo $count2; ?></h2>

                            <div class="card-footer">
                                <a href="view-paint.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-table"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>New Paint</span>
                                <small>Add new paint</small>
                            </div>

                            <div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-paint.php">Add Now</a>
                            </div>
                        </div>
                        <div class="card-chart danger">
                            <span class="las la-plus-circle"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Producted Paints</span>
                                <small>Number of producted paints</small>
                            </div>
                            <?php 
                                $sql3 = "SELECT * FROM tbl_production";
                                $res3= mysqli_query($conn,$sql3);
                                $count3 = mysqli_num_rows($res3);
                            ?>
                            <h2><?php echo $count3; ?></h2>

                            <div class="card-footer">
                                <a href="view-production.php">View All</a>
                            </div>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-check-circle"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-infor">
                            <div class="card-head">
                                <span>Produce Paint</span>
                                <small>Add producted paint</small>
                            </div>

                            <div class="card-blank"></div>

                            <div class="card-footer">
                                <a href="add-production.php">Add Now</a>
                            </div>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-plus-circle"></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>