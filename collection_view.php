<?
    include_once "./include/autoload.php";

    $mnv_f			= new mnv_function();
    $my_db         	= $mnv_f->Connect_MySQL();
    $mobileYN      	= $mnv_f->MobileCheck();
	
	$collection_idx		= $_REQUEST["idx"];

	// 컬렉션 정보 가져오기
	$collection_query		= "SELECT * FROM collection_info WHERE idx='".$collection_idx."'";
	$collection_result		= mysqli_query($my_db, $collection_query);
	$collection_data		= mysqli_fetch_array($collection_result);

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
										<div class="wrap-user">
											<div class="user-id">
												<span class="u-id">MINIVER</span>
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
							<div class="collection-detail">
								<div class="collection-info">
									<div class="texts">
										<span class="title">해외 광고</span>
										<span class="summary">서브 텍스트입니다</span>
									</div>
									<div class="counts">
										<span class="wrap">
											<i class="icon video"></i>
											<span class="count">100</span>
										</span>
										<span class="wrap">
											<i class="icon follow"></i>
											<span class="count">1</span>
										</span>
									</div>
									<div class="action-wrap">
										<div class="inner">
											<button type="button" data-popup="#collection-edit">수정</button>
											<button type="button" onclick="location.href='my_vvv_collection_addvideo.html'">추가</button>
											<button type="button" data-mode-change="delete">삭제</button>
										</div>
									</div>
								</div>
								<div class="semi-container">
									<div class="wrapper">
										<div class="inner">
											<!-- <div class="content-empty">
												<a href="#">
													<span>+</span>
													<span>당신이 좋아한 영상으로 컬렉션을 만들어보세요</span>
												</a>
											</div> -->

											<div class="list-container">
												<div class="video-list">
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="#">
															<figure>
																<div class="check-layer">
																	<input type="checkbox">
																	<div class="checkbox"></div>
																</div>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
																</div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting copy 4</span>
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
																<div class="check-layer">
																	<input type="checkbox">
																	<div class="checkbox"></div>
																</div>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
																</div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting copy 4</span>
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
																<div class="check-layer">
																	<input type="checkbox">
																	<div class="checkbox"></div>
																</div>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
																</div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting copy 4</span>
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
																<div class="check-layer">
																	<input type="checkbox">
																	<div class="checkbox"></div>
																</div>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
																</div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting copy 4</span>
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
																<div class="check-layer">
																	<input type="checkbox">
																	<div class="checkbox"></div>
																</div>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
																</div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting copy 4</span>
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
																<div class="check-layer">
																	<input type="checkbox">
																	<div class="checkbox"></div>
																</div>
																<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
																</div>
																<figcaption>
																	<span class="brand">[UNICEF]</span>
																	<span class="title">Furniture That Hides From Hurting copy 4</span>
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
									<input type="text" placeholder="오준우님의 5월 컬렉션">
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
							<button type="button" class="btn-light-grey" data-popup="@close">취소</button>
							<button type="button">수정</button>
						</div>
					</div>
				</div>
			</div>
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

			
			//프론트 임시 샘플코드
			$doc.on('click', '[data-mode-change]', function() {
				var mode = $(this).data('mode-change');
				if(!$('.list-container').hasClass('delete-mode')) {
					//삭제 모드로 변경
					$(this).text('완료');
				} else {
					//삭제 코드
					//삭제 --
					//삭제 완료
					$(this).text('삭제');
				}
				$('.list-container').toggleClass('delete-mode');
			});
		</script>
	</body>

</html>