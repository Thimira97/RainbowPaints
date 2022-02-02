<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Add a New Purchase</h1>
                    <small>Purchse the raw materials.</small>
                    <?php 
                        
                        if(isset($_SESSION['purchase-add'])){
                            echo $_SESSION['purchase-add'];
                            unset($_SESSION['purchase-add']);
                        }

                    ?>
                     </div>
            </div>

            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <!-- <label>Raw Matirial</label> -->
                                <select class="select" name="raw_matirial_id">
                                <?php 
                                    $sql2 = "SELECT * FROM tbl_rawmatirial ";
                                    $res2= mysqli_query($conn,$sql2);
                                    $count2 = mysqli_num_rows($res2);
                                    if($count2>0){
                                        while($row2=mysqli_fetch_assoc($res2)){
                                            $raw_id = $row2['id'];
                                            $raw_name = $row2['raw_name'];
                                            $vendor = $row2['vendor_id'];

                                            $sql3 = "SELECT * FROM tbl_vendor WHERE id=$vendor ";
                                            $res3= mysqli_query($conn,$sql3);
                                            $count3 = mysqli_num_rows($res3);
                                            if($count3>0){
                                                while($row3=mysqli_fetch_assoc($res3)){
                                                    $companyName = $row3['c_name'];
                                                }
                                            }

                                            ?>
                                                <option value="<?php echo $raw_id; ?>"><?php echo $raw_name; ?> - <?php echo $companyName; ?></option>
                                            <?php
                                    }
                                } else {
                                    ?>
                                        <option value="0">No Raw Matital Found</option>
                                    <?php
                                }
                                ?>
                                </select>
                                <div class="underline-before"></div>
                            </div>
                            <div class="input-data">
                                <input type="number" name="amount" required>
                                <div class="underline"></div>
                                <label>Amount Of Matirial</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input class="input" type="date" name="date" required>
                                <div class="underline"></div>
                                <div class="underline-before"></div>
                                <label>Date</label>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="hidden" name="status" value="Ordered">
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $raw_matirial_id = $_POST['raw_matirial_id'];
                            $amount = $_POST['amount'];
                            $date = $_POST['date'];
                            $status = $_POST['status'];

                            $sql4 = "SELECT * FROM tbl_rawmatirial WHERE id=$raw_matirial_id";
                            $res4 = mysqli_query($conn,$sql4);
                            $count4= mysqli_num_rows($res4);
                            if($count4>0){
                                while($row4=mysqli_fetch_assoc($res4)){
                                    $raw_price = $row4['raw_price'];
                                    $vendor = $row4['vendor_id'];
                                }
                            }

                            $total_price = $raw_price*$amount;

                            $sql = "INSERT INTO tbl_purchase SET 
                                raw_matirial_id='$raw_matirial_id',
                                amount='$amount',
                                total_price='$total_price',
                                date='$date',
                                status='$status',
                                vendor_id='$vendor'
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['purchase-add'] = "<div class='successfuly-done'>Purchase Added Successfully.</div>";
                                header('location:'.SITEURL.'admin/view-raw-purchase.php');
                            } else {
                                $_SESSION['purchase-add'] = "<div class='Failed-to-do'>Failed to Add Purchase.</div>";
                                header('location:'.SITEURL.'admin/add-raw-purchase.php');
                            }

                        }
                    ?>
                    </div>
                </div>
            </main>
        </div>
<?php include('partials/footer.php'); ?>