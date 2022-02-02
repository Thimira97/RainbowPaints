<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Paints Production</h1>
                    <small>Find deails about the production.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['add-production'])){ 
                            echo $_SESSION['add-production']; 
                            unset($_SESSION['add-production']); 
                        }

                        if(isset($_SESSION['delete'])){ 
                            echo $_SESSION['delete']; 
                            unset($_SESSION['delete']); 
                        }

                        if(isset($_SESSION['update-production'])){ 
                            echo $_SESSION['update-production']; 
                            unset($_SESSION['update-production']); 
                        }

                        if(isset($_SESSION['no-production-found'])){ 
                            echo $_SESSION['no-production-found']; 
                            unset($_SESSION['no-production-found']); 
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
                                    <div class="head">Color</div>
                                </td>
                                <td>
                                    <div class="head">Producted Amount</div>
                                </td>
                                <td>
                                    <div class="head">Total Price</div>
                                </td>
                                <td>
                                    <div class="head">Date</div>
                                </td>
                                <td>
                                    <div class="head">Actions
                                    <form action="" method="POST">
                                        <span class="las la-tools"></span>
                                        <input type="submit" name="submit" value="Edit" class="Edit">
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_production";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $paint_id = $rows['paint_id'];

                                            $sql2 = "SELECT * FROM tbl_paint WHERE id=$paint_id";
                                            $res2 = mysqli_query($conn,$sql2);
                                            $count2 = mysqli_num_rows($res2);
                                            if($count2>0){
                                                while($row2=mysqli_fetch_assoc($res2)){
                                                    $paint_name = $row2['paint_name'];
                                                    $color = $row2['color'];
                                                }
                                            }

                                            $producted_amount = $rows['producted_amount'];
                                            $total_price= $rows['total_price'];
                                            $date = $rows['date'];
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
                                                        <div><?php echo $color; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $producted_amount; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $total_price; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $date; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            
                                                            <?php 
                                                                if(isset($_POST['submit'])){
                                                                    ?>
                                                                    <a href="<?php echo SITEURL; ?>admin/update-production.php?id=<?php echo $id; ?>" class="update">Produce</a>
                                                                    <a href="<?php echo SITEURL; ?>admin/delete-production.php?id=<?php echo $id; ?>" class="delete">Delete</a>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <a href="<?php echo SITEURL; ?>admin/update-production.php?id=<?php echo $id; ?>" class="update">Produce</a>
                                                                    <?php
                                                                }
                                                            ?>
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