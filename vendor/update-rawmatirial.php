<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Update the Raw Material</h1>
                    <small>Fill the new details about the raw material.</small>
                    <br>
                    <?php 
                        
                        if(isset($_SESSION['update-matirial'])){ 
                            echo $_SESSION['update-matirial']; 
                            unset($_SESSION['update-matirial']); 
                        }

                    ?>
                    </div>
            </div>  
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_rawmatirial WHERE id=$id";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $raw_name = $row['raw_name'];
                        $description=$row['description'];
                        $raw_price = $row['raw_price'];
                    } else {
                        $_SESSION['no-matirial-found']= "<div class='Failed-to-do'>Raw Matirial Not Founded.</div>";
                        header('location:'.SITEURL.'vendor/view-rawmaterial.php');
                    }
                } else {
                    header('location:'.SITEURL.'vendor/view-rawmaterial.php');
                }
            
            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="raw_name" value="<?php echo $raw_name; ?>" required>
                                <div class="underline"></div>
                                <label>Raw Matirial Name</label>
                            </div>
                            <div class="input-data">
                                <input name="raw_price" type="number" value="<?php echo $raw_price; ?>" required>
                                <div class="underline"></div>
                                <label>Price Per Unite</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data textarea">
                                <textarea cols="30" rows="10" name="description" required><?php echo $description; ?></textarea>
                                <div class="underline"></div>
                                <label>Description</label>
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
                            $raw_name = $_POST['raw_name'];
                            $description = $_POST['description'];
                            $raw_price = $_POST['raw_price'];

                            $sql = "UPDATE tbl_rawmatirial SET 
                                raw_name='$raw_name',
                                description='$description',
                                raw_price='$raw_price'
                                WHERE id=$id
                            ";

                            $res = mysqli_query($conn,$sql);

                            if($res == true){
                                $_SESSION['update-matirial'] = "<div class='successfuly-done'>Raw Matirial Update Successfully.</div>";
                                header('location:'.SITEURL.'vendor/view-rawmaterial.php');
                        } else {
                                $_SESSION['update-matirial'] = "<div class='Failed-to-do'>Failed to Upadate Raw Matirial.</div>";
                                header('location:'.SITEURL.'vendor/view-rawmaterial.php');
                        }

                        }
                    ?>
                </div>
            </div>
        </main>
    </div>
<?php include('partials/footer.php'); ?>