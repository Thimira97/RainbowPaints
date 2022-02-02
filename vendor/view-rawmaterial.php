<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Raw Materials</h1>
                    <small>Find deails about the all rawmaterials.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['material-add'])){ 
                            echo $_SESSION['material-add']; 
                            unset($_SESSION['material-add']); 
                        }

                        if(isset($_SESSION['raw-delete'])){ 
                            echo $_SESSION['raw-delete']; 
                            unset($_SESSION['raw-delete']); 
                        }

                        if(isset($_SESSION['update-matirial'])){ 
                            echo $_SESSION['update-matirial']; 
                            unset($_SESSION['update-matirial']); 
                        }

                        if(isset($_SESSION['no-matirial-found'])){ 
                            echo $_SESSION['no-matirial-found']; 
                            unset($_SESSION['no-matirial-found']); 
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
                                    <div class="head">Raw Material Name</div>
                                </td>
                                <td>
                                    <div class="head">Unite Price</div>
                                </td>
                                <td>
                                    <div class="head">Actions</div>
                                </td>
                            </tr>
                            <?php 
                                if(isset($_SESSION['id'])){
                                    $vendor_id = $_SESSION['id'];
                                }

                                $sql = "SELECT * FROM tbl_rawmatirial WHERE vendor_id='$vendor_id'";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $raw_name = $rows['raw_name'];
                                            $raw_price = $rows['raw_price'];
                                            ?>
                                            <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $raw_name; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $raw_price; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>vendor/update-rawmatirial.php?id=<?php echo $id; ?>" class="update">Update</a>
                                                            <a href="<?php echo SITEURL; ?>vendor/delete-rawmatirila.php?id=<?php echo $id; ?>" class="delete">Delete</a>
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