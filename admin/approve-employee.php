<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>New Employees</h1>
                    <small>Approve and hire employees.</small>
                    <br>
                    <?php 
                        if(isset($_SESSION['employee-add'])){ 
                            echo $_SESSION['employee-add'];
                            unset($_SESSION['employee-add']); 
                        }

                        if(isset($_SESSION['approving-employee'])){ 
                            echo $_SESSION['approving-employee'];
                            unset($_SESSION['approving-employee']); 
                        }

                        if(isset($_SESSION['employee-delete'])){ 
                            echo $_SESSION['employee-delete'];
                            unset($_SESSION['employee-delete']); 
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
                                    <div class="head">Name</div>
                                </td>
                                <td>
                                    <div class="head">Picture</div>
                                </td>
                                <td>
                                    <div class="head">User Name</div>
                                </td>
                                <td>
                                    <div class="head">Age</div>
                                </td>
                                <td>
                                    <div class="head">Gender</div>
                                </td>
                                <td>
                                    <div class="head">Address</div>
                                </td>
                                <td>
                                    <div class="head">Email</div>
                                </td>
                                <td>
                                    <div class="head">Contact</div>
                                </td>
                                <td>
                                    <div class="head">Salary</div>
                                </td>
                                <td>
                                    <div class="head">Applied Date</div>
                                </td>
                                <td>
                                    <div class="head">Designation</div>
                                </td>
                                <td>
                                    <div class="head">Actions</div>
                                </td>
                            </tr>

                            <?php 
                                $sql = "SELECT * FROM tbl_employeee WHERE approvement=''";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $name = $rows['name'];
                                            $username = $rows['username'];
                                            $age = $rows['age'];
                                            $gender = $rows['gender'];
                                            $address= $rows['address'];
                                            $email = $rows['email'];
                                            $contact = $rows['contact'];
                                            $salary = $rows['salary'];
                                            $appoinment = $rows['appoinment'];
                                            $designation = $rows['designation'];
                                            $image_name = $rows['image_name'];
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <?php echo $sn++; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $name ; ?></div>
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
                                                        <div><?php echo $username ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $age ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $gender ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $address ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $email ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $contact ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $salary ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $appoinment ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $designation ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="<?php echo SITEURL; ?>admin/approving-employee.php?id=<?php echo $id; ?>" class="update">Approve</a>
                                                            <a href="<?php echo SITEURL; ?>admin/remove-employee.php?id=<?php echo $id; ?>" class="delete">Remove</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='13'><div style='text-align: center;'>There is no Customers to Approve.</div></td></tr>";
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