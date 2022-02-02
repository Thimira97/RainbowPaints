<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Update the Paint</h1>
                    <small>Fill the new details about the paint.</small>
                    </div>
            </div>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_paint WHERE id=$id";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $paint_name = $row['paint_name'];
                        $description = $row['description'];
                        $current_image = $row['image_name'];
                        $current_category = $row['category_id'];
                        $color = $row['color'];
                        $price = $row['price'];

                    } else {
                        $_SESSION['no-category-found']= "<div class='Failed-to-do'>Paint Not Founded.</div>";
                        header('location:'.SITEURL.'admin/view-paint.php');
                    }
                } else {
                    header('location:'.SITEURL.'admin/view-paint.php');
                }
            ?>
            <div class="form-body">
                <div class="container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="paint_name" value="<?php echo $paint_name; ?>" required>
                                <div class="underline"></div>
                                <label>Paint Name</label>
                            </div>
                            <div class="input-data">
                                <select name="category">
                                <?php 
                                    $sql2 = "SELECT * FROM tbl_category";
                                    $res2= mysqli_query($conn,$sql2);
                                    $count2 = mysqli_num_rows($res2);
                                    if($count2>0){
                                        while($row2=mysqli_fetch_assoc($res2)){
                                            $category_id = $row2['id'];
                                            $category_title = $row2['title'];
                                            ?>
                                                <option <?php if($current_category==$category_id){ echo "selected" ;} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                            <option value="0">No Category Found</option>
                                        <?php
                                    }
                                ?>
                                </select>
                                <div class="underline-before"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="color" value="<?php echo $color; ?>" required>
                                <div class="underline"></div>
                                <label>Color</label>
                            </div>
                            <div class="input-data">
                                <input type="number" name="price" value="<?php echo $price; ?>" required>
                                <div class="underline"></div>
                                <label>One Unite Price</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data image-update">
                                <?php 
                                    if($current_image != ""){
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/paints/<?php echo $current_image; ?>" style="width: 50px; border-radius: 50%;">
                                        <?php
                                    } else {
                                       ?>
                                            <img src="<?php echo SITEURL; ?>images/avatar3.png" style="width: 50px; border-radius: 50%;">
                                       <?php
                                    }
                                ?>
                                <input type="file" name="image">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data textarea">
                                <textarea cols="30" rows="10" required name="description"><?php echo $description; ?></textarea>
                                <div class="underline"></div>
                                <label>Write your message</label>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <div class="inner"></div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $id = $_POST['id'];
                            $paint_name = $_POST['paint_name'];
                            $description = $_POST['description'];
                            $category = $_POST['category'];
                            $color = $_POST['color'];
                            $price = $_POST['price'];
                            $current_image=$_POST['current_image'];

                            if(isset($_FILES['image']['name'])){
                                $image_name = $_FILES['image']['name'];

                                if($image_name != ""){
                                    $temp = explode('.',$image_name);
                                    $ext = end($temp);
                                    $image_name = "Paint_".rand(000,999).'.'.$ext;
                                    $source_path = $_FILES['image']['tmp_name'];
                                    $destination_path = "../images/paints/".$image_name;
                                    $upload = move_uploaded_file($source_path,$destination_path);

                                    if($upload == false){
                                        $_SESSION['upload-paint'] = "<div class='Failed-to-do'>Failed to Upload Image.</div>";
                                        header('location:'.SITEURL.'admin/view-paint.php');
                                        die();
                                    }

                                    if($current_image != ""){
                                        $remove_path = "../images/paints/".$current_image;
                                        $remove = unlink($remove_path);

                                        if($remove == false){
                                            $_SESSION['paint-file_remove'] = "<div class='Failed-to-do'>Failed to Remove Image.</div>";
                                            header('location:'.SITEURL.'admin/view-paint.php');
                                            die();
                                        }
                                    } 
                                } else {
                                    $image_name = $current_image;
                                }
                            } else {
                                $image_name = $current_image;  
                            }

                            $sql = "UPDATE tbl_paint SET
                                paint_name='$paint_name',
                                description='$description',
                                image_name='$image_name',
                                category_id='$category',
                                color='$color',
                                price='$price'
                                WHERE id=$id
                            ";

                            $res =mysqli_query($conn,$sql);

                            if($res == true){
                                    $_SESSION['update-paint'] = "<div class='successfuly-done'>Paint Update Successfully.</div>";
                                    header('location:'.SITEURL.'admin/view-paint.php');
                            } else {
                                    $_SESSION['update-paint'] = "<div class='Failed-to-do'>Failed to Upadate Paint.</div>";
                                    header('location:'.SITEURL.'admin/view-paint.php');
                            }
                        }
                    
                    ?>
            </div>
        </div>
    </main>
</div>
<?php include('partials/footer.php'); ?>