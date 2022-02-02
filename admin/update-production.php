<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Add Productions</h1>
                    <small>Fill the new details about the new production.</small>
                    </div>
            </div>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_production WHERE id=$id";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $paint_id = $row['paint_id'];
                        $producted_amount = $row['producted_amount'];
                        $date = $row['date'];

                        $sql1 = "SELECT * FROM tbl_paint WHERE id=$paint_id";
                        $res1 = mysqli_query($conn,$sql1);
                        $count1 = mysqli_num_rows($res1);
                        if($count1>0){
                            while($row1=mysqli_fetch_assoc($res1)){
                                $paint_name = $row1['paint_name'];
                            }
                        }

                    } else {
                        $_SESSION['no-production-found']= "<div class='Failed-to-do'>Production Not Founded.</div>";
                        header('location:'.SITEURL.'admin/view-production.php');
                    }
                } else {
                    header('location:'.SITEURL.'admin/view-production.php');
                }
            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <label><?php echo $paint_name; ?></label>
                                <input type="hidden" name="paint_id" value="<?php echo $paint_id; ?>">
                                <div class="underline-before"></div>
                            </div>
                            <div class="input-data">
                                <input type="number" name="producted_amount" required>
                                <div class="underline"></div>
                                <label>Producted Amount</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input  class="input" type="date" name="date" required>
                                <div class="underline"></div>
                                <div class="underline-before"></div>
                                <label>Production Date</label>
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
                            $paint_id = $_POST['paint_id'];
                            $producted_amount = $_POST['producted_amount'];
                            $date = $_POST['date'];

                            $sql3 = "SELECT * FROM tbl_paint WHERE id=$paint_id";
                            $res3 = mysqli_query($conn,$sql3);
                            $count3 = mysqli_num_rows($res3);
                            if($count3>0){
                                while($row3=mysqli_fetch_assoc($res3)){
                                    $paint_price = $row3['price'];
                                }
                            }

                            $total_price = $paint_price*$producted_amount;

                            $sql4 = "SELECT * FROM tbl_production WHERE id=$id";
                            $res4 = mysqli_query($conn,$sql4);
                            $count4 = mysqli_num_rows($res4);
                            if($count4>0){
                                while($row4=mysqli_fetch_assoc($res4)){
                                    $amount = $row4['producted_amount'];
                                    $price = $row4['total_price'];

                                    $net_price = $price + $total_price;
                                    $net_amount = $producted_amount + $amount; 
                                    
                                    $sql = "UPDATE tbl_production SET
                                        producted_amount = '$net_amount',
                                        total_price = '$net_price',
                                        date='$date'
                                        WHERE id=$id
                                    ";

                                    $res =mysqli_query($conn,$sql);

                                    if($res == true){
                                            $_SESSION['update-production'] = "<div class='successfuly-done'>Update Paint Production Successfully.</div>";
                                            header('location:'.SITEURL.'admin/view-production.php');
                                    } else {
                                            $_SESSION['update-production'] = "<div class='Failed-to-do'>Failed to Update Paint Production.</div>";
                                            header('location:'.SITEURL.'admin/view-production.php');
                                    }
                                }
                            }
                        }
                    
                    ?>
            </div>
        </div>
    </main>
</div>
<?php include('partials/footer.php'); ?>