<input type="checkbox" name="" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="../images/logo2.png" alt="img">
                <h2>Nipolac</h2>
                <div class="brand-icons">
                    <a href="profile.php"><span class="las la-user-circle"></span></a>
                </div>
            </div>
        </div>

        <div class="sidebar-main">
            <div class="sidebar-user">
                <?php 
                    if(isset($_SESSION['id'])){
                        $id = $_SESSION['id'];
                        
                        $sql = "SELECT * FROM tbl_admin WHERE id=$id";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);
                        if($count==1){
                            $row = mysqli_fetch_assoc($res);
                            $full_name=$row['full_name'];
                            $email=$row['email'];
                            $image_name = $row['image_name'];

                            if($image_name != ""){

                            
                            ?>
                                <img src="<?php echo SITEURL; ?>images/profile/<?php echo $image_name; ?>">
                                <div>
                                    <h3><?php echo $full_name; ?></h3>
                                    <span><?php echo $email; ?></span>
                                </div>
                            <?php
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/profile/person-icon.png" class="profile_image" style="background: #fff; ">
                                <div>
                                    <h3><?php echo $full_name; ?></h3>
                                    <span><?php echo $email; ?></span>
                                </div>
                                <?php
                            }
                        } else {
                            //redirect to admin management with message
                            $_SESSION['not-found']= "<div class='error-text'>Admin Not Founded.</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                    } else {
                        header('location:'.SITEURL.'admin/login.php');
                    }
                
                ?>     

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
            </div>

            <div class="sidebar-menu">
                <div class="menu-block">
                    <ul>
                        <li>
                            <a href="index.php">
                                <span class="las la-chart-pie"></span> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="admin-management.php">
                                <span class="las la-user"></span> Admin
                            </a>
                        </li>
                        <li>
                            <a href="employee-management.php">
                                <span class="las la-users"></span> Employee
                            </a>
                        </li>
                        <li>
                            <a href="production-management.php">
                                <span class="las la-fill"></span> Paint
                            </a>
                        </li>
                        <li>
                            <a href="raw-material-management.php">
                                <span class="las la-oil-can"></span> Raw Material
                            </a>
                        </li>
                        <li>
                            <a href="order-management.php">
                                <span class="las la-shopping-cart"></span> Order
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>