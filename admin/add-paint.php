<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Add a New Paint</h1>
                    <small>Fill the details about the new paint.</small>
                    <?php 
                        
                        if(isset($_SESSION['add-paint'])){
                            echo $_SESSION['add-paint'];
                            unset($_SESSION['add-paint']);
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
                                <input type="text" name="paint_name" required>
                                <div class="underline"></div>
                                <label>Paint Name</label>
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
                        <div class="form-row">
                            <div class="input-data">
                                <select name="category">
                                    <?php 
                                        $sql = "SELECT * FROM tbl_category";
                                        $res = mysqli_query($conn,$sql);
                                        $count = mysqli_num_rows($res);
                                        if($count>0){
                                            while($row=mysqli_fetch_assoc($res)){
                                                $id = $row['id'];
                                                $title = $row['title'];
                                                ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                            <div class="input-data">
                                <input type="text" name="color" required>
                                <div class="underline"></div>
                                <label>Color</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="number" name="price" required>
                                <div class="underline"></div>
                                <label>One Unite Price</label>
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
                            $paint_name = $_POST['paint_name'];
                            $description = $_POST['description'];
                            $category = $_POST['category'];
                            $color = $_POST['color'];
                            $price = $_POST['price'];

                            if(isset($_FILES['image']['name'])){
                                $image_name = $_FILES['image']['name'];

                                if($image_name != ""){
                                    $temp = explode('.',$image_name);
                                    $ext = end($temp);
                                    $image_name = "Paint_".rand(000,999).'.'.$ext;
                                    $source_path = $_FILES['image']['tmp_name'];
                                    $destination_path = "../images/paints/".$image_name;
                                    $upload = move_uploaded_file($source_path,$destination_path);

                                    if($upload==false){
                                        $_SESSION['upload'] = "<div class='Failed-to-do'>Failed to Upload Image.</div>";
                                        header('location:'.SITEURL.'admin/add-paint.php');
                                        die();
                                    }
                                }

                            } else {
                                $image_name = "";
                            }

                            $sql2 = "INSERT INTO tbl_paint SET 
                                paint_name='$paint_name',
                                description='$description',
                                image_name='$image_name',
                                category_id='$category',
                                color='$color',
                                price='$price'
                            ";

                            $res2 = mysqli_query($conn,$sql2);

                            if($res2==true){
                                $_SESSION['add-paint'] = "<div class='successfuly-done'>Paint Added Successfully.</div>";
                                header('location:'.SITEURL.'admin/view-paint.php');
                            } else {
                                $_SESSION['add-paint'] = "<div class='Failed-to-do'>Failed to Add Paint.</div>";
                                header('location:'.SITEURL.'admin/add-paint.php');
                            }

                        }
                    ?>
            </div>
        </div>
    </main>
</div>

<?php include('partials/footer.php'); ?>