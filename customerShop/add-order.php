<?php 
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
?>
<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Add a Order</h1>
                    <small>Fill the details about order.</small>
                    <?php 
                        
                        if(isset($_SESSION['add-order'])){ 
                            echo $_SESSION['add-order'];
                            unset($_SESSION['add-order']);
                        }

                    ?>
                    </div>
            </div>

            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                            <select class="select" name="paint_id">
                                <?php 
                                    $sql2 = "SELECT * FROM tbl_paint ";
                                    $res2= mysqli_query($conn,$sql2);
                                    $count2 = mysqli_num_rows($res2);
                                    if($count2>0){
                                        while($row2=mysqli_fetch_assoc($res2)){
                                            $paint_id = $row2['id'];
                                            $paint_name = $row2['paint_name'];
                                            ?>
                                                <option value="<?php echo $paint_id; ?>"><?php echo $paint_name; ?></option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                                <option value="0">No Paint Found</option>
                                            <?php
                                        }
                                    ?>
                            </select>
                            <div class="underline-before"></div>
                            </div>
                            <div class="input-data">
                                <input type="number" name="amount" required>
                                <div class="underline"></div>
                                <label>Amount Of Paint</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input  class="input" type="date" name="date" required>
                                <div class="underline"></div>
                                <div class="underline-before"></div>
                                <label>Date</label>
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
                                <input type="hidden" name="customer" value="<?php echo $id; ?>">
                                <input type="hidden" name="statues" Value="Ordered">
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $paint_id = $_POST['paint_id'];
                            $amount = $_POST['amount'];
                            $date = $_POST['date'];
                            $customer = $_POST['customer'];
                            $statues = $_POST['statues'];

                            $sql4 = "SELECT * FROM tbl_paint WHERE id=$paint_id";
                            $res4 = mysqli_query($conn,$sql4);
                            $count4= mysqli_num_rows($res4);
                            if($count4>0){
                                while($row4=mysqli_fetch_assoc($res4)){
                                    $paint_price = $row4['price'];
                                }
                            }

                            $total_price = $paint_price*$amount;

                            $sql = "INSERT INTO tbl_order SET 
                                customer_id = '$customer',
                                paint_id='$paint_id',
                                amount='$amount',
                                total_price='$total_price',
                                date='$date',
                                status ='$statues'
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['add-order'] = "<div class='successfuly-done'>Order Added Successfully.</div>";
                                header('location:'.SITEURL.'customerShop/pending-orders.php');
                            } else {
                                $_SESSION['add-order'] = "<div class='Failed-to-do'>Failed to Add Order.</div>";
                                header('location:'.SITEURL.'customerShop/add-order.php');
                            }

                        }
                    ?>
            </div>
        </div>
    </main>
</div>
<?php include('partials/footer.php'); ?>