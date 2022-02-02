<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Vendor</h1>
                    <small>Find deails about the all vendor</small>
                    <br>
                        <?php 
                            if(isset($_SESSION['vendor-add'])){ 
                                echo $_SESSION['vendor-add']; 
                                unset($_SESSION['vendor-add']); 
                            }

                            if(isset($_SESSION['vendor-delete'])){ 
                                echo $_SESSION['vendor-delete']; 
                                unset($_SESSION['vendor-delete']); 
                            }

                            if(isset($_SESSION['vendor-update'])){ 
                                echo $_SESSION['vendor-update']; 
                                unset($_SESSION['vendor-update']); 
                            }

                            if(isset($_SESSION['no-vendor-found'])){ 
                                echo $_SESSION['no-vendor-found']; 
                                unset($_SESSION['no-vendor-found']); 
                            }

                            if(isset($_SESSION['approving'])){ 
                                echo $_SESSION['approving']; 
                                unset($_SESSION['approving']); 
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
                                    <div class="head">Company Name</div>
                                </td>
                                <td>
                                    <div class="head">User Name</div>
                                </td>
                                <td>
                                    <div class="head">Manager</div>
                                </td>
                                <td>
                                    <div class="head">Address</div>
                                </td>
                                <td>
                                    <div class="head">Email</div>
                                </td>
                                <td>
                                    <div class="head">Contact</div>
                                </td>
                                <td>
                                    <div class="head">Actions</div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_vendor WHERE approvement='Yes'";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $c_name = $rows['c_name'];
                                            $username = $rows['username'];
                                            $manager = $rows['manager'];
                                            $address = $rows['address'];
                                            $email = $rows['email'];
                                            $contact = $rows['contact'];
                                            ?>
                                            <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $c_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $username; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $manager; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $address; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $email; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $contact; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/update-vendor.php?id=<?php echo $id; ?>" class="update">Update</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-vendor.php?id=<?php echo $id; ?>" class="delete">Delete</a>
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