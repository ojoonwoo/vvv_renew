<?
    include_once "../include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();
    $IEYN          = $mnv_f->IECheck();
    $SafariYN          = $mnv_f->SafariCheck();
    // print_r($_SERVER["HTTP_USER_AGENT"]);
    if ($mobileYN == "PC")
    {
        echo "<script>location.href='../index.php';</script>";
    }else{
        $saveMedia     = $mnv_f->SaveMedia();
        $rs_tracking   = $mnv_f->InsertTrackingInfo($mobileYN);
	}

    include_once "./head.php";
?>
	<body>
		<div id="app">
			<div class="app-container">
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
								<a href="best_list.php" class="view-all">전체보기</a>
							</div>
							<div class="video-list">
								<div class="swiper-container best-slider">
									<div class="swiper-wrapper">
<?
    $best_query	= "SELECT * FROM video_info2 WHERE 1 AND showYN='Y' AND best_pick='Y' ORDER BY best_num ASC LIMIT 0, 6";
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
												<a href="video_detail.php?idx=<?=$best_data['video_idx']?>">
													<figure>
														<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
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
								<a href="video_list.php?sort=new" class="view-all">전체보기</a>
							</div>
							<div class="video-list">
<?
	$view_pg            = 8;
	$s_page				= 0;

	// 전체 상품 갯수
	$total_query		= "SELECT * FROM video_info2 WHERE showYN='Y'";
	$total_result		= mysqli_query($my_db, $total_query);
	$total_video_num	= mysqli_num_rows($total_result);
	$total_page			= ceil($total_video_num / $view_pg);
	
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
			
        // 브랜드 줄바꿈 방지 글자 자르기
        $brand_count    = mb_strlen($recent_data["video_brand"],'utf-8');

        if ($title_count > 30)
            $video_brand    = substr($recent_data["video_brand"],0,30)."..";
        else
            $video_brand    = $recent_data["video_brand"];
			
?>                            								
								<div class="video">
									<a href="video_detail.php?idx=<?=$recent_data['video_idx']?>">
										<figure>
											<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
											<figcaption>
												<span class="brand">[<?=$video_brand?>]</span>
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
								<input type="hidden" id="total_video_num" value="<?=$total_video_num?>">
								<input type="hidden" id="total_page" value="<?=$total_page?>">                     
								<input type="hidden" id="view_page" value="<?=$view_pg?>">                     								
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
			var video_pg 	        = 0;
			var total_video_num 	= $("#total_video_num").val();
			var total_page 			= $("#total_page").val();
			var view_page 			= $("#view_page").val();
			var current_page        = 1;

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
//					slidesPerView: 3,
//					spaceBetween: 30,
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

			// RECENT 더보기 버튼 클릭
			$doc.on('click', '.read-more', function() {
				video_pg = video_pg + Number(view_page);
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_video.php",
					data:{
						"video_pg"				: video_pg,
						"view_page"				: view_page,
						"total_video_num"		: total_video_num,
						"total_page"			: total_page,
						"sort_val"				: "new"
					},
					success: function(response){
						// console.log(response);
						// res_arr	= response.split("||");
						current_page = current_page + 1;
						if (current_page >= total_page)
							$(".read-more").hide();
						else
							$(".read-more").show();
						$("#recent_video").append(response);
					}
				});

			});
			// 검색 APPLY 클릭
			$doc.on('click', '#search-layer-submit', function() {
				var search_keyword      = nullToBlank($("#search_keyword").val());
				var search_year         = nullToBlank($("#order-date").val());
				var search_nation       = nullToBlank($("#order-nation").val());
				var search_category1    = nullToBlank($("#order-industry").val());
				var search_genre        = nullToBlank($("#order-genre").val());
				var search_prize        = nullToBlank($("#order-awards").val());
				var search_sort         = nullToBlank($("#order-sortby").val());

				location.href = "video_list.php?keyword=" + search_keyword + "&year=" + search_year + "&nation=" + search_nation + "&category=" + search_category1 + "&genre=" + search_genre + "&prize=" + search_prize + "&sort=" + search_sort;
			});

			function nullToBlank(str)
			{
				if (str == null)
					str = "";
					
				return str;
			}

			$doc.on('click', '#search-layer-refresh', function() {
				$("#search_keyword").val("");
				$("#order-date").val("");
				$("#order-nation").val("");
				$("#order-industry").val("");
				$("#order-genre").val("");
				$("#order-awards").val("");
				$("#order-sortby").val("new");        
			});

		</script>
	</body>

</html>