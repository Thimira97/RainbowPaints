<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Delivered Orders</h1>
                    <small>Find deails about the all delivered orders.</small>
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
                            </tr>
                            <?php 
                                $customer = $_SESSION['id'];
                                $sql = "SELECT * FROM tbl_order WHERE status='Delivered' AND customer_id=$customer ";

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
                                                </tr>
                                            <?php
                                        }

                                    } else {
                                        echo "<tr><td colspan='9'><div class='noItems text-center'>There is no Orders to Deliver.</div></td></tr>";
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