<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Create a New Notification</h1>
                    <small>Create new notification for all.</small>
                    <?php 

                        if(isset($_SESSION['noticeAdd'])){
                            echo $_SESSION['noticeAdd'];
                            unset($_SESSION['noticeAdd']);
                        }

                    ?>
                </div>
            </div>

            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="creator" required>
                                <div class="underline"></div>
                                <label>Creator</label>
                            </div>
                            <div class="input-data">
                                <input type="text" name="title" required>
                                <div class="underline"></div>
                                <label>Title</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data textarea">
                                <textarea cols="30" rows="10" name="message" required></textarea>
                                <div class="underline"></div>
                                <label>Write your message</label>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="hidden" name="creator_id" value="<?php echo $_SESSION['id']; ?>">
							    <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
							    <input type="hidden" name="table_name" value="tbl_employeee">
                                <input type="hidden" name="to_table" value="tbl_admin">
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $creator = $_POST['creator'];
                            $title = $_POST['title'];
                            $message = $_POST['message'];
                            $creator_id = $_POST['creator_id'];
                            $table_name = $_POST['table_name'];
                            $to_table = $_POST['to_table'];
                            $date = $_POST['date'];

                            $sql = "INSERT INTO tbl_no SET
                                creator='$creator',
                                title='$title',
                                message='$message',
                                creator_id='$creator_id',
                                table_name='$table_name',
                                to_table='$to_table',
                                date='$date'
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['noticeAdd'] = "<div class='successfuly-done'>Notice Added Successfully.</div>";
                                header("location:".SITEURL.'employee/notification-all.php');
                            } else {
                                $_SESSION['noticeAdd'] = "<div class='Failed-to-do '>Failed to Added Notice.</div>";
                                header("location:".SITEURL.'employee/notification-create.php');
                            }
                        }
                    ?>
                </div>
            </div>
        </main>
    </div>
<?php include('partials/footer.php'); ?>