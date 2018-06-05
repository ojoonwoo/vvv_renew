			<div class="header-container">
				<header>
					<div class="inner">
						<h1>
							<a href="index.php" class="logo">
								<img src="./images/vvv_logo.png" alt="" class="retina">
							</a>
						</h1>
						<div class="actions">
							<div class="user-status">
<?
	if (!$_SESSION['ss_vvv_email'])
	{
?>                                
                                <a href="login.php">LOGIN</a>
<?
    }else{
?>        
                                <a href="logout.php">LOGOUT</a>
<?
    }
?>                        
							</div>
							<div class="search-wrap magnet-wrap">
								<button type="button" class="magnet-parent button-search" data-mouse-type="ripple">
									<span class="magnet-child"></span>
								</button>
							</div>
						</div>
					</div>
				</header>
			</div>
