			<div class="header-container">
				<header>
					<div class="inner">
						<div class="submit-link">
							<div class="icon">
								<img src="./images/submit_icon.svg" alt="">
							</div>
							<div class="text">
								<span>Submit Your VVV</span>
								<span>새로운 영상을 업로드 해보세요</span>
							</div>
						</div>
						<h1>
							<a href="index.php" class="logo" data-mouse-type="ripple">
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
								<button type="button" class="magnet-parent button-search" data-mouse-type="text" data-text="search">
									<span class="magnet-child"></span>
								</button>
							</div>
						</div>
					</div>
				</header>
			</div>
