<input type="checkbox" name="" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="../images/logo2.png" alt="img">
                <h2>Rainbow Paints</h2>
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
					
					$sql = "SELECT * FROM tbl_vendor WHERE id=$id";
					$res = mysqli_query($conn,$sql);
					$count = mysqli_num_rows($res);
					if($count==1){
						$row = mysqli_fetch_assoc($res);
						$username=$row['username'];	
						$email=$row['email'];		
						?>
							<img src="<?php echo SITEURL; ?>images/avatar2.png">
                                <div>
                                    <h3><?php echo $username; ?></h3>
                                    <span><?php echo $email; ?></span>
                                </div>
							<?php
					} else {
						$_SESSION['not-found']= "<div class='error-text'>Vendor Not Founded.</div>";
						header('location:'.SITEURL.'vendor/login.php');
					}
				} else {
					header('location:'.SITEURL.'vendor/login.php');
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
							<a href="orders.php">
								<span class="las la-shopping-cart"></span> Order
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>