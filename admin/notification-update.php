<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Change Notification</h1>
                    <small>Change notification and add new details.</small>
                </div>
            </div>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_no WHERE id=$id";

                    $res= mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $creator = $row['creator'];
                        $title = $row['title'];
                        $message = $row['message'];
                        $to_table = $row['to_table'];
                    }
                }
            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="creator" value="<?php echo $creator ; ?>" required>
                                <div class="underline"></div>
                                <label>Creator</label>
                            </div>
                            <div class="input-data">
                                <select name="to_table" class="select">
                                    <option <?php if($to_table=="tbl_all"){ echo 'selected'; }?> value="all">To All</option>
                                    <option <?php if($to_table=="tbl_customershop"){ echo 'selected'; }?> value="tbl_customershop">To Customer Shop</option>
                                    <option <?php if($to_table=="tbl_vendor"){ echo 'selected'; }?> value="tbl_vendor">To Vendor Company</option>
                                    <option <?php if($to_table=="tbl_employee"){ echo 'selected'; }?> value="tbl_employee">To Employee</option>
                                </select>
                                <div class="underline-before"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="title" value="<?php echo $title ; ?>" maxlength="40" required>
                                <div class="underline"></div>
                                <label>Title</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data textarea">
                                <textarea cols="30" rows="10" name="message" required><?php echo $message ; ?></textarea>
                                <div class="underline"></div>
                                <label>Write your message</label>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="hidden" name="creator_id" value="<?php echo $id; ?>">
							    <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
							    <input type="hidden" name="table_name" value="tbl_admin">
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $id = $_POST['creator_id'];
                            $creator = $_POST['creator'];
                            $title = $_POST['title'];
                            $message = $_POST['message'];
                            $to_table = $_POST['to_table'];
                            $date = $_POST['date'];
                            $table_name = $_POST['table_name'];

                            $sql = "UPDATE tbl_no SET
                                creator='$creator',
                                title='$title',
                                message='$message',
                                date='$date',
                                table_name='$table_name',
                                to_table='$to_table'
                                WHERE id=$id
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['noticeUpdate'] = "<div class='successfuly-done'>Notice Update Successfully.</div>";
                                header("location:".SITEURL.'admin/notification-all.php');
                            } else {
                                $_SESSION['noticeUpdate'] = "<div class='Failed-to-do'>Failed to Update Notice.</div>";
                                header("location:".SITEURL.'admin/notification-all.php');
                            }
                        }
                    ?>
                </div>
            </div>
        </main>
    </div>
<?php include('partials/footer.php'); ?>