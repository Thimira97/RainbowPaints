<?php include('partials/header.php'); ?>

<?php include('partials/sidebar.php'); ?>

    <div class="main-content">

        <?php include('partials/notification.php'); ?>

        <main>
            <div class="page-header">
                <div>
                    <h1>Attendence</h1>
                    <small>Find deails about the attendence.</small>
                    <br>
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
                                    <div class="head">Date</div>
                                </td>
                                <td colspan="2">
                                    <div class="head">Attendence</div>
                                </td>
                            </tr>
                            <?php 
                                $employee =  $_SESSION['id'];
                                $sql = "SELECT * FROM tbl_attendence WHERE employee_id=$employee LIMIT 30";

                                $res = mysqli_query($conn,$sql);

                                if($res==TRUE){
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        $sn=1;
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $date = $rows['date'];
                                            $attendence = $rows['attendence'];
                                            if($attendence == "Present"){
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div><?php echo $sn++ ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $date ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $attendence ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><i style="font-size: 40px; " class="lar la-smile"></i></div>
                                                    </td>
                                                </tr>
                                            <?php
                                            } else { ?>
                                                <tr>
                                                    <td>
                                                        <div style="color: crimson; "><?php echo $sn++ ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div style="color: crimson; "><?php echo $date ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div style="color: crimson; "><?php echo $attendence ; ?></div>
                                                    </td>
                                                    <td>
                                                        <div><i style="color: crimson; font-size: 40px;" class="lar la-frown"></i></div>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
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