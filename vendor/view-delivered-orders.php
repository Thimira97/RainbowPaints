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
                            </tr>
                            <?php 
                                if(isset($_SESSION['id'])){
                                    $user_id = $_SESSION['id'];
                                }

                                $sql = "SELECT * FROM tbl_purchase WHERE status='Delivered' AND vendor_id=$user_id";

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

                                            $sql2 = "SELECT * FROM tbl_rawmatirial WHERE id=$raw_matirial_id";
                                            $res2 = mysqli_query($conn,$sql2);
                                            $count2 = mysqli_num_rows($res2);
                                            if($count2>0){
                                                while($row2=mysqli_fetch_assoc($res2)){
                                                    $raw_name = $row2['raw_name'];
                                                }
                                            }

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
                                            </tr>
                                            <?php
                                        }
                                    }  else {
                                        echo "<tr><td colspan='5'><div class='noItems text-center'>There is no Delivered Orders.</div></td></tr>";
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