<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Exsisting Raw Materials</h1>
                    <small>Find deails about the all exsisting raw materials</small>
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
                                    <div class="head">Total Amount</div>
                                </td>
                                <td>
                                    <div class="head">Total Price</div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_exist_raw";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $raw_name = $rows['raw_name'];
                                            $total_amount = $rows['total_amount'];
                                            $total_price = $rows['total_price'];

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
                                                        <div><?php echo $total_amount; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $total_price; ?></div>
                                                    </td>
                                                </tr>
                                                <?php
                                        } else {
                                            echo "<tr><td colspan='3'>There is no data in the table</td></tr>";
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