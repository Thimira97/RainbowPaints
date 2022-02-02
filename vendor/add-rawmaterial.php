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
                    <h1>New Raw Material</h1>
                    <small>Fill the new details about the raw material.</small>
                    <br>
                    <?php 
                        
                        if(isset($_SESSION['material-add'])){ 
                            echo $_SESSION['material-add']; 
                            unset($_SESSION['material-add']); 
                        }

                    ?>
                </div>
            </div>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="raw_name" required>
                                <div class="underline"></div>
                                <label>Raw Matirial Name</label>
                            </div>
                            <div class="input-data">
                                <input type="number" name="raw_price" required>
                                <div class="underline"></div>
                                <label>Price Per Unite</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data textarea">
                                <textarea cols="30" rows="10" name="description" required></textarea>
                                <div class="underline"></div>
                                <label>Description</label>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="hidden" name="vendor_id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $raw_name = $_POST['raw_name'];
                            $description = $_POST['description'];
                            $raw_price = $_POST['raw_price'];
                            $vendor_id = $_POST['vendor_id'];

                            $sql = "INSERT INTO tbl_rawmatirial SET 
                                raw_name='$raw_name',
                                description='$description',
                                raw_price='$raw_price',
                                vendor_id='$vendor_id'
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res==true){
                                $_SESSION['material-add'] = "<div class='successfuly-done'>Raw Matirial Added Successfully.</div>";
                                header('location:'.SITEURL.'vendor/view-rawmaterial.php');
                            } else {
                                $_SESSION['material-add'] = "<div class='Failed-to-do'>Failed to Add Raw Matirial.</div>";
                                header('location:'.SITEURL.'vendor/add-rawmaterial.php');
                            }

                        }
                    ?>
                </div>
            </div>
        </main>
    </div>
<?php include('partials/footer.php'); ?>