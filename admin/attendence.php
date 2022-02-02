<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Take Attendence</h1>
                    <small>Make attence of the employees.</small>
                    <br>
                        <?php 
                            if(isset($_SESSION['add-attendence'])){
                                echo $_SESSION['add-attendence'];
                                unset($_SESSION['add-attendence']);
                            }
                        ?>
                </div>
            </div>

            <form action="" method="post">
                <div class="form-attendence">
                    <div class="input-data">
                        <input type="hidden" name="username" required>
                        <div class="underline"></div>
                        <label>Attendence Date</label>
                    </div>
                    <div class="input-data">
                        <input type="date" name="date" required>
                        <div class="underline-before"></div>
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
                                        <div class="head">Attendence</div>
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
                                                                <div class="checkbox">
                                                                    <input type="hidden" name="id[]" value="<?php echo $id; ?>" />
                                                                    <input type="checkbox" name="present[]" value="Present" /><label>Present</label>
                                                                    <input type="checkbox" name="present[]" value="Absent" /><label>Absent</label>
                                                                </div>
                                                            </div>
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
                <div class="head attendence-btn">
                    <input type="submit" name="submit" value="save attendence ">
                </div>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $id = $_POST['id'];
                    $present = $_POST['present'];
                    $date = $_POST['date'];
                    
                    $sql4 = "SELECT date FROM tbl_attendence WHERE date ='$date'";
                    $res4= mysqli_query($conn,$sql4);
                    $count4 = mysqli_num_rows($res4);
                    echo $count4;
                    if($count4 == 0){
                        foreach( $id as $num => $n ) {
                            $sql = "INSERT INTO tbl_attendence SET 
                                    employee_id='$n',
                                    date='$date',
                                    attendence='$present[$num]'
                                ";

                                $res = mysqli_query($conn,$sql);

                                if($res==true){
                                    $_SESSION['add-attendence'] = "<div class='successfuly-done'>Attendence Added Successfully.</div>";
                                    header('location:'.SITEURL.'admin/view-attendence.php');
                                } else {
                                    $_SESSION['add-attendence'] = "<div class='Failed-to-do'>Failed to Add Attendence.</div>";
                                    header('location:'.SITEURL.'admin/attendence.php');
                                }
                        }
                    } else {
                        $_SESSION['add-attendence'] = "<div class='Failed-to-do'>Alredy Add the Attendence.</div>";
                        header('location:'.SITEURL.'admin/attendence.php');
                    }
                }
            ?>
        </main>
    </div>
<?php include('partials/footer.php'); ?>