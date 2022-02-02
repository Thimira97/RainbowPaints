<header>
	<div class="menu-toggle">
		<label for="sidebar-toggle">
			<span class="las la-bars"></span>
		</label>
	</div>

	<div class="header-icons">
        <a href="notification-all.php"> <span class="las la-bookmark"></span></a>
        <a href="notification-create.php"><span class="las la-sms"></span></a>
		<!-- Notification Start -->
		<?php 
            if(isset($_SESSION['id'])){
                $id = $_SESSION['id'];
                
                $sql = "SELECT * FROM tbl_no WHERE to_table='tbl_employeee' OR to_table='all' ORDER BY date DESC ";

                $res = mysqli_query($conn,$sql);

                if($res==TRUE){
                    $count = mysqli_num_rows($res);
                    ?>
                        <span class="las la-bell" onclick="toggleNotifi()"></span><span onclick="toggleNotifi()" class="num"><?php echo $count; ?></span>
                        <div class="notifi-box" id="box">
                            <div class="notifiHead">
                                <h2>Notification <span><?php echo $count; ?></span></h2>
                            </div>
                            <div class="notifiInfor">       
                    <?php
                    if($count>0){
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $creator_id = $rows['creator_id'];
                            $creator = $rows['creator'];
                            $title = $rows['title'];
                            $date= $rows['date'];
                            $table_name = $rows['table_name'];
                            ?>
                                <div class="notifi-item">
                            <?php

                            if($table_name=="tbl_admin"){
                                $sql1 = "SELECT * FROM tbl_admin WHERE id=$creator_id ";
                                $res1 = mysqli_query($conn,$sql1);
                                $count1 = mysqli_num_rows($res1);
                                $row = mysqli_fetch_assoc($res1);
                                $image_name = $row['image_name'];

                                    if($image_name!=""){
                                        ?><img src="<?php echo SITEURL; ?>images/profile/<?php echo $image_name; ?>" alt="img"><?php
                                    } else {
                                        ?><img src="<?php echo SITEURL; ?>images/avatar2.png" alt="img"><?php
                                    }
                            } else {
                                ?><img src="<?php echo SITEURL; ?>images/avatar3.png" alt="img"><?php
                            }

                            ?>
                                    <div class="text">
                                        <h4><?php echo $creator; ?></h4>
                                        <p><?php echo $title; ?></p>
                                        <ul>
                                            <li><p><?php echo $date; ?></p></li>
                                            <li><a href="<?php echo SITEURL; ?>employee/notification-reseved-single.php?id=<?php echo $id; ?>">View Notification</a></li>
                                        </ul>
                                    </div>
                                </div> 
                                
                            <?php
                        }
                    } ?>
                        </div>  
                        <div class="notifiBottom">
                            <a href="<?php echo SITEURL; ?>employee/notification-reseved-all.php">View All Notifications</a>
                        </div>
                    </div>
                    <?php
                }
            }
        ?>
		<!-- Notification End -->
        <a href="logout.php"><span class="las la-sign-out-alt"></span></a>
		<!-- Notification End -->
	</div>
</header>