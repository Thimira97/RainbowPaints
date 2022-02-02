<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Customer Shops</h1>
                    <small>Find deails about the all customer shops.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['customer-add'])){
                            echo $_SESSION['customer-add']; 
                            unset($_SESSION['customer-add']); 
                        }

                        if(isset($_SESSION['customer-delete'])){
                            echo $_SESSION['customer-delete']; 
                            unset($_SESSION['customer-delete']); 
                        }

                        if(isset($_SESSION['customer-update'])){
                            echo $_SESSION['customer-update']; 
                            unset($_SESSION['customer-update']); 
                        }

                        if(isset($_SESSION['no-customer-found'])){
                            echo $_SESSION['no-customer-found']; 
                            unset($_SESSION['no-customer-found']); 
                        }
                        
                        if(isset($_SESSION['approving'])){
                            echo $_SESSION['approving']; 
                            unset($_SESSION['approving']); 
                        }

                        if(isset($_SESSION['remove'])){
                            echo $_SESSION['remove']; 
                            unset($_SESSION['remove']); 
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
                                    <div class="head">Shop's Name</div>
                                </td>
                                <td>
                                    <div class="head">User Name</div>
                                </td>
                                <td>
                                    <div class="head">Owner's Name</div>
                                </td>
                                <td>
                                    <div class="head">Address</div>
                                </td>
                                <td>
                                    <div class="head">Email</div>
                                </td>
                                <td>
                                    <div class="head">Contact Number</div>
                                </td>
                                <td>
                                    <div class="head">Actons</div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_customershop WHERE approvement='Yes'";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $s_name = $rows['s_name'];
                                            $username = $rows['username'];
                                            $owner = $rows['owner'];
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
                                                        <div><?php echo $s_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $username; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $owner; ?></div>
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
                                                            <a href="<?php echo SITEURL; ?>admin/update-customer.php?id=<?php echo $id; ?>" class="update">Update</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-customer.php?id=<?php echo $id; ?>" class="delete">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
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