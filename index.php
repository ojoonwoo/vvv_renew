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
					<a href="">
						<div class="burger-wrap">
								<span class="line top"></span>
								<span class="line mid"></span>
								<span class="line bot"></span>
						</div>
					</a>
				</nav>
				<div class="direct-my-v">
					<a href="#">
						<span>MY VVV</span>
					</a>
				</div>
			</div>
			<!--햄버거 클릭 메뉴-->
			<div class="global-menu">
				<div class="inner">
					<div class="list-wrap">
						<ul class="list">
							<li>
								<a href="#" class="is-active">HOME</a>
							</li>
						</ul>
						<ul class="list">
							<li>
								<a href="#">ALL VVV</a>
							</li>
							<li>
								<a href="#">BEST</a>
							</li>
							<li>
								<a href="#">NEW</a>
							</li>
						</ul>
						<ul class="list">
							<li>
								<a href="#">AWARDS</a>
							</li>
						</ul>
					</div>
					<div class="about-us">
						<div class="logo">
							<img src="./images/vvv_logo.png" alt="">
						</div>
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
					<div class="inner">
						<div class="search-wrapper">
							<div class="wrap">
								<button type="button" class="button-refresh">새로고침</button>
								<div class="search-bar">
									<input type="text">
								</div>
							</div>
							<div class="wrap sortings">
								<div class="sort-list">
									<div class="row">
										<div class="sort">
											<select name="order-date" id="order-date">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="order-nation" id="order-nation">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="order-industry" id="order-industry">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="sort">
											<select name="order-genre" id="order-genre">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="order-awards" id="order-awards">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="order-sortby" id="order-sortby">
												<option disabled selected>Please pick one</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
									</div>
								</div>
								<button type="button" class="button-apply">
									APPLY
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--검색 메뉴-->
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
							<div class="swiper-slide">
								<a href="">
									<figure class="box-content">
										<div class="img box-bg">
											<img src="./images/main_banner_01.jpg" alt="">
										</div>
										<figcaption>
											<p class="brand">MINIVERTISING</p>
											<p class="title">2번 슬라이드</p>
											<p class="summary">우리는 당신의 고통을 진심으로 이해합니다</p>
										</figcaption>
									</figure>
								</a>
							</div>
							<div class="swiper-slide">
								<a href="">
									<figure class="box-content">
										<div class="img box-bg">
											<img src="./images/main_banner_01.jpg" alt="">
										</div>
										<figcaption>
											<p class="brand">MINIVERTISING</p>
											<p class="title">3번 슬라이드</p>
											<p class="summary">우리는 당신의 고통을 진심으로 이해합니다</p>
										</figcaption>
									</figure>
								</a>
							</div>
						</div>
						<div id="main-banner-pagination" class="main-banner-pagination"></div>
					</div>
					<div class="list-container best-area">
						<div class="title-area">
							<h2 class="list-title">BEST</h2>
							<a href="#" class="view-all">전체보기</a>
						</div>
						<div class="video-list">
							<div class="swiper-container best-slider">
								<div class="swiper-wrapper">
<?
    $best_query	= "SELECT * FROM video_info2 WHERE 1 AND showYN='Y' ORDER BY like_count DESC, collect_count DESC, play_count DESC LIMIT 0, 6";
    $best_result 	= mysqli_query($my_db, $best_query);
    while ($best_data = mysqli_fetch_array($best_result))
    {    
        // 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $best_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

        $title_count    = mb_strlen($best_data["video_title"],'utf-8');

        if ($title_count > 45)
            $video_title    = substr($best_data["video_title"],0,45)."...";
        else
            $video_title    = $best_data["video_title"];
?>                            
                                    
									<div class="swiper-slide">
										<div class="video">
											<a href="#">
												<figure>
													<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
														<!-- <img src="<?=$yt_thumb?>" alt=""> -->
													</div>
													<figcaption>
														<span class="brand">[<?=$best_data["video_brand"]?>]</span>
														<span class="title"><?=$video_title?></span>
														<span class="icon-wrap">
															<span class="play">
																<i class="icon"></i>
																<span class="cnt"><?=$best_data["play_count"]?></span>
															</span>
															<span class="comment">
																<i class="icon"></i>
																<span class="cnt"><?=$best_data["comment_count"]?></span>
															</span>
															<span class="like">
																<i class="icon"></i>
																<span class="cnt"><?=$best_data["like_count"]?></span>
															</span>
															<span class="collect">
																<i class="icon"></i>
																<span class="cnt"><?=$best_data["collect_count"]?></span>
															</span>
														</span>
													</figcaption>
												</figure>
											</a>
										</div>
                                    </div>
<?
    }
?>                                                                
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
<?
    $recent_query	= "SELECT * FROM video_info2 WHERE 1 AND showYN='Y' ORDER BY idx DESC LIMIT 0, 8";
    $recent_result 	= mysqli_query($my_db, $recent_query);
    while ($recent_data = mysqli_fetch_array($recent_result))
    {    
        // 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $recent_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

        $title_count    = mb_strlen($recent_data["video_title"],'utf-8');

        if ($title_count > 30)
            $video_title    = substr($recent_data["video_title"],0,30)."...";
        else
            $video_title    = $recent_data["video_title"];
?>                            
							<div class="video col-lg-4 col-md-3 col-sm-2">
								<a href="#">
									<figure>
                                        <div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
										<figcaption>
											<span class="brand">[<?=$recent_data["video_brand"]?>]</span>
											<span class="title"><?=$video_title?></span>
											<span class="icon-wrap">
												<span class="play">
													<i class="icon"></i>
													<span class="cnt"><?=$recent_data["play_count"]?></span>
												</span>
												<span class="comment">
													<i class="icon"></i>
													<span class="cnt"><?=$recent_data["comment_count"]?></span>
												</span>
												<span class="like">
													<i class="icon"></i>
													<span class="cnt"><?=$recent_data["like_count"]?></span>
												</span>
												<span class="collect">
													<i class="icon"></i>
													<span class="cnt"><?=$recent_data["collect_count"]?></span>
												</span>
											</span>
										</figcaption>
									</figure>
								</a>
                            </div>
<?
    }
?>                            
						</div>
						<button type="button" class="read-more">
							<img src="./images/plus_icon.png" alt="">
						</button>
					</div>
				</div>
			</div>
		</div>
		<div id="cursor" class="defualt"></div>
	</div>
<script>
	$(document).ready(function () {
		var bannerSwiper = new Swiper ('.main-banner', {
			// Optional parameters
			direction: 'horizontal',
			effect: 'fade',
			speed: 650,
			loop: true,
			autoplay: {
				delay: 4000	
			},
			pagination: {
				el: '.main-banner-pagination',
				clickable: true,
				renderBullet: function (index, className) {
					return '<span class="' + className + '">' + (index + 1) + '</span>';
				},
			},
		})
		//initialize swiper when document ready
		var bestSwiper = new Swiper ('.best-slider', {
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
				500: {
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
	$(function() {
//		$('.global-search-layer .sort').each(function() {
//			$(this).selectmenu();
//		});
		$('#order-date').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
		$('#order-nation').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
		$('#order-industry').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
		$('#order-genre').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
		$('#order-awards').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
		$('#order-sortby').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
	});
</script>
</body>

</html>