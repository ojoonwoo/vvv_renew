<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();
    $IEYN          = $mnv_f->IECheck();
    $SafariYN      = $mnv_f->SafariCheck();

	if ($mobileYN == "MOBILE")
    {
        echo "<script>location.href='m/index.php';</script>";
    }else{
		if (!$_SESSION['ss_media'])
			$saveMedia     = $mnv_f->SaveMedia();
        $rs_tracking   = $mnv_f->InsertTrackingInfo($mobileYN);
	}
// print_r($_SESSION);
	$pg = $_REQUEST['pg'];
	if(!$pg) $pg = 1;	// $pg가 없으면 1로 생성

    include_once "./head.php";
?>
<body>
	<div id="app">
		<div class="app-container">
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
			<a href="javascript:void(0)" id="go-top">
				<img src="./images/go_top.png" alt="go top">
			</a>
			<form name="frm_execute" method="GET" action="index.php#recent_container">
				<input type="hidden" name="pg" value="<?=$pg?>">
			</form>
			<div class="main-container">
				<div class="content main">
					<a class="mini-banner" href="http://www.valuable-viral-video.com/my_vvv.php?idx=48">
						<h5><b>바큐 매니저</b>의 <b>큐레이팅</b>을 확인해보세요 ! <img src="./images/mini_banner_arrow.svg" alt=""></h5>
					</a>
					<div class="main-banner swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide _01">
								<a href="javascript:void(0)">
<!--								<a href="video_detail.php?idx=448">-->
									<figure class="box-content">
										<div class="img box-bg">
											<img src="./images/main_banner_01_img.jpg" alt="">
										</div>
										<figcaption>
<!--
											<p class="brand">CANNES 2017 Grand Prix</p>
											<p class="title">we're the superhumans</p>
											<div class="link">
												<svg class="progress-current" data-mouse-type="text" data-text="view">
													<circle class="prg-circle" cx="30" cy="30" r="27.5" fill="none" />
													<polygon points="23,19 41,29 23,39"
															style="fill:#f7dd30;"/>
												</svg>
											</div>
-->
											<p class="txt1"><b>V</b>ALUABLE <b>V</b>IRAL <b>V</b>IDEO</p>
											<p class="txt2">좋아하는 광고를 모으기에<br>더할 나위 없이 좋은 곳.</p>
											<p class="txt3"><img src="./images/main_banner_01_icons.png" alt=""></p>
											<p class="txt4">책갈피 이모티콘을 활용해보세요.<br>컬렉션 기능으로 프로젝트별로 편리하게 구분하여 저장됩니다.</p>
										</figcaption>
									</figure>
								</a>
							</div>
							<div class="swiper-slide _02">
								<a href="javascript:void(0)">
<!--								<a href="video_detail.php?idx=438">-->
									<figure class="box-content">
										<div class="img box-bg">
											<img src="./images/main_banner_02_img.jpg" alt="">
										</div>
										<figcaption>
<!--
											<p class="brand">NEWYORK 2017 BEST OF SHOW</p>
											<p class="title">MEET GRAHAM</p>
											<div class="link">
												<svg class="progress-current" data-mouse-type="text" data-text="view">
													<circle class="prg-circle" cx="30" cy="30" r="27.5" fill="none" />
													<polygon points="23,19 41,29 23,39"
															style="fill:#f7dd30;"/>
												</svg>
											</div>
-->
											<p class="txt1">혼자 보관하거나, 함께 공유하거나</p>
											<p class="txt2">공개 / 비공개 설정으로<br>모아놓은 컬렉션을 자유롭게 보관하거나 공유하세요.</p>
										</figcaption>
									</figure>
								</a>
							</div>
							<div class="swiper-slide _03">
								<a href="award_list.php">
									<figure class="box-content">
										<div class="img box-bg">
											<img src="./images/main_banner_03_img.jpg" alt="">
										</div>
										<figcaption>
<!--
											<p class="brand">CLIO 2017 Grand</p>
											<p class="title">fearless girl</p>
