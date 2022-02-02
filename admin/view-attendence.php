<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Attendence</h1>
                    <small>View attence of all the employees.</small>
                    <br>
                        <?php 
                            if(isset($_SESSION['add-attendence'])){ 
                                echo $_SESSION['add-attendence'];
                                unset($_SESSION['add-attendence']);
                            }
                        ?>
                </div>
                <div class="header-actions">
                    <button>
                            <a href="attendence.php">
                                <span class="las la-check"></span>
                                Mark Attendence
                            </a>
                    </button>
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
                                    <div class="head">Picture</div>
                                </td>
                                <td>
                                    <div class="head">Name</div>
                                </td>
                                <td>
                                    <div class="head">Present</div>
                                </td>
                                <td>
                                    <div class="head">Absent</div>
                                </td>
                                <td>
                                    <div class="head">Presentage</div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM tbl_employeee WHERE approvement='Yes'";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $name = $rows['name'];
                                            $image_name = $rows['image_name'];
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <?php 
                                                                if($image_name!=""){
                                                                    ?>
                                                                    <img src="<?php echo SITEURL; ?>images/employee/<?php echo $image_name; ?>" style="width: 50px; border-radius: 50%;">
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <img src="<?php echo SITEURL; ?>images/avatar3.png" style="width: 50px; border-radius: 50%;">
                                                                    <?php
                                                                }
                                                        
                                                            ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $name ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                        <?php 
                                                            $sql1 = "SELECT * FROM tbl_attendence WHERE employee_id='$id' AND attendence='Present'";
                                                            $res1= mysqli_query($conn,$sql1);
                                                            $count1 = mysqli_num_rows($res1);
                                                            echo $count1;
                                                        ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                        <?php 
                                                            $sql2 = "SELECT * FROM tbl_attendence WHERE employee_id='$id' AND attendence='Absent'";
                                                            $res2= mysqli_query($conn,$sql2);
                                                            $count2 = mysqli_num_rows($res2);
                                                            echo $count2;
                                                        ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <?php 
                                                                $sql3 = "SELECT * FROM tbl_attendence WHERE employee_id='$id'";
                                                                $res3= mysqli_query($conn,$sql3);
                                                                $count3 = mysqli_num_rows($res3);

                                                                $presentage = ($count1/$count3)*100 ;
                                                                echo round($presentage,2)."%";
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