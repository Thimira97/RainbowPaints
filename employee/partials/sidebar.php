<input type="checkbox" name="" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="../images/logo2.png" alt="img">
                <h2>Nipolac</h2>
				<div class="brand-icons">
                    <a href="profile.php"><span class="las la-user-circle"></span></a>
                </div>
            </div>
        </div>

        <div class="sidebar-main">
            <div class="sidebar-user">
                <?php 
                    if(isset($_SESSION['id'])){
						$id = $_SESSION['id'];
						
						$sql = "SELECT * FROM tbl_employeee WHERE id=$id";
						$res = mysqli_query($conn,$sql);
						$count = mysqli_num_rows($res);
						if($count==1){
							$row = mysqli_fetch_assoc($res);
							$username=$row['username'];
							$email=$row['email'];
							$gender = $row['gender'];
							$image_name = $row['image_name'];

                            if($image_name != ""){
							?>
                                <img src="<?php echo SITEURL; ?>images/employee/<?php echo $image_name; ?>">
								<div>
                                    <h3><?php echo $username; ?></h3>
                                    <span><?php echo $email; ?></span>
                                </div>
							<?php
							} else {
							?>
								<img src="<?php echo SITEURL; ?>images/woman.png">
                                <div>
                                    <h3><?php echo $username; ?></h3>
                                    <span><?php echo $email; ?></span>
                                </div>
							<?php
							}
							} else {
								$_SESSION['not-found']= "<div class='error-text'>Admin Not Founded.</div>";
								header('location:'.SITEURL.'employee/login.php');
							}
						} else {
							header('location:'.SITEURL.'employee/login.php');
						}
					?>  
					<?php 
						if(isset($_SESSION['add'])){
							echo $_SESSION['add'];
							unset($_SESSION['add']);
						}

						if(isset($_SESSION['login'])){
							echo $_SESSION['login'];
							unset($_SESSION['login']);
						}
					?>
				</div>

				<div class="sidebar-menu">
					<div class="menu-block">
						<ul>
							<li>
								<a href="index.php">
									<span class="las la-chart-pie"></span> Dashboard
								</a>
							</li>
							<li>
								<a href="attendence.php">
									<span class="las la-flag"></span> Attendence
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>