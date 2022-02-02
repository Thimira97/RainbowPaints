<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Add a Production</h1>
                    <small>Fill the details about the production.</small>
                </div>
            </div>

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
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
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

                            $sql4 = "SELECT * FROM tbl_production WHERE paint_id=$paint_id";
                            $res4 = mysqli_query($conn,$sql4);
                            $count4 = mysqli_num_rows($res4);
                            if($count4>0){
                                while($row4=mysqli_fetch_assoc($res4)){
                                    $exist_id = $row4['id'];
                                    $exist_producted_amount = $row4['producted_amount'];
                                    $exist_total_price = $row4['total_price'];

                                    $new_total_price = $exist_total_price + $total_price;
                                    $new_producted_amount = $exist_producted_amount + $producted_amount;
                                    
                                    $sql5 = "UPDATE tbl_production SET
                                            producted_amount = '$new_producted_amount',
                                            total_price = '$new_total_price',
                                            date='$date'
                                            WHERE id=$exist_id
                                        ";
                                    $res5 =mysqli_query($conn,$sql5);

                                    if($res5 == true){
                                            $_SESSION['add-production'] = "<div class='successfuly-done'>Add Paint Production Successfully.</div>";
                                            header('location:'.SITEURL.'admin/view-production.php');
                                    } else {
                                            $_SESSION['add-production'] = "<div class='Failed-to-do'>Failed to Add Paint Production.</div>";
                                            header('location:'.SITEURL.'admin/view-production.php');
                                    }
                                }  
                            } else {
                                $sql = "INSERT INTO tbl_production SET
                                        paint_id='$paint_id',
                                        producted_amount = '$producted_amount',
                                        total_price = '$total_price',
                                        date='$date'
                                    ";
                                $res =mysqli_query($conn,$sql);

                                if($res == true){
                                        $_SESSION['add-production'] = "<div class='successfuly-done'>Add Paint Production Successfully.</div>";
                                        header('location:'.SITEURL.'admin/view-production.php');
                                } else {
                                        $_SESSION['add-production'] = "<div class='Failed-to-do'>Failed to Add Paint Production.</div>";
                                        header('location:'.SITEURL.'admin/view-production.php');
                                }
                            }  
                        }
                    
                    ?>
            </div>
        </div>
    </main>
</div>
<?php include('partials/footer.php'); ?>