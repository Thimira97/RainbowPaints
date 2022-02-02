<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Raw Materials Purchasings.</h1>
                    <small>Find deails about the all raw materials purchasings.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['purchase-add'])){ 
                            echo $_SESSION['purchase-add']; 
                            unset($_SESSION['purchase-add']); 
                        }

                        if(isset($_SESSION['purchase-delete'])){ 
                            echo $_SESSION['purchase-delete']; 
                            unset($_SESSION['purchase-delete']); 
                        }

                        if(isset($_SESSION['purchase-update'])){ 
                            echo $_SESSION['purchase-update']; 
                            unset($_SESSION['purchase-update']); 
                        }

                        if(isset($_SESSION['no-purchase-found'])){ 
                            echo $_SESSION['no-purchase-found']; 
                            unset($_SESSION['no-purchase-found']); 
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
                                    <div class="head">Raw Material Name</div>
                                </td>
                                <td>
                                    <div class="head">Company</div>
                                </td>
                                <td>
                                    <div class="head">Amount</div>
                                </td>
                                <td>
                                    <div class="head">Total Price</div>
                                </td>
                                <td>
                                    <div class="head">Date</div>
                                </td>
                                <td>
                                    <div class="head">Status</div>
                                </td>
                                <td>
                                    <div class="head">Actions</div>
                                </td>
                            </tr>

                        <?php 
                            $sql = "SELECT * FROM tbl_purchase WHERE status!='Delivered'";

                            $res = mysqli_query($conn,$sql);

                            if($res==TRUE){
                                $count = mysqli_num_rows($res);

                                if($count>0){
                                    $sn=1;
                                    while($rows = mysqli_fetch_assoc($res)){
                                        $id = $rows['id'];
                                        $raw_matirial_id = $rows['raw_matirial_id'];
                                        $amount = $rows['amount'];
                                        $total_price = $rows['total_price'];
                                        $date = $rows['date'];
                                        $status = $rows['status'];

                                        $sql2 = "SELECT * FROM tbl_rawmatirial WHERE id=$raw_matirial_id";
                                        $res2 = mysqli_query($conn,$sql2);
                                        $count2 = mysqli_num_rows($res2);
                                        if($count2>0){
                                            while($row2=mysqli_fetch_assoc($res2)){
                                                $raw_name = $row2['raw_name'];
                                                $vendor_id = $row2['vendor_id'];
                                            }
                                        }

                                        $sql3 = "SELECT * FROM tbl_vendor WHERE id=$vendor_id";
                                        $res3 = mysqli_query($conn,$sql3);
                                        $count3 = mysqli_num_rows($res3);
                                        if($count3>0){
                                            while($row3=mysqli_fetch_assoc($res3)){
                                                $c_name = $row3['c_name'];
                                            }
                                        }

                                        if($status=="Cancelled"){
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $raw_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $c_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $amount; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $total_price; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $date; ?></div>
                                                    </td>
                                                    <td>
                                                        <div style="color: red; "><?php echo $status; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-raw-purchase.php?id=<?php echo $id; ?>" class="delete">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                        } elseif($status=="On Delivered"){
                                            ?>
                                
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $raw_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $c_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $amount; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $total_price; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $date; ?></div>
                                                    </td>
                                                    <td>
                                                        <div style="color: #FFBF00; "><?php echo $status; ?></div>
                                                    </td>
                                                    <td>
                                                       <div>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-raw-purchase.php?id=<?php echo $id; ?>" class="delete">Delete</a>
                                                       </div>
                                                    </td>
                                                </tr>
                                    
                                            <?php
                                        } else {
                                            ?>
                                
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $raw_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $c_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $amount; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $total_price; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $date; ?></div>
                                                    </td>
                                                    <td>
                                                        <div style="color: green; "><?php echo $status; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/update-raw-purchase.php?id=<?php echo $id; ?>" class="update">Update</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-raw-purchase.php?id=<?php echo $id; ?>" class="delete">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                        
                                                <?php
                                                    }
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