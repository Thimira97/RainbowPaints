<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Change the Status</h1>
                    <small>Deliver the orders.</small>
                    <?php 
                        if(isset($_SESSION['update-statues'])){
                            echo $_SESSION['update-statues'];
                            unset($_SESSION['update-statues']);
                        }

                        if(isset($_SESSION['sub-production'])){
                            echo $_SESSION['sub-production'];
                            unset($_SESSION['sub-production']);
                        }
                    ?>
                    </div>
            </div>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    
                    $sql = "SELECT * FROM tbl_order WHERE id=$id";

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
                            }}
                    } else {
                        $_SESSION['no-order-found']= "<div class='Failed-to-do'>Order Not Founded.</div>";
                        header('location:'.SITEURL.'admin/add-statues.php');
                    }
                } else {
                    header('location:'.SITEURL.'admin/add-statues.php');
                }
            
            ?>

            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <label><?php echo $s_name; ?></label>
                                <div class="underline-before"></div>
                            </div>
                            <div class="input-data">
                                <label><?php echo $paint_name; ?></label>
                                <div class="underline-before"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input  class="input" type="date" name="date" value="<?php echo $date; ?>" required>
                                <div class="underline"></div>
                                <div class="underline-before"></div>
                                <label>Date</label>
                            </div>
                            <div class="input-data">
                                <select name="statues">
                                    <option <?php if($status == "Ordered"){ echo "selected"; } ?> value="Ordered">Ordered</option>
                                    <option <?php if($status == "Delivered"){ echo "selected"; } ?> value="Delivered">Delivered</option>
                                    <option <?php if($status == "On Delivered"){ echo "selected"; } ?> value="On Delivered">On Delivered</option>
                                </select>
                                <div class="underline-before"></div>
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
                            $date = $_POST['date'];
                            $statues = $_POST['statues'];

                            $sql6 = "SELECT * FROM tbl_order WHERE id=$id";
                            $res6 = mysqli_query($conn,$sql6);
                            $count6 = mysqli_num_rows($res6);
                            if($count6>0){
                                while($row6=mysqli_fetch_assoc($res6)){
                                    $paint_id = $row6['paint_id'];
                                    $amount = $row6['amount'];
                                    $price = $row6['total_price'];
                                }
                            }

                            if($statues == "Delivered"){
                                $sql4 = "SELECT * FROM tbl_production WHERE paint_id=$paint_id";
                                $res4 = mysqli_query($conn,$sql4);
                                $count4 = mysqli_num_rows($res4);
                                if($count4>0){
                                    while($row4=mysqli_fetch_assoc($res4)){
                                        $exist_id = $row4['id'];
                                        $exist_producted_amount = $row4['producted_amount'];
                                        $exist_total_price = $row4['total_price'];

                                        if($exist_producted_amount>=$amount){
                                            $new_total_price = $exist_total_price - $price;
                                            $new_producted_amount = $exist_producted_amount - $amount;
                                            
                                            $sql5 = "UPDATE tbl_production SET
                                                    producted_amount = '$new_producted_amount',
                                                    total_price = '$new_total_price',
                                                    date='$date'
                                                    WHERE id=$exist_id
                                                ";
                                            $res5 =mysqli_query($conn,$sql5);

                                            $sql = "UPDATE tbl_order SET
                                                date='$date',
                                                status='$statues'
                                                WHERE id=$id
                                            ";

                                            $res =mysqli_query($conn,$sql);

                                            if($res5 == true AND $res == true){
                                                    $_SESSION['sub-production'] = "<div class='successfuly-done'>Status Update and Reduce Paint Production Successfully.</div>";
                                                    header('location:'.SITEURL.'admin/add-statues.php');
                                            } else {
                                                    $_SESSION['sub-production'] = "<div class='Failed-to-do'>Failed Update Status and Reduce Paint Production.</div>";
                                                    header('location:'.SITEURL.'admin/add-statues.php');
                                            }
                                        } else {

                                            $_SESSION['sub-production'] = "<div class='Failed-to-do'>Not Enough Production to Deliver and Fail to Update Status.</div>";
                                            header('location:'.SITEURL.'admin/add-statues.php');
                                           
                                        }
                                    }  
                                } else {
                                    $_SESSION['sub-production'] = "<div class='Failed-to-do'>No Production in the Stores.</div>";
                                    header('location:'.SITEURL.'admin/add-statues.php');
                                }

                            } else {

                                $sql = "UPDATE tbl_order SET
                                    date='$date',
                                    status='$statues'
                                    WHERE id=$id
                                ";

                                $res =mysqli_query($conn,$sql);

                                if($res == true){
                                    $_SESSION['update-statues'] = "<div class='successfuly-done'>Update Statues Successfully.</div>";
                                    header('location:'.SITEURL.'admin/add-statues.php');
                                } else {
                                    $_SESSION['update-statues'] = "<div class='Failed-to-do'>Failed to Update Statues.</div>";
                                    header('location:'.SITEURL.'admin/add-statues.php');
                                }
                            }
                        }
                    
                    ?>
            </div>
        </div>
    </main>
</div>
<?php include('partials/footer.php'); ?>