<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();
    $IEYN          = $mnv_f->IECheck();
    $SafariYN          = $mnv_f->SafariCheck();
    // print_r($_SERVER["HTTP_USER_AGENT"]);
    if ($mobileYN == "MOBILE")
    {
        echo "<script>location.href='m/index.php';</script>";
    }else{
        $saveMedia     = $mnv_f->SaveMedia();
        $rs_tracking   = $mnv_f->InsertTrackingInfo($mobileYN);
    }

    include_once "./head.php";
?>
<body>
	<div id="app">
		<div class="app-container">
			<div class="side-nav">
				<div class="search-wrap magnet-wrap">
					<button type="button" class="magnet-parent">
						<span class="magnet-child"></span>
					</button>
				</div>
				<nav id="gnb">
					<div class="burger-wrap">
						<span class="line top"></span>
						<span class="line mid"></span>
						<span class="line bot"></span>
					</div>
				</nav>
				<div class="direct-my-v">
					<a href="#">
						<span>MY VVV</span>
					</a>
				</div>
			</div>
			<div class="header-container">
				<header>
					<div class="inner">
						<h1>
							<a href="#" class="logo">
								<img src="./images/vvv_logo.png" alt="" class="retina">
							</a>
						</h1>
						<div class="actions">
							<div class="user-status">
								<a href="#">LOGIN</a>
							</div>
							<div class="search-wrap magnet-wrap">
								<button type="button" class="magnet-parent">
									<span class="magnet-child"></span>
								</button>
							</div>
						</div>
					</div>
				</header>
			</div>
			<div class="main-container">
				<div class="content main">
					<div class="main-banner swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<a href="">
									<figure class="box-content">
										<div class="img box-bg">
											<img src="./images/main_banner_01.jpg" alt="">
										</div>
										<figcaption>
											<p class="brand">ADEPOL SC</p>
											<p class="title">We Understand Your Surffering</p>
											<p class="summary">우리는 당신의 고통을 진심으로 이해합니다</p>
										</figcaption>
									</figure>
								</a>
							</div>
						</div>
					</div>
					<div class="list-container best-area">
						<div class="title-area">
							<h2 class="list-title">BEST</h2>
							<a href="#" class="view-all">전체보기</a>
						</div>
						<div class="video-list">
							<div class="swiper-container best-slider">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="video">
											<a href="#">
												<figure>
													<div class="thumbnail box-bg">
														<img src="./images/main_slide_thumb.jpg" alt="">
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
									<div class="swiper-slide">
										<div class="video">
											<a href="#">
												<figure>
													<div class="thumbnail box-bg">
														<img src="./images/main_slide_thumb.jpg" alt="">
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
									<div class="swiper-slide">
										<div class="video">
											<a href="#">
												<figure>
													<div class="thumbnail box-bg">
														<img src="./images/main_slide_thumb.jpg" alt="">
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
								</div>
								<!-- Add Arrows -->
								<div class="button-next"></div>
								<div class="button-prev"></div>
							</div>
						</div>
					</div>
					<div class="list-container">
						<div class="title-area">
							<h2 class="list-title">RECENT</h2>
							<a href="#" class="view-all">전체보기</a>
						</div>
						<div class="video-list">
							<div class="video col-lg-4 col-md-3 col-sm-2">
								<a href="#">
									<figure>
										<div class="thumbnail box-bg">
											<img src="./images/main_slide_thumb.jpg" alt="">
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
							<div class="video col-lg-4 col-md-3 col-sm-2">
								<a href="#">
									<figure>
										<div class="thumbnail box-bg">
											<img src="./images/main_slide_thumb.jpg" alt="">
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
							<div class="video col-lg-4 col-md-3 col-sm-2">
								<a href="#">
									<figure>
										<div class="thumbnail box-bg">
											<img src="./images/main_slide_thumb.jpg" alt="">
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
							<div class="video col-lg-4 col-md-3 col-sm-2">
								<a href="#">
									<figure>
										<div class="thumbnail box-bg">
											<img src="./images/main_slide_thumb.jpg" alt="">
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
						<button type="button" class="read-more"></button>
					</div>
				</div>
			</div>
		</div>
		<div id="cursor" class="defualt"></div>
	</div>
<script>
	$(document).ready(function () {
		//initialize swiper when document ready
		var BestSwiper = new Swiper ('.best-slider', {
			// Optional parameters
			direction: 'horizontal',
			loop: true,
			slidesPerView: 3,
			spaceBetween: 30,
			navigation: {
				nextEl: '.button-next',
				prevEl: '.button-prev',
			},
			breakpoints: {
				// when window width is <= 320px
				320: {
					slidesPerView: 1,
					spaceBetween: 10
				},
				// when window width is <= 480px
				800: {
					slidesPerView: 2,
					spaceBetween: 20
				},
				// when window width is <= 640px
				1400: {
					slidesPerView: 3,
					spaceBetween: 30
				}
			}
		})
	});
</script>
</body>

</html>