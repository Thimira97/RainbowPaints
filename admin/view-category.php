<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Paint Categories</h1>
                    <small>Find deails about the all paint categories.</small>
                    <br>
                        <?php 
                            
                            if(isset($_SESSION['add-category'])){ 
                                echo $_SESSION['add-category'];
                                unset($_SESSION['add-category']); 
                            }

                            if(isset($_SESSION['remove'])){ 
                                echo $_SESSION['remove'];
                                unset($_SESSION['remove']); 
                            }

                            if(isset($_SESSION['delete'])){ 
                                echo $_SESSION['delete'];
                                unset($_SESSION['delete']); 
                            }

                            if(isset($_SESSION['upload'])){ 
                                echo $_SESSION['upload'];
                                unset($_SESSION['upload']); 
                            }

                            if(isset($_SESSION['file_remove'])){ 
                                echo $_SESSION['file_remove'];
                                unset($_SESSION['file_remove']); 
                            }

                            if(isset($_SESSION['update'])){ 
                                echo $_SESSION['update'];
                                unset($_SESSION['update']); 
                            }

                            if(isset($_SESSION['no-category-found'])){ 
                                echo $_SESSION['no-category-found'];
                                unset($_SESSION['no-category-found']); 
                            }

                        ?>
                    </div>
            </div>

            <div class="jobs">
                <div class="table-responsive">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="head">
                                        <span class="indicator"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="head">Category Name</div>
                                </td>
                                <td>
                                    <div class="head">Picture</div>
                                </td>
                                <td>
                                    <div class="head">Description</div>
                                </td>
                                <td>
                                    <div class="head">Actons</div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_category";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $title = $rows['title'];
                                            $image_name = $rows['image_name'];
                                            $description = $rows['description'];
                                            ?>
                                            <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $title; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <?php 
                                                                if($image_name!=""){
                                                                    ?>
                                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" style="width: 50px; border-radius: 50%;">
                                                                    <?php
                                                                } else {
                                                                    echo "<div class='error'>Image not Added.</div>";
                                                                }
                                                        
                                                            ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $description; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="update">Update</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="delete">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<?php include('partials/footer.php'); ?>