<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

	// 회원 정보 가져오기
	if ($_REQUEST["idx"])
		$my_idx	= $_REQUEST["idx"];
	else
		$my_idx	= $_SESSION['ss_vvv_idx'];

	if (!$_SESSION['ss_vvv_idx'] && $_REQUEST["email"] == "")
		echo "<script>location.href='login.php';</script>";

	// 회원 정보 가져오기
	$mb_query		= "SELECT * FROM member_info WHERE idx='".$my_idx."'";
	$mb_result		= mysqli_query($my_db, $mb_query);
	$mb_data		= mysqli_fetch_array($mb_result);


	$my_query		= "SELECT * FROM like_info WHERE mb_email='".$mb_data["mb_email"]."' AND like_flag='Y'";
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
										<img src="./images/profile_img_sample.jpg" alt="">
									</div>
									<div class="info-wrap">
									<!--me, not me-->
										<div class="wrap-user">
											<div class="user-id">
<?
	if ($_SESSION['ss_vvv_idx'] == $my_idx)
	{
?>
												<span class="u-id"><?=$_SESSION['ss_vvv_name']?></span>
<?
	}else{
		$member_query		= "SELECT * FROM member_info WHERE idx='".$my_idx."'";
		$member_result		= mysqli_query($my_db, $member_query);
		$member_data		= mysqli_fetch_array($member_result);

?>
												<span class="u-id"><?=$member_data['mb_name']?></span>
<?
	}
?>
												<a href="javascript:void(0)" class="setting">
													<img src="./images/icon_profile_setting.png" alt="">
												</a>
												<div class="follow-state">
													<a href="javascript:void(0)">팔로우하기</a>
<!--													<a href="javascript:void(0)" class="already">팔로우중</a>-->
												</div>
											</div>
										</div>
										<div class="wrap-actions">
											<div class="f-wer">
												<span>팔로워</span>
												<span class="count">10</span>
											</div>
											<div class="f-ing">
												<span>팔로잉</span>
												<span class="count">10</span>
											</div>
											<div class="f-add">
												<button type="button">친구추가</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- container -->
							<div class="user-feed">
								<div class="wrapper">
									<div class="tab-wrap">
										<div class="tab is-active">
											<a href="#">Collection</a>
										</div>
										<div class="tab">
											<a href="#">Like</a>
										</div>
									</div>
									<div class="inner">
										<div class="aj-content collection is-active">
											<div class="wrapper made">
												<div class="text-block">
													<h5>내가 만든 컬렉션</h5>
													<p>당신이 저장한 영상들을 컬렉션으로 만들어 보세요!</p>
													<button type="button" class="btn-create">만들기</button>
												</div>
												<div class="list-container">
													<div class="album-list">
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																</figcaption>
															</figure>
														</div>
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																</figcaption>
															</figure>
														</div>
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																	<div class="secret-mode"></div>
																</figcaption>
															</figure>
														</div>
													</div>
												</div>
											</div>
											<div class="wrapper liked">
												<div class="text-block">
													<h5>내가 좋아한 컬렉션</h5>
													<p>당신이 좋아한 컬렉션입니다!</p>
												</div>
												<div class="list-container">
													<div class="album-list">
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																</figcaption>
															</figure>
														</div>
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																</figcaption>
															</figure>
														</div>
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																	<div class="secret-mode"></div>
																</figcaption>
															</figure>
														</div>
													</div>
												</div>
											</div>
										</div>
										
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