<?
    include_once "../include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

	if (!$_SESSION['ss_vvv_idx'] && $_REQUEST["email"] == "")
		echo "<script>location.href='login.php';</script>";

	// 회원 정보 가져오기
	if ($_REQUEST["idx"])
	{
		$my_idx			= $_REQUEST["idx"];
		$follow_idx		= $_REQUEST["idx"]; 
	}else{
		$my_idx			= $_SESSION['ss_vvv_idx'];
		$follow_idx		= $_REQUEST["idx"]; 
	}

	// if ($_SESSION['ss_vvv_idx'] == $my_idx)
	// {
	// 	$member_query		= "SELECT * FROM member_info WHERE idx='".$my_idx."'";
	// 	$member_result		= mysqli_query($my_db, $member_query);
	// 	$member_data		= mysqli_fetch_array($member_result);
	// }
	
	// 회원 정보 가져오기
	$mb_query		= "SELECT * FROM member_info WHERE idx='".$my_idx."'";
	$mb_result		= mysqli_query($my_db, $mb_query);
	$mb_data		= mysqli_fetch_array($mb_result);


	$my_query		= "SELECT * FROM like_info WHERE mb_idx='".$mb_data["idx"]."' AND like_flag='Y'";
	$my_result		= mysqli_query($my_db, $my_query);
	$my_count		= mysqli_num_rows($my_result);

    include_once "./head.php";
?>
<body>
	<div id="app">
		<!--햄버거 클릭 메뉴-->
		<div class="global-menu">
			<a href="#" class="btn-close button-menu">
					<img src="./images/close_x_black.png" alt="">
				</a>
			<div class="user-status">
				<a href="#">MY VVV</a>
				<a href="#">LOGIN</a>
			</div>
			<div class="inner">
				<div class="list-wrap">
					<ul class="list">
						<li>
							<a href="#" class="is-active">HOME</a>
						</li>
						<li>
							<a href="#">ALL VVV</a>
						</li>
						<li>
							<a href="#">BEST</a>
						</li>
						<li>
							<a href="#">NEW</a>
						</li>
						<li>
							<a href="#">AWARDS</a>
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
		<!--햄버거 클릭 메뉴-->
		<!--검색 메뉴-->
		<div class="global-search-layer">
			<div class="bg-dark">
			</div>
			<div class="inner">
				<button type="button" class="layer-close"></button>
				<div class="search-wrapper">
					<div class="search-bar">
						<input type="text" placeholder="검색">
					</div>
					<div class="wrap sortings">
						<div class="sort-list">
							<div class="sort">
								<label for="order-date">연도</label>
								<select name="order-date" id="order-date">
										<option disabled selected>전체</option>
										<option>Slower</option>
										<option>Slow</option>
										<option>Medium</option>
										<option>Fast</option>
										<option>Faster</option>
									</select>
							</div>
							<div class="sort">
								<label for="order-nation">국가</label>
								<select name="order-nation" id="order-nation">
										<option disabled selected>전체</option>
										<option>Slower</option>
										<option>Slow</option>
										<option>Medium</option>
										<option>Fast</option>
										<option>Faster</option>
									</select>
							</div>
							<div class="sort">
								<label for="order-industry">산업군</label>
								<select name="order-industry" id="order-industry">
										<option disabled selected>전체</option>
										<option>Slower</option>
										<option>Slow</option>
										<option>Medium</option>
										<option>Fast</option>
										<option>Faster</option>
									</select>
							</div>
							<div class="sort">
								<label for="order-genre">장르</label>
								<select name="order-genre" id="order-genre">
										<option disabled selected>전체</option>
										<option>Slower</option>
										<option>Slow</option>
										<option>Medium</option>
										<option>Fast</option>
										<option>Faster</option>
									</select>
							</div>
							<div class="sort">
								<label for="order-awards">광고제</label>
								<select name="order-awards" id="order-awards">
										<option disabled selected>전체</option>
										<option>Slower</option>
										<option>Slow</option>
										<option>Medium</option>
										<option>Fast</option>
										<option>Faster</option>
									</select>
							</div>
							<div class="sort">
								<label for="order-sortby">분류</label>
								<select name="order-sortby" id="order-sortby">
										<option disabled selected>전체</option>
										<option>Slower</option>
										<option>Slow</option>
										<option>Medium</option>
										<option>Fast</option>
										<option>Faster</option>
									</select>
							</div>
						</div>
						<div class="actions">
							<button type="button" class="button-apply">
									APPLY
								</button>
							<button type="button" class="button-refresh">새로고침</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--검색 메뉴-->
		<div class="app-container sub">
			<div class="header-container">
				<header>
					<div class="inner">
						<nav id="gnb">
							<a href="javascript:void(0)" class="button-menu">
								<div class="burger-wrap">
									<span class="line top"></span>
									<span class="line mid"></span>
									<span class="line bot"></span>
								</div>
							</a>
						</nav>
						<h1>
							<a href="#" class="logo">
									<img src="./images/vvv_logo.png" alt="" class="retina">
								</a>
						</h1>
						<div class="actions">
							<div class="search-wrap magnet-wrap">
								<button type="button" class="magnet-parent button-search">
										<span class="magnet-child"></span>
									</button>
							</div>
						</div>
					</div>
				</header>
			</div>
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
											<span class="u-id">MINIVER</span>
											<a href="javascript:void(0)" class="setting">
												<img src="./images/icon_profile_setting.png" alt="">
											</a>
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
										<!--my vvv일경우-->
										<div class="f-add">
											<button type="button">친구추가</button>
										</div>
										<!--my vvv일경우-->
										<!--남의 vvv일경우-->
