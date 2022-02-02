<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Update the Purchase</h1>
                    <small>Fill the new details about the purchasing.</small>
                    <?php 
                        
                        if(isset($_SESSION['purchase-update'])){
                            echo $_SESSION['purchase-update'];
                            unset($_SESSION['purchase-update']);
                        }

                    ?>
                    </div>
            </div>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_purchase WHERE id=$id";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $raw_matirial_id = $row['raw_matirial_id'];
                        $amount = $row['amount'];
                        $date = $row['date'];
                    } else {
                        $_SESSION['no-purchase-found']= "<div class='Failed-to-do'>Purchase Not Founded.</div>";
                        header('location:'.SITEURL.'admin/view-raw-purchase.php');
                    }
                } else {
                    header('location:'.SITEURL.'admin/view-raw-purchase.php');
                }
            
            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
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
                                                    <option <?php if($raw_matirial_id==$raw_id){ echo "selected" ;} ?> value="<?php echo $raw_id; ?>"><?php echo $raw_name; ?> - <?php echo $companyName; ?></option>
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
                                <input type="number" name="amount" value="<?php echo $amount; ?>" required>
                                <div class="underline"></div>
                                <label>Amount Of Matirial</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input  class="input" type="date" name="date" value="<?php echo $date; ?>" required>
                                <div class="underline"></div>
                                <div class="underline-before"></div>
                                <label>Purchase Date</label>
                            </div>
                            <div class="input-data">
                                <input type="hidden">
                                <div class="underline"></div>
                                <label></label>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">  
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $id = $_POST['id'];
                            $raw_matirial_id = $_POST['raw_matirial_id'];
                            $amount = $_POST['amount'];
                            $date = $_POST['date'];

                            $sql4 = "SELECT * FROM tbl_rawmatirial WHERE id=$raw_matirial_id";
                            $res4 = mysqli_query($conn,$sql4);
                            $count4= mysqli_num_rows($res4);
                            if($count4>0){
                                while($row4=mysqli_fetch_assoc($res4)){
                                    $raw_price = $row4['raw_price'];
                                }
                            }

                            $total_price = $raw_price*$amount;

                            $sql = "UPDATE tbl_purchase SET 
                                raw_matirial_id='$raw_matirial_id',
                                amount='$amount',
                                total_price='$total_price',
                                date='$date'
                                WHERE id=$id
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['purchase-update'] = "<div class='successfuly-done'>Purchase Update Successfully.</div>";
                                header('location:'.SITEURL.'admin/view-raw-purchase.php');
                            } else {
                                $_SESSION['purchase-update'] = "<div class='Failed-to-do'>Failed to Update Purchase.</div>";
                                header('location:'.SITEURL.'admin/update-raw-purchase.php');
                            }

                        }
                    ?>
            </div>
        </div>
    </main>
</div>
<?php include('partials/footer.php'); ?>