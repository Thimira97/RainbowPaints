<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Deliver</h1>
                    <small>Find deails about the all orders.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['update-statues'])){ 
                            echo $_SESSION['update-statues']; 
                            unset($_SESSION['update-statues']); 
                        }

                        if(isset($_SESSION['no-order-found'])){ 
                            echo $_SESSION['no-order-found']; 
                            unset($_SESSION['no-order-found']); 
                        }

                        if(isset($_SESSION['cancell'])){ 
                            echo $_SESSION['cancell']; 
                            unset($_SESSION['cancell']); 
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
                                if(isset($_SESSION['id'])){
                                    $user_id = $_SESSION['id'];
                                }

                                $sql = "SELECT * FROM tbl_purchase WHERE status!='Delivered' AND status!='Cancelled' AND vendor_id=$user_id ";

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

                                            if($status=="Ordered"){
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
                                                        <a href="<?php echo SITEURL; ?>vendor/update-statues.php?id=<?php echo $id; ?>" class="update">Deliver</a>
                                                        <a href="<?php echo SITEURL; ?>vendor/delete-statues.php?id=<?php echo $id; ?>" class="delete">Cancell</a>
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
                                                        <a href="<?php echo SITEURL; ?>vendor/update-statues.php?id=<?php echo $id; ?>" class="update">Deliver</a>
                                                        <a href="<?php echo SITEURL; ?>vendor/delete-statues.php?id=<?php echo $id; ?>" class="delete">Cancell</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                }  else {
                                    echo "<tr><td colspan='7'><div class='noItems text-center'>There is no Orders to Deliver.</div></td></tr>";
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