<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Paints</h1>
                    <small>Find deails about the all paints.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['add-paint'])){ 
                            echo $_SESSION['add-paint']; 
                            unset($_SESSION['add-paint']); 
                        }

                        if(isset($_SESSION['remove'])){ 
                            echo $_SESSION['remove']; 
                            unset($_SESSION['remove']); 
                        }

                        if(isset($_SESSION['delete'])){ 
                            echo $_SESSION['delete']; 
                            unset($_SESSION['delete']); 
                        }

                        if(isset($_SESSION['upload-paint'])){ 
                            echo $_SESSION['upload-paint']; 
                            unset($_SESSION['upload-paint']); 
                        }

                        if(isset($_SESSION['paint-file_remove'])){ 
                            echo $_SESSION['paint-file_remove']; 
                            unset($_SESSION['paint-file_remove']); 
                        }

                        if(isset($_SESSION['update-paint'])){ 
                            echo $_SESSION['update-paint']; 
                            unset($_SESSION['update-paint']); 
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
                                    <div class="head">Paint Name</div>
                                </td>
                                <td>
                                    <div class="head">Image</div>
                                </td>
                                <td>
                                    <div class="head">Color</div>
                                </td>
                                <td>
                                    <div class="head">Price</div>
                                </td>
                                <td>
                                    <div class="head">Actions</div>
                                </td>
                            </tr>

                            <?php 
                                $sql = "SELECT * FROM tbl_paint";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $paint_name = $rows['paint_name'];
                                            $image_name = $rows['image_name'];
                                            $color = $rows['color'];
                                            $price= $rows['price'];
                                            ?>

                                                <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $paint_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <?php 
                                                                if($image_name != ""){
                                                                    ?>
                                                                        <img src="<?php echo SITEURL; ?>images/paints/<?php echo $image_name; ?>" width="50px">
                                                                    <?php
                                                                } else {
                                                                    echo "<div class='error-text'>Image Not Added.</div>";
                                                                }
                                                            ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $color; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $price; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/update-paint.php?id=<?php echo $id; ?>" class="update">Update</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-paint.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="delete">Delete</a>
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