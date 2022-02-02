<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>View Full Notification.</h1>
                    <small>Reply to reserved notification.</small>
                </div>
            </div>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    
                    $sql = "SELECT * FROM tbl_no WHERE id=$id";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    if($count==1){
                        $rows = mysqli_fetch_assoc($res);
                        $creator_id = $rows['creator_id'];
                        $creator = $rows['creator'];
                        $title = $rows['title'];
                        $message = $rows['message'];
                        $date = $rows['date'];
                        $table_name = $rows['table_name'];
                    } else {
                        $_SESSION['no-notification-found']= "<div class='Failed-to-do'>Vendoer Company Not Founded.</div>";
                        header('location:'.SITEURL.'admin/notification-reseved-all.php');
                    }
                } else {
                    header('location:'.SITEURL.'admin/notification-reseved-all.php');
                }
            ?>
            <div class="notifi-single">
                <div class="notifi-info">
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
                    <div class="notifi-single-head">
                        <h2><?php echo $title; ?></h2>
                        <span>By <?php echo $creator; ?></span>
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
                    <div class="notifi-single-body">
                        <p><?php echo $message; ?></p>
                    </div>
                    <div class="notifi-single-footer">
                        <p><?php echo $date; ?></p>
                        <a href="<?php echo SITEURL; ?>admin/notification-create.php">Reply</a>
                    </div>
                </div>
            </div>
            </main>
    </div>
<?php include('partials/footer.php'); ?>