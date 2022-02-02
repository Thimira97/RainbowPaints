<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Update the Category</h1>
                    <small>Fill the new details about the category.</small>
                </div>
            </div>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_category WHERE id=$id";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $description = $row['description'];
                        $current_image = $row['image_name'];
                    } else {
                        $_SESSION['no-category-found']= "<div class='Failed-to-do'>Category Not Founded.</div>";
                        header('location:'.SITEURL.'admin/view-category.php');
                    }
                } else {
                    header('location:'.SITEURL.'admin/view-category.php');
                }
            
            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="title" value="<?php echo $title; ?>" required>
                                <div class="underline"></div>
                                <label>Category Name</label>
                            </div>
                            <div class="input-data">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <div class="underline"></div>
                                <label></label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data textarea">
                                <textarea name="description" cols="30" rows="10" required><?php echo $description ;?></textarea>
                                <div class="underline"></div>
                                <label>Write your message</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data image-update">
                                <?php 
                                    if($current_image != ""){
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" style="width: 50px; border-radius: 50%;">
                                        <?php
                                    } else {
                                       ?>
                                            <img src="<?php echo SITEURL; ?>images/logo4.png" style="width: 50px; border-radius: 50%;">
                                       <?php
                                    }
                                ?>
                                <input type="file" name="image">
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
                            $id = $_POST['id'];
                            $title = $_POST['title'];
                            $description = $_POST['description'];
                            $current_image=$_POST['current_image'];

                            if(isset($_FILES['image']['name'])){
                                $image_name = $_FILES['image']['name'];

                                if($image_name != ""){
                                    $ext = end(explode('.',$image_name));
                                    $image_name = "Category_Image_".rand(000, 999).'.'.$ext;
                                    $source_path = $_FILES['image']['tmp_name'];
                                    $destination_path = "../images/category/".$image_name;
                                    $upload = move_uploaded_file($source_path,$destination_path);

                                    if($upload == false){
                                        $_SESSION['upload'] = "<div class='Failed-to-do'>Failed to Upload Image.</div>";
                                        header('location:'.SITEURL.'admin/view-category.php');
                                        die();
                                    }

                                    if($current_image != ""){
                                        $remove_path = "../images/category/".$current_image;
                                        $remove = unlink($remove_path);

                                        if($remove == false){
                                            $_SESSION['file_remove'] = "<div class='Failed-to-do'>Failed to Remove Image.</div>";
                                            header('location:'.SITEURL.'admin/view-category.php');
                                            die();
                                        }
                                    } 
                                } else {
                                    $image_name = $current_image;
                                }
                            } else {
                                $image_name = $current_image;  
                            }

                            $sql = "UPDATE tbl_category SET
                                title='$title',
                                image_name='$image_name',
                                description='$description'
                                WHERE id=$id
                            ";

                            $res =mysqli_query($conn,$sql);

                            if($res == true){
                                    $_SESSION['update'] = "<div class='successfuly-done'>Category Update Successfully.</div>";
                                    header('location:'.SITEURL.'admin/view-category.php');
                            } else {
                                    $_SESSION['update'] = "<div class='Failed-to-do'>Failed to Upadate Category.</div>";
                                    header('location:'.SITEURL.'admin/view-category.php');
                            }
                        }
                    
                    ?>
            </div>
        </div>
    </main>
</div>
<?php include('partials/footer.php'); ?>