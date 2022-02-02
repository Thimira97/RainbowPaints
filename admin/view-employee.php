<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Employees</h1>
                    <small>Find deails about the all employees. Update and delete employee details.</small>
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

                        if(isset($_SESSION['delete-employee'])){ 
                            echo $_SESSION['delete-employee']; 
                            unset($_SESSION['delete-employee']);
                        }

                        if(isset($_SESSION['no-employee-found'])){ 
                            echo $_SESSION['no-employee-found']; 
                            unset($_SESSION['no-employee-found']);
                        }

                        if(isset($_SESSION['employee-update'])){ 
                            echo $_SESSION['employee-update']; 
                            unset($_SESSION['employee-update']);
                        }
                        
                        if(isset($_SESSION['upload'])){ 
                            echo $_SESSION['upload']; 
                            unset($_SESSION['upload']); 
                        }

                        if(isset($_SESSION['file-remove'])){ 
                            echo $_SESSION['file-remove']; 
                            unset($_SESSION['file-remove']);
                        }

                        if(isset($_SESSION['remove'])){ 
                            echo $_SESSION['remove']; 
                            unset($_SESSION['remove']);
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
                                    <div class="head">Appoinment Date</div>
                                </td>
                                <td>
                                    <div class="head">Designation</div>
                                </td>
                                <td>
                                    <div class="head">Actions</div>
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
                                                            <a href="<?php echo SITEURL; ?>admin/update-employee.php?id=<?php echo $id; ?>" class="update">Update</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-employee.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="delete">Delete</a>
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
        </main>
    </div>

    <?php include('partials/footer.php'); ?>