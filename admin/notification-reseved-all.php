<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Reserved Notifications</h1>
                    <small>Find your reserved notifications.</small>
                    <?php 
                        
                        if(isset($_SESSION['no-notification-found'])){
                            echo $_SESSION['no-notification-found'];
                            unset($_SESSION['no-notification-found']);
                        }

                    ?>
                </div>
            </div>
            <div class="cards">
            <?php 
                if(isset($_SESSION['id'])){
                    $user_id = $_SESSION['id'];
                    
                    $sql = "SELECT * FROM tbl_no WHERE to_table='tbl_admin' ORDER BY date DESC";

                    $res = mysqli_query($conn,$sql);

                    if($res==TRUE){
                        $count = mysqli_num_rows($res);

                        if($count>0){
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $creator_id = $rows['creator_id'];
                                $creator = $rows['creator'];
                                $title = $rows['title'];
                                $message = $rows['message'];
                                $date = $rows['date'];
                                $table_name = $rows['table_name'];

                                ?>
                                    <div>
                                        <div class="card-head-notifi">
                                            <?php

                                                if($table_name=="tbl_employeee"){
                                                    $sql1 = "SELECT * FROM tbl_employeee WHERE id=$creator_id ";
                                                    $res1 = mysqli_query($conn,$sql1);
                                                    $count1 = mysqli_num_rows($res1);
                                                    $row = mysqli_fetch_assoc($res1);
                                                    $image_name = $row['image_name'];

                                                        if($image_name!=""){
                                                            ?><img src="<?php echo SITEURL; ?>images/employee/<?php echo $image_name; ?>" alt="img"><?php
                                                        } else {
                                                            ?><img src="<?php echo SITEURL; ?>images/avatar2.png" alt="img"><?php
                                                        }
                                                } else {
                                                    ?><img src="<?php echo SITEURL; ?>images/avatar3.png" alt="img"><?php
                                                }

                                            ?>
                                            <div>
                                                <h6><?php echo $title; ?></h6>
                                                <span><?php echo $creator; ?></span>
                                            </div>
                                        </div>
                                        <div class="card-single-notifi">
                                            <p><?php echo $message; ?></p>
                                            <?php 
                                                if($table_name=="tbl_vendor") {
                                                    echo "<h5 style='text-align: right;'>~ From Vendor Company ~</h5>";    
                                                } elseif($table_name=="tbl_customershop") {
                                                    echo "<h5 style='text-align: right;'>~ From Customer Shop ~</h5>";
                                                } elseif($table_name=="tbl_employeee") {
                                                    echo "<h5 style='text-align: right;'>~ From Employee ~</h5>";
                                                }else {
                                                    echo "<h5 style='text-align: right;'>~ From All ~</h5>";
                                                }
                                            ?>
                                        </div>
                                        <div class="notifi-footer">
                                            <small><?php echo $date; ?></small>
                                            <div class="notifi-links">
                                                <a href="<?php echo SITEURL; ?>admin/notification-reseved-single.php?id=<?php echo $id; ?>" class="update">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }

                                } else {
                                    ?>
                                    <h1>No notices..</h1>
                                <?php
                                }
                            }
                        }
                    ?>
            </div>
        </main>
    </div>
<?php include('partials/footer.php'); ?>