<!--
										<div class="follow-state">
											<a href="javascript:void(0)">팔로우하기</a>
																								<a href="javascript:void(0)" class="already">팔로우중</a>
										</div>
-->
										<!--남의 vvv일경우-->
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
										<a href="#">Favorite</a>
									</div>
									<div class="tab">
										<a href="#">Like</a>
									</div>
								</div>
								<div class="inner">
									<div class="aj-content collection is-active">
										<div class="wrapper made">
											<div class="text-block">
												<p>당신이 저장한 영상들을 컬렉션으로 만들어 보세요!</p>
											</div>
											<button type="button" class="btn-create" data-popup="#collection-add">만들기</button>
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
												</div>
											</div>
										</div>
									</div>
									<div class="aj-content favo">
										<div class="wrapper liked">
											<div class="text-block">
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
																<span class="desc">컬렉션 소유자</span>
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
																<span class="desc">컬렉션 소유자</span>
																<span class="icon-wrap">
																	<div class="like">
																		<i></i>
																		<span class="count">2</span>
																	</div>
																</span>
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
															<div class="thumbnail box-bg" style="background: url(./images/best_slider_sample.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
															<div class="thumbnail box-bg" style="background: url(./images/best_slider_sample.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
															<div class="thumbnail box-bg" style="background: url(./images/best_slider_sample.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
															<div class="thumbnail box-bg" style="background: url(./images/best_slider_sample.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
															<div class="thumbnail box-bg" style="background: url(./images/best_slider_sample.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
															<div class="thumbnail box-bg" style="background: url(./images/best_slider_sample.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
		<div class="popup my-coll-add mycollection" id="collection-add">
			<button type="button" class="popup-close" data-popup="@close"></button>
			<div class="inner">
				<div class="title">
					<h5>컬렉션 만들기</h5>
				</div>
				<div class="content">
					<div class="input-area">
						<div class="input-group">
							<div class="guide">
								<span>이름</span>
							</div>
							<div class="input">
								<input type="text" value="오준우님의 5월 컬렉션">
							</div>
						</div>
						<div class="input-group">
							<div class="guide">
								<span>설명</span>
							</div>
							<div class="input">
								<input type="text">
							</div>
						</div>
					</div>
					<div class="setting">
						<span class="secret-guide">비밀 설정</span>
						<div class="toggle secret">
							<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="secret" name="secret">
							<div class="toggle-circle"></div>
						</div>
					</div>	
					<div class="button-wrap">
						<button type="button" class="btn-light-grey" data-popup="@close">취소</button>
						<button type="button">만들기</button>
					</div>
				</div>
			</div>
		</div>
		<div class="popup my-coll-edit mycollection" id="collection-edit">
			<button type="button" class="popup-close" data-popup="@close"></button>
			<div class="inner">
				<div class="title">
					<h5>컬렉션 수정</h5>
				</div>
				<div class="content">
					<div class="input-area">
						<div class="input-group">
							<div class="guide">
								<span>이름</span>
							</div>
							<div class="input">
								<input type="text" value="오준우님의 5월 컬렉션">
							</div>
						</div>
						<div class="input-group">
							<div class="guide">
								<span>설명</span>
							</div>
							<div class="input">
								<input type="text" value="">
							</div>
						</div>
					</div>
					<div class="setting">
						<span class="secret-guide">비밀 설정</span>
						<div class="toggle secret is-active">
							<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="secret" name="secret">
							<div class="toggle-circle"></div>
						</div>
					</div>	
					<div class="button-wrap">
						<button type="button" class="btn-light-grey">컬렉션 삭제</button>
						<button type="button">수정</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
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
			if (150 < $(this).scrollTop()) {
				$('.side-nav .search-wrap').css({
					opacity: 1
				});
			} else {
				$('.side-nav .search-wrap').css({
					opacity: 0
				});
			}
		});

		//			var $wrap = $layer.parent(),
		//				$html = $('html');
		//
		//			if (!$wrap.hasClass('layer-wrap')){
		//				$layer.wrap('<div class="layer-wrap"></div>');
		//				$wrap = $layer.parent();
		//				$wrap.prepend('<span class="layer-wrap__vertical"></span>');
		//			}
		//
		//			if (!$wrap.hasClass('is-opened')){
		//				$wrap
		//					.stop().fadeIn(300, function(){
		//					$layer.trigger('afterLayerOpened', $wrap);
		//				})
		//					.addClass('is-opened');
		//			}
		//
		//			if (!$html.hasClass('layer-opened')){
		//				$html.addClass('layer-opened');
		//			}
		//
		//			$layer.trigger('layerOpened', $wrap);
	</script>
</body>

</html>