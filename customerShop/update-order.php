<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Update the Order</h1>
                    <small>Fill the new details about the order.</small>
                    <br>
                    <?php 
                    
                        if(isset($_SESSION['add-order'])){
                            echo $_SESSION['add-order']; 
                            unset($_SESSION['add-order']);
                        }

                    ?>
                    </div>
            </div>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_order WHERE id=$id";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $Current_paint_id = $row['paint_id'];
                        $amount = $row['amount'];
                        $date = $row['date'];
                    } else {
                        $_SESSION['no-order-found']= "<div class='Failed-to-do'>Order Not Founded.</div>";
                        header('location:'.SITEURL.'customerShop/pending-orders.php');
                    }
                } else {
                    header('location:'.SITEURL.'customerShop/pending-orders.php');
                }
            
            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                            <select class="select" name="paint_id">
                                <?php 
                                    $sql2 = "SELECT * FROM tbl_paint";
                                    $res2= mysqli_query($conn,$sql2);
                                    $count2 = mysqli_num_rows($res2);
                                    if($count2>0){
                                        while($row2=mysqli_fetch_assoc($res2)){
                                            $paint_id = $row2['id'];
                                            $paint_name = $row2['paint_name'];
                                            ?>
                                                <option <?php if($Current_paint_id==$paint_id){ echo "selected" ;} ?> value="<?php echo $paint_id; ?>"><?php echo $paint_name; ?></option>
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
                                <input type="number" name="amount" value="<?php echo $amount; ?>" required>
                                <div class="underline"></div>
                                <label>Amount Of Paint</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input  class="input" type="date" name="date" value="<?php echo $date; ?>" required>
                                <div class="underline"></div>
                                <div class="underline-before"></div>
                                <label>Ordered Date</label>
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
                            $paint_id = $_POST['paint_id'];
                            $amount = $_POST['amount'];
                            $date = $_POST['date'];
                            $id = $_POST['id'];

                            $sql4 = "SELECT * FROM tbl_paint WHERE id=$paint_id";
                            $res4 = mysqli_query($conn,$sql4);
                            $count4= mysqli_num_rows($res4);
                            if($count4>0){
                                while($row4=mysqli_fetch_assoc($res4)){
                                    $paint_price = $row4['price'];
                                }
                            }

                            $total_price = $paint_price*$amount;

                            $sql = "UPDATE tbl_order SET 
                                paint_id='$paint_id',
                                amount='$amount',
                                total_price='$total_price',
                                date='$date'
                                WHERE id=$id
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['update-order'] = "<div class='successfuly-done'>Order Updated Successfully.</div>";
                                header('location:'.SITEURL.'customerShop/pending-orders.php');
                            } else {
                                $_SESSION['update-order'] = "<div class='Failed-to-do'>Failed to Update Order.</div>";
                                header('location:'.SITEURL.'customerShop/pending-orders.php');
                            }

                        }
                    ?>
                </div>
        </div>
    </main>
</div>
<?php include('partials/footer.php'); ?>