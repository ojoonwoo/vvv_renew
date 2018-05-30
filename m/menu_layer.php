		<div class="global-menu">
			<div class="inner anim-blur">
				<a href="#" class="btn-close button-menu">
					<img src="./images/close_x_black.png" alt="">
				</a>
				<div class="user-status">
	<?
		if (!$_SESSION['ss_vvv_email'])
		{
	?>                                
					<a href="login.php?refurl=my_vvv.php">MY VVV</a>
					<a href="login.php">LOGIN</a>
	<?
		}else{
	?>        
					<a href="my_vvv.php">MY VVV</a>
					<a href="logout.php">LOGOUT</a>
	<?
		}
	?>                        
				</div>
				<div class="list-wrap">
					<ul class="list">
						<li>
							<a href="index.php" class="is-active">HOME</a>
						</li>
						<li>
							<a href="video_list.php?sort=new">ALL VVV</a>
						</li>
						<li>
							<a href="video_list.php?sort=best">BEST</a>
						</li>
						<li>
							<a href="video_list.php?sort=new">NEW</a>
						</li>
						<li>
							<a href="award_list.php">AWARDS</a>
						</li>
					</ul>
				</div>
				<div class="about-us">
					<div class="line"></div>
					<div class="contacts">
						<p><span>CONTACT US</span></p>
						<p class="tel">
							<i></i>
							<span>+82 (02)532-2475</span>
						</p>
						<p class="sns">
							<i class="mail"></i>
							<i class="facebook"></i>
							<i class="instagram"></i>
						</p>
					</div>
				</div>
				<div class="copyright">
					COPYRIGHTS©2018 Valuable Viral Video ALL RIGHT RESERVED.
				</div>
			</div>
		</div>
