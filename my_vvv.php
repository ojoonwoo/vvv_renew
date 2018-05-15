<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

	// 회원 정보 가져오기
	if ($_REQUEST["email"])
		$my_email	= $_REQUEST["email"];
	else
		$my_email	= $_SESSION['ss_vvv_email'];

	if (!$_SESSION['ss_vvv_email'] && $_REQUEST["email"] == "")
		echo "<script>location.href='login.php';</script>";

	$my_query		= "SELECT * FROM ".$_gl['like_info_table']." WHERE mb_email='".$my_email."' AND like_flag='Y'";
	$my_result		= mysqli_query($my_db, $my_query);
	$my_count		= mysqli_num_rows($my_result);

    include_once "./head.php";
?>
	<body>
		<div id="app">
			<div class="app-container sub">
<?
    include_once "./side_nav_layer.php";
?>			
			<!--햄버거 클릭 메뉴-->
<?
    include_once "./menu_layer.php";
?>			
			<!--햄버거 클릭 메뉴-->
			<!--검색 메뉴-->
<?
    include_once "./search_layer.php";
?>			
			<!--검색 메뉴-->
<?
    include_once "./header_layer.php";
?>
				<div class="main-container">
					<div class="content user-page">
						<div class="inner">
							<div class="user-info">
								<div class="wrapper">
									<div class="profile-img">
										<img src="./images/detail_video_sample.jpg" alt="">
									</div>
									<div class="info-wrap">
									<!--me, not me-->
										<div class="wrap-user">
											<div class="user-id">
												<span class="u-id">MINIVER</span>
											</div>
										</div>
										<div class="wrap-act">
											
										</div>
									</div>
								</div>
							</div>
							<div class="user-feed">
								<div class="wrapper">
									<div class="tab-wrap">
<!--
										<div class="tab">
											<a href="#">Collection</a>
										</div>
-->
										<div class="tab is-active">
											<a href="#">Like</a>
										</div>
									</div>
									<div class="inner">
										<div class="aj-content like">
											<div class="text-block">
												<span>당신이</span> 좋아한 영상입니다!
											</div>
											<div class="list-container">
												<div class="video-list">
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="#">
															<figure>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture Hurting</span>
																	<span class="icon-wrap">
																		<span class="play">
																			<i class="icon"></i>
																			<span class="cnt">4</span>
																		</span>
																		<span class="comment">
																			<i class="icon"></i>
																			<span class="cnt">0</span>
																		</span>
																		<span class="like">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																		<span class="collect">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																	</span>
																</figcaption>
															</figure>
														</a>
													</div>
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="#">
															<figure>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting</span>
																	<span class="icon-wrap">
																		<span class="play">
																			<i class="icon"></i>
																			<span class="cnt">4</span>
																		</span>
																		<span class="comment">
																			<i class="icon"></i>
																			<span class="cnt">0</span>
																		</span>
																		<span class="like">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																		<span class="collect">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																	</span>
																</figcaption>
															</figure>
														</a>
													</div>
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="#">
															<figure>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting</span>
																	<span class="icon-wrap">
																		<span class="play">
																			<i class="icon"></i>
																			<span class="cnt">4</span>
																		</span>
																		<span class="comment">
																			<i class="icon"></i>
																			<span class="cnt">0</span>
																		</span>
																		<span class="like">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																		<span class="collect">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																	</span>
																</figcaption>
															</figure>
														</a>
													</div>
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="#">
															<figure>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That</span>
																	<span class="icon-wrap">
																		<span class="play">
																			<i class="icon"></i>
																			<span class="cnt">4</span>
																		</span>
																		<span class="comment">
																			<i class="icon"></i>
																			<span class="cnt">0</span>
																		</span>
																		<span class="like">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																		<span class="collect">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																	</span>
																</figcaption>
															</figure>
														</a>
													</div>
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="#">
															<figure>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting</span>
																	<span class="icon-wrap">
																		<span class="play">
																			<i class="icon"></i>
																			<span class="cnt">4</span>
																		</span>
																		<span class="comment">
																			<i class="icon"></i>
																			<span class="cnt">0</span>
																		</span>
																		<span class="like">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																		<span class="collect">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																	</span>
																</figcaption>
															</figure>
														</a>
													</div>
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="#">
															<figure>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting</span>
																	<span class="icon-wrap">
																		<span class="play">
																			<i class="icon"></i>
																			<span class="cnt">4</span>
																		</span>
																		<span class="comment">
																			<i class="icon"></i>
																			<span class="cnt">0</span>
																		</span>
																		<span class="like">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																		<span class="collect">
																			<i class="icon"></i>
																			<span class="cnt">2</span>
																		</span>
																	</span>
																</figcaption>
															</figure>
														</a>
													</div>
													<button type="button" class="read-more">
														<img src="./images/plus_icon.png" alt="">
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="cursor" class="defualt"></div>
		</div>
		<script>
			$(function() {
				//				global search
				$('#order-date').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-nation').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-industry').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-genre').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-awards').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-sortby').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			});

			//	기본 기능 테스트 코드
			$doc = $(document),
				$win = $(window),
				$html = $('html');
			$doc.on('click', '.button-search', function() {
				$html.addClass('layer-opened');
			});
			$doc.on('click', '.layer-close', function() {
				$html.removeClass('layer-opened');
			});
			$doc.on('click', '.button-menu', function() {
				$html.toggleClass('menu-opened');
			});
			$win.on('scroll', function() {
				if(150 < $(this).scrollTop()) {
					$('.side-nav .search-wrap').css({
						opacity: 1
					});
				} else {
					$('.side-nav .search-wrap').css({
						opacity: 0
					});
				}
			});
		</script>
	</body>

</html>