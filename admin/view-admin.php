<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Admins</h1>
                    <small>Find deails about the all admins</small>
                    <br>
                    <?php 

                        if(isset($_SESSION['add-admin'])){
                            echo $_SESSION['add-admin'];
                            unset($_SESSION['add-admin']);
                        }

                        if(isset($_SESSION['no-admin-found'])){
                            echo $_SESSION['no-admin-found'];
                            unset($_SESSION['no-admin-found']);
                        }

                        if(isset($_SESSION['upload'])){
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }

                        if(isset($_SESSION['file-remove'])){
                            echo $_SESSION['file-remove'];
                            unset($_SESSION['file-remove']);
                        }

                        if(isset($_SESSION['update'])){
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }

                        if(isset($_SESSION['remove'])){
                            echo $_SESSION['remove'];
                            unset($_SESSION['remove']);
                        }

                        if(isset($_SESSION['delete'])){
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }
                    
                    ?>
                </div>
            </div>

            <div class="jobs">
                <div class="table-responsive">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="head">
                                        <span class="indicator"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="head">Full Name</div>
                                </td>
                                <td>
                                    <div class="head">User Name</div>
                                </td>
                                <td>
                                    <div class="head">Email Address</div>
                                </td>
                                <td>
                                    <div class="head">Profile Picture</div>
                                </td>
                                <td>
                                    <div class="head">Actions</div>
                                </td>
                            </tr>

                            <?php 
                                $sql = "SELECT * FROM tbl_admin";
                                
                                $res = mysqli_query($conn,$sql);
                                
                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn = 1;
                                        while($rows=mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $full_name = $rows['full_name'];
                                            $username = $rows['username'];
                                            $email = $rows['email'];
                                            $image_name = $rows['image_name'];
                            ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $full_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $username; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $email; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <?php 
                                                                if($image_name!=""){
                                                                    ?>
                                                                    <img src="<?php echo SITEURL; ?>images/profile/<?php echo $image_name; ?>" style="width: 50px; border-radius: 50%;">
                                                                    <?php
                                                                } else {
                                                                    echo "<div class='error'>Image not Added.</div>";
                                                                }
                                                        
                                                            ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="update">Update Admin</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="delete">Delete Admin</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<div class='error'>There is no data in the table</div>";
                                        }
                                    }
                                
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <?php include('partials/footer.php'); ?>