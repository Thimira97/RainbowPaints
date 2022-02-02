<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Add a New Category</h1>
                    <small>Fill the details about the new category.</small>
                    <?php 
                        
                        if(isset($_SESSION['add-category'])){ 
                            echo $_SESSION['add-category']; 
                            unset($_SESSION['add-category']);
                        }

                        if(isset($_SESSION['upload'])){ 
                            echo $_SESSION['upload']; 
                            unset($_SESSION['upload']);
                        }

                    ?>
                    </div>
            </div>

            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="title" required>
                                <div class="underline"></div>
                                <label>Category Name</label>
                            </div>
                            <div class="input-data">
                                <input type="file" name="image" required>
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
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>

            <?php 
                if(isset($_POST['submit'])){
                    $title = $_POST['title'];
                    $description = $_POST['description'];

                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];

                        if($image_name != ""){
                            $ext = end(explode('.',$image_name));
                            $image_name = "Paint_Category_".rand(000,999).'.'.$ext;
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/".$image_name;
                            $upload = move_uploaded_file($source_path,$destination_path);

                            if($upload==false){
                                $_SESSION['upload'] = "<div class='Failed-to-do'>Failed to Upload File.</div>";
                                header('location:'.SITEURL.'admin/add-category.php');
                                die();
                            }
                        }

                    } else {
                        $image_name = "";
                    }

                    $sql = "INSERT INTO tbl_category SET 
                        title='$title',
                        image_name='$image_name',
                        description='$description'
                    ";

                    $res = mysqli_query($conn,$sql);

                    if($res==true){
                        $_SESSION['add-category'] = "<div class='successfuly-done'>Category Added Successfully.</div>";
                        header('location:'.SITEURL.'admin/view-category.php');
                    } else {
                        $_SESSION['add-category'] = "<div class='Failed-to-do'>Failed to Add Category.</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                    }

                }
            ?>
            </div>
        </div>
    </main>
</div>

<?php include('partials/footer.php'); ?>