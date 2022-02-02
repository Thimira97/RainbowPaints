<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Raw Materials</h1>
                    <small>Find deails about the all raw materials</small>
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
                                    <div class="head">Description</div>
                                </td>
                                <td>
                                    <div class="head">Unite Price</div>
                                </td>
                                <td>
                                    <div class="head">Company</div>
                                </td>
                                <td>
                                    <div class="head">Address</div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_rawmatirial";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $raw_name = $rows['raw_name'];
                                            $description = $rows['description'];
                                            $raw_price = $rows['raw_price'];
                                            $vendor_id = $rows['vendor_id'];

                                            $sql2 = "SELECT * FROM tbl_vendor WHERE id='$vendor_id'";
                                            $res2 = mysqli_query($conn,$sql2);
                                            if($res2==TRUE){
                                                $count2 = mysqli_num_rows($res2);

                                                if($count2>0){
                                                    while($rows2 = mysqli_fetch_assoc($res2)){
                                                        $company = $rows2['c_name'];
                                                        $address = $rows2['address'];
                                                    }
                                                }
                                            }

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
                                                        <div><?php echo $description; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $raw_price; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $company; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $address; ?></div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<div class='error'>There is no data in the table</div>";
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