-->
											<p class="txt1">해외광고제 수상작을 한 곳에 VVV</p>
											<p class="txt2">해외3대 광고제 수상작 영상을 연도별로 모았습니다.<br>검색카테고리 광고제 수상작을 확인해보세요.</p>
											<div class="link">
												<svg class="progress-current" data-mouse-type="text" data-text="view">
													<circle class="prg-circle" cx="30" cy="30" r="27.5" fill="none" />
													<polygon points="23,19 41,29 23,39"
															style="fill:#f7dd30;"/>
												</svg>
												<span class="view">VIEW</span>
											</div>
										</figcaption>
									</figure>
								</a>
							</div>
						</div>
						<div class="number-pagination">
							<div class="button-prev" data-mouse-type="ripple"></div>
							<span class="current">1</span>
							<div class="button-next" data-mouse-type="ripple"></div>
						</div>
						<div id="main-banner-pagination" class="main-banner-pagination"></div>
					</div>
					<div class="list-container best-area">
						<div class="title-area">
							<h2 class="list-title">Editor's PICK</h2>
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

        // $title_count    = mb_strlen($best_data["video_title"],'utf-8');

        // if ($title_count > 45)
        //     $video_title    = substr($best_data["video_title"],0,45)."...";
        // else
        //     $video_title    = $best_data["video_title"];
?>                                    
									<div class="swiper-slide">
										<div class="video">
											<a href="video_detail.php?idx=<?=$best_data['video_idx']?>">
												<figure>
													<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
														<!-- <img src="<?=$yt_thumb?>" alt=""> -->
													</div>
													<figcaption>
														<span class="brand">[<?=$best_data["video_brand"]?>]</span>
														<span class="title"><?=$best_data["video_title"]?></span>
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
								<div class="button-next" data-mouse-type="ripple"></div>
								<div class="button-prev" data-mouse-type="ripple"></div>
							</div>
						</div>
					</div>
					<div class="list-container" id="recent_container">
						<div class="title-area">
							<h2 class="list-title">NEW</h2>
							<a href="video_list.php?sort=new" class="view-all">전체보기</a>
						</div>
						<div class="video-list" id="recent_video">
<?
	$view_pg            = 16;
	$block_size 		= 9;	// 한 화면에 나타낼 페이지 번호 개수
	$s_page				= 0;

	// 전체 상품 갯수
	$total_query		= "SELECT * FROM video_info2 WHERE showYN='Y'";
	$total_result		= mysqli_query($my_db, $total_query);
	$total_video_num	= mysqli_num_rows($total_result);
	$total_page			= ceil($total_video_num / $view_pg);
	
	$PAGE_CLASS = new mnv_page($pg,$total_video_num,$view_pg,$block_size);
	$BLOCK_LIST = $PAGE_CLASS->blockList6();
	$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
							
