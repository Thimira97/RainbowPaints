<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Deliver</h1>
                    <small>Deliver the orders now.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['update-statues'])){
                            echo $_SESSION['update-statues'];
                            unset($_SESSION['update-statues']);
                        }

                        if(isset($_SESSION['sub-production'])){
                            echo $_SESSION['sub-production'];
                            unset($_SESSION['sub-production']);
                        }

                        if(isset($_SESSION['no-order-found'])){
                            echo $_SESSION['no-order-found'];
                            unset($_SESSION['no-order-found']);
                        }

                        if(isset($_SESSION['cancell'])){
                            echo $_SESSION['cancell'];
                            unset($_SESSION['cancell']);
                        }

                        if(isset($_SESSION['enough-production'])){
                            echo $_SESSION['enough-production'];
                            unset($_SESSION['enough-production']);
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
                                <td>
                                    <div class="head">Status</div>
                                </td>
                                <td>
                                    <div class="head">Actions</div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_order WHERE status!='Delivered' AND status!='Cancelled'";

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
                                            $status = $rows['status'];

                                            if($status == "On Delivered"){
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
                                                    <td>
                                                        <div style="color: green; "><?php echo $status; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/update-statues.php?id=<?php echo $id; ?>" class="update">Change Status</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-statues.php?id=<?php echo $id; ?>" class="delete">Cancell</a>
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
                                                    <td>
                                                        <div style="color: #FFBF00; "><?php echo $status; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/update-statues.php?id=<?php echo $id; ?>" class="update">Change Status</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-statues.php?id=<?php echo $id; ?>" class="delete">Cancell</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
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