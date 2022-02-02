<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>View all your Notifications</h1>
                    <small>Edit or Delete your notifications.</small>
                    <?php 
            
                        if(isset($_SESSION['notice-delete'])){
                            echo $_SESSION['notice-delete']; 
                            unset($_SESSION['notice-delete']); 
                        }

                        if(isset($_SESSION['noticeAdd'])){ 
                            echo $_SESSION['noticeAdd']; 
                            unset($_SESSION['noticeAdd']); 
                        }

                        if(isset($_SESSION['noticeUpdate'])){ 
                            echo $_SESSION['noticeUpdate']; 
                            unset($_SESSION['noticeUpdate']); 
                        }

                    ?>
                    </div>
            </div>
            <div class="cards">
            <?php 
                if(isset($_SESSION['id'])){
                    $user_id = $_SESSION['id'];
                    
                    $sql = "SELECT * FROM tbl_no WHERE table_name='tbl_employeee' ORDER BY date DESC";

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
                                $to_table = $rows['to_table'];

                                if($user_id == $creator_id){
                                ?>
                                    <div>
                                        <div class="card-head-notifi">
                                            <?php
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

                                            ?>
                                            <div>
                                                <h6><?php echo $title; ?></h6>
                                                <span><?php echo $creator; ?></span>
                                            </div>
                                        </div>
                                        <div class="card-single-notifi">
                                            <p><?php echo $message; ?></p>
                                            <h5 style="text-align: right;">~ To Admin ~</h5>
                                        </div>
                                        <div class="notifi-footer">
                                            <small><?php echo $date; ?></small>
                                            <div class="notifi-links">
                                                <a href="<?php echo SITEURL; ?>employee/notification-update.php?id=<?php echo $id; ?>" class="update">Update</a>
                                                <a href="<?php echo SITEURL; ?>employee/notification-delete.php?id=<?php echo $id; ?>" class="delete">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
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