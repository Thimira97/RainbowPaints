<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Deliver Now</h1>
                    <small>Deliver the orders soon as possible.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['update-statues'])){
                            echo $_SESSION['update-statues'];
                            unset($_SESSION['update-statues']);
                        }
                    ?>
                    </div>
            </div>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    
                    $sql = "SELECT * FROM tbl_purchase WHERE id=$id";

                    $res = mysqli_query($conn,$sql);

                    if($res==TRUE){
                        $count = mysqli_num_rows($res);

                        if($count>0){
                            $sn=1;
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $raw_matirial_id = $rows['raw_matirial_id'];

                                $sql2 = "SELECT * FROM tbl_rawmatirial WHERE id=$raw_matirial_id";
                                $res2 = mysqli_query($conn,$sql2);
                                $count2 = mysqli_num_rows($res2);
                                if($count2>0){
                                    while($row2=mysqli_fetch_assoc($res2)){
                                        $raw_name = $row2['raw_name'];
                                    }
                                }

                                $amount = $rows['amount'];
                                $total_price = $rows['total_price'];
                                $date = $rows['date'];
                                $status = $rows['status'];
                            }}
                    } else {
                        $_SESSION['no-order-found']= "<div class='Failed-to-do'>Order Not Founded.</div>";
                        header('location:'.SITEURL.'vendor/add-statues.php');
                    }
                } else {
                    header('location:'.SITEURL.'vendor/add-statues.php');
                }
            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <label><?php echo $raw_name; ?></label>
                                <div class="underline-before"></div>
                            </div>
                            <div class="input-data">
                                <label><?php echo $amount; ?></label>
                                <div class="underline-before"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label><?php echo $total_price; ?></label>
                                <div class="underline-before"></div>
                            </div>
                            <div class="input-data">
                                <input  type="hidden">
                                <label></label>
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
                                    <option <?php if($status == "Ordered"){ echo "selected"; } ?> disabled value="Ordered">Ordered</option>
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

                            if($statues == "Delivered"){
                                $sql3 = "SELECT * FROM tbl_exist_raw WHERE raw_id=$raw_matirial_id";
                                $res3 = mysqli_query($conn,$sql3);
                                $count3 = mysqli_num_rows($res3);
                                if($count3>0){
                                    while($row3=mysqli_fetch_assoc($res3)){
                                        $exit_id = $row3['id'];
                                        $exit_total_amount = $row3['total_amount'];
                                        $exit_total_price = $row3['total_price'];

                                        $net_price = $total_price + $exit_total_price;
                                        $net_amount = $amount + $exit_total_amount;

                                        $sql4 = "UPDATE tbl_exist_raw SET
                                            total_amount='$net_amount',
                                            total_price='$net_price'
                                            WHERE id=$exit_id
                                        ";

                                        $res4 =mysqli_query($conn,$sql4);

                                        $sql = "UPDATE tbl_purchase SET
                                            date='$date',
                                            status='$statues'
                                            WHERE id=$id
                                        ";

                                        $res =mysqli_query($conn,$sql);

                                        if($res == true AND $res4 == true){
                                                $_SESSION['update-statues'] = "<div class='successfuly-done'>Add raw amount and Update Statues Successfully.</div>";
                                                header('location:'.SITEURL.'vendor/add-statues.php');
                                        } else {
                                                $_SESSION['update-statues'] = "<div class='Failed-to-do'>Failed to Update Statues or Add amount.</div>";
                                                header('location:'.SITEURL.'vendor/add-statues.php');
                                        }
                                    }
                                } else {

                                    $sql4 = "INSERT INTO tbl_exist_raw SET
                                        raw_id='$raw_matirial_id',
                                        raw_name='$raw_name',
                                        total_price='$total_price',
                                        total_amount='$amount'
                                    ";

                                    $res4 =mysqli_query($conn,$sql4);

                                    $sql = "UPDATE tbl_purchase SET
                                        date='$date',
                                        status='$statues'
                                        WHERE id=$id
                                    ";

                                    $res =mysqli_query($conn,$sql);

                                    if($res == true AND $res4 == true){
                                            $_SESSION['update-statues'] = "<div class='successfuly-done'>Add raw amount and Update Statues Successfully.</div>";
                                            header('location:'.SITEURL.'vendor/add-statues.php');
                                    } else {
                                            $_SESSION['update-statues'] = "<div class='Failed-to-do'>Failed to Update Statues or Add amount.</div>";
                                            header('location:'.SITEURL.'vendor/add-statues.php');
                                    }
                                }

                            } else {

                                $sql = "UPDATE tbl_purchase SET
                                    date='$date',
                                    status='$statues'
                                    WHERE id=$id
                                ";

                                $res =mysqli_query($conn,$sql);

                                if($res == true){
                                        $_SESSION['update-statues'] = "<div class='successfuly-done'>Update Statues Successfully.</div>";
                                        header('location:'.SITEURL.'vendor/add-statues.php');
                                } else {
                                        $_SESSION['update-statues'] = "<div class='Failed-to-do'>Failed to Update Statues.</div>";
                                        header('location:'.SITEURL.'vendor/add-statues.php');
                                }
                            }
                        }
                    
                    ?>
                </div>
            </div>
        </main>
    </div>
<?php include('partials/footer.php'); ?>