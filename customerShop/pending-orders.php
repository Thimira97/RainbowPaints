<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Orders</h1>
                    <small>Find deails about new orders details.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['add-order'])){ 
                            echo $_SESSION['add-order']; 
                            unset($_SESSION['add-order']);
                        }

                        if(isset($_SESSION['order-delete'])){ 
                            echo $_SESSION['order-delete']; 
                            unset($_SESSION['order-delete']);
                        }

                        if(isset($_SESSION['update-order'])){ 
                            echo $_SESSION['update-order']; 
                            unset($_SESSION['update-order']);
                        }

                        if(isset($_SESSION['no-order-found'])){ 
                            echo $_SESSION['no-order-found']; 
                            unset($_SESSION['no-order-found']);
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
                                    <div class="head">Paint Name</div>
                                </td>
                                <td>
                                    <div class="head">Paint Price</div>
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
                                $customer = $_SESSION['id'];
                                $sql = "SELECT * FROM tbl_order WHERE status!='Delivered' AND customer_id=$customer ";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $order_id = $rows['id'];

                                            $paint_id = $rows['paint_id'];

                                            $sql3 = "SELECT * FROM tbl_paint WHERE id=$paint_id";
                                            $res3 = mysqli_query($conn,$sql3);
                                            $count3 = mysqli_num_rows($res3);
                                            if($count3>0){
                                                while($row3=mysqli_fetch_assoc($res3)){
                                                    $paint_name = $row3['paint_name'];
                                                    $paint_price = $row3['price'];
                                                }
                                            }

                                            $amount = $rows['amount'];
                                            $total_price = $rows['total_price'];
                                            $date = $rows['date'];
                                            $status = $rows['status'];

                                            if($status=="Cancelled"){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $paint_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $paint_price; ?></div>
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
                                                            <a href="<?php echo SITEURL; ?>customerShop/delete-order.php?id=<?php echo $order_id; ?>" class="delete">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                        } elseif($status=="On Delivered") {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $paint_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $paint_price; ?></div>
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
                                                            <a href="<?php echo SITEURL; ?>customerShop/delete-order.php?id=<?php echo $order_id; ?>" class="delete">Delete</a>
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
                                                        <div><?php echo $paint_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $paint_price; ?></div>
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
                                                            <a href="<?php echo SITEURL; ?>customerShop/update-order.php?id=<?php echo $order_id; ?>" class="update">Update</a>
                                                            <a href="<?php echo SITEURL; ?>customerShop/delete-order.php?id=<?php echo $order_id; ?>" class="delete">Delete</a>
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