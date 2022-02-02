<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Delivered Orders.</h1>
                    <small>Find deails about the all delivered orders.</small>
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
                                    <div class="head">Customer Shop Name</div>
                                </td>
                                <td>
                                    <div class="head">Address</div>
                                </td>
                                <td>
                                    <div class="head">Paint Name</div>
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
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_order WHERE status='Delivered'";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $customer_id = $rows['customer_id'];

                                            $sql2 = "SELECT * FROM tbl_customershop WHERE id=$customer_id";
                                            $res2 = mysqli_query($conn,$sql2);
                                            $count2 = mysqli_num_rows($res2);
                                            if($count2>0){
                                                while($row2=mysqli_fetch_assoc($res2)){
                                                    $s_name = $row2['s_name'];
                                                    $address = $row2['address'];
                                                }
                                            }

                                            $paint_id = $rows['paint_id'];

                                            $sql3 = "SELECT * FROM tbl_paint WHERE id=$paint_id";
                                            $res3 = mysqli_query($conn,$sql3);
                                            $count3 = mysqli_num_rows($res3);
                                            if($count3>0){
                                                while($row3=mysqli_fetch_assoc($res3)){
                                                    $paint_name = $row3['paint_name'];
                                                }
                                            }

                                            $amount = $rows['amount'];
                                            $total_price = $rows['total_price'];
                                            $date = $rows['date'];
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
                                                    <div><?php echo $address; ?></div>
                                                </td>
                                                <td>
                                                    <div><?php echo $paint_name; ?></div>
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