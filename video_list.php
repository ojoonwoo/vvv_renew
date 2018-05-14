<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();

	// if ($mobileYN == "MOBILE")
    // {
    //     echo "<script>location.href='m/index.php';</script>";
    // }

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
					<div class="content vid-list">
						<div class="inner">
							<!--검색 영역-->
							<div class="search-wrapper">
								<div class="wrap">
									<div class="search-bar">
										<input type="text">
									</div>
									<button type="button" class="button-refresh">새로고침</button>
								</div>
								<div class="wrap sortings">
									<div class="sort-list">
										<div class="sort">
											<select name="lc-order-date" id="lc-order-date">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-nation" id="lc-order-nation">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-industry" id="lc-order-industry">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-genre" id="lc-order-genre">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-awards" id="lc-order-awards">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-sortby" id="lc-order-sortby">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
									</div>
									<button type="button" class="button-apply">
										APPLY
									</button>
								</div>
							</div>
							<!--검색 영역-->
							<div class="list-container">
								<div class="video-list">
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="#">
											<figure>
												<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
			<div id="cursor" class="defualt"></div>
		</div>
		<script>
			$(function() {
				//		$('.global-search-layer .sort').each(function() {
				//			$(this).selectmenu();
				//		});
//				global search
				$('#order-date').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-nation').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-industry').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-genre').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-awards').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-sortby').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				
//				local search
				$('#lc-order-date').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#lc-order-nation').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#lc-order-industry').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#lc-order-genre').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#lc-order-awards').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#lc-order-sortby').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
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