//	$recent_query	= "SELECT * FROM video_info2 WHERE 1 AND showYN='Y' ORDER BY video_date DESC LIMIT 0, $view_pg";
	$recent_query	= "SELECT * FROM video_info2 WHERE 1 AND showYN='Y' ORDER BY video_date DESC LIMIT $PAGE_CLASS->page_start, $view_pg";
    $recent_result 	= mysqli_query($my_db, $recent_query);
							
							
    while ($recent_data = mysqli_fetch_array($recent_result))
    {    
        // 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $recent_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

		// $title_count    = mb_strlen($recent_data["video_title"],'utf-8');
//		$title_count    = mb_strlen(iconv('UTF-8','CP949',$recent_data["video_title"]));
//
//		if ($title_count > 30)
//            $video_title    = substr($recent_data["video_title"],0,30)."...";
//        else
//			$video_title    = $recent_data["video_title"];
//			
//        // 브랜드 줄바꿈 방지 글자 자르기
//        $brand_count    = mb_strlen($recent_data["video_brand"],'utf-8');
//
//        if ($title_count > 30)
//            $video_brand    = substr($recent_data["video_brand"],0,30)."..";
//        else
//            $video_brand    = $recent_data["video_brand"];
		
		$video_title    = $recent_data["video_title"];
		$video_brand    = $recent_data["video_brand"];
			
?>                            
							<div class="video col-lg-4 col-md-3 col-sm-2">
								<a href="video_detail.php?idx=<?=$recent_data['video_idx']?>">
									<figure>
                                        <div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52%;"></div>
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
<!--
						<button type="button" class="read-more">
							<img src="./images/plus_icon.png" alt="">
						</button>
-->
						<?php echo $BLOCK_LIST?>
					</div>
				</div>
			</div>
<? include_once "footer_layer.php"; ?>
		</div>
<?
	include_once "cursor.php";
?>
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
				delay: 4500	
			},
			pagination: {
				el: '.main-banner-pagination',
				type: 'progressbar',
//				clickable: true,
//				renderBullet: function (index, className) {
//					return '<span class="' + className + '">' + (index + 1) + '</span>';
//				},
			},
			navigation: {
				prevEl: '.button-prev',
				nextEl: '.button-next'
			},
			on: {
				init: function() {
					$('.main-banner').addClass('loaded');
				},
				slideChange: function() {
					$('.number-pagination .current').text(this.realIndex+1);
				},
				slideChangeTransitionStart: function() {
					$('.main-banner').removeClass('loaded');
				},
				slideChangeTransitionEnd: function() {
					$('.main-banner').addClass('loaded');
				}
			}
		})
		//initialize swiper when document ready
		var bestSwiper = new Swiper ('.best-slider', {
			// Optional parameters
			direction: 'horizontal',
			loop: true,
			slidesPerView: 3,
			slidesPerGroup: 3,
			loopFillGroupWithBlank: true,
			spaceBetween: 30,
			touchAngle: 75,
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
		$('#order-sortby').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
		$('#submit_nation').selectmenu({
			create: function(event,ui) {
				$("#submit_nation-button").css("border","0");
				$("#submit_nation-button").css("border-bottom","1px solid #333333");
			}
		}).selectmenu('menuWidget').addClass( "overflow" );
		$('#submit_category').selectmenu({
			create: function(event,ui) {
				$("#submit_category-button").css("border","0");
				$("#submit_category-button").css("border-bottom","1px solid #333333");
			}
		}).selectmenu('menuWidget').addClass( "overflow" );
		$('#submit_genre').selectmenu({
			create: function(event,ui) {
				$("#submit_genre-button").css("border","0");
				$("#submit_genre-button").css("border-bottom","1px solid #333333");
			}
		}).selectmenu('menuWidget').addClass( "overflow" );
		$('#submit_year_regdate').selectmenu({
			create: function(event,ui) {
				$("#submit_year_regdate-button").css("border","0");
				$("#submit_year_regdate-button").css("border-bottom","1px solid #333333");
			}
		}).selectmenu('menuWidget').addClass( "overflow" );
		$('#submit_month_regdate').selectmenu({
			create: function(event,ui) {
				$("#submit_month_regdate-button").css("border","0");
				$("#submit_month_regdate-button").css("border-bottom","1px solid #333333");
			}
		}).selectmenu('menuWidget').addClass( "overflow" );
	});
	
//	기본 기능 테스트 코드
	$doc = $(document);

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
				$("#recent_video > .video.loaded").each(function(index) {
					(function(that, i) { 
						var t = setTimeout(function() { 
							$(that).removeClass('loaded');
						}, 100 * i);
					})(this, index);

				});
			}
		});
	});
	
	
	// vue code 
//	var app = new Vue({
//		el: '#app',
//		data: {
//			message: 'vvv vue test'
//		},
//		created: function() {
////			console.log(this.message);
//			console.log("created");
//		},
//		mounted: function() {
//			console.log('mounted')
//		}
//	});
	
	function pageRun(num)
	{
		f = document.frm_execute;
		f.pg.value = num;
		f.submit();
	}
</script>
</body>

</html>