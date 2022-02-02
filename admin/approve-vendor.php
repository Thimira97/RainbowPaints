<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>New Vendor Company</h1>
                    <small>Approve and hire new vendor company.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['remove'])){ 
                            echo $_SESSION['remove'];
                            unset($_SESSION['remove']);
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
                                    <div class="head">Manager's Name</div>
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
                                    <div class="head">Actions</div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_vendor WHERE approvement=''";

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
                                                        <div><?php echo $c_name ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $username ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $manager ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $address ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $email ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $contact ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/approving-vendor.php?id=<?php echo $id; ?>" class="update">Approve</a>
                                                            <a href="<?php echo SITEURL; ?>admin/remove-vendor.php?id=<?php echo $id; ?>" class="delete">Remove</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                        }

                                    } else {
                                        echo "<tr><td colspan='11'><div style='text-align: center;'>There is no Requested Vendor Companies to Approve.</div></td></tr>";
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