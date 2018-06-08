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
												<img src="./images/cannes_m.png" alt="">
											</div>
											<figcaption>
												<p class="brand">CANNES 2017 Grand Prix</p>
												<!--													<p class="award-summ">2017 Grand Prix</p>-->
												<p class="title">we're the superhumans</p>
												<a href="video_detail.php?idx=448">
													<div class="link">
														<svg class="progress-current">
															<circle class="prg-circle" cx="15" cy="15" r="14" fill="none" />
															<polygon points="11,10 21,15 11,20"
																	style="fill:#f7dd30;"/>
														</svg>
														<span class="view">VIEW</span>
													</div>
												</a>
											</figcaption>
										</figure>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="">
										<figure class="box-content">
											<div class="img box-bg">
												<img src="./images/newyork_m.png" alt="">
											</div>
											<figcaption>
												<p class="brand">NEWYORK 2017 BEST OF SHOW</p>
												<!--													<p class="award-summ">2017 BEST OF SHOW</p>-->
												<p class="title">MEET GRAHAM</p>
												<a href="video_detail.php?idx=438">
													<div class="link">
														<svg class="progress-current">
															<circle class="prg-circle" cx="15" cy="15" r="14" fill="none" />
															<polygon points="11,10 21,15 11,20"
																	style="fill:#f7dd30;"/>
														</svg>
														<span class="view">VIEW</span>
													</div>
												</a>
											</figcaption>
										</figure>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="">
										<figure class="box-content">
											<div class="img box-bg">
												<img src="./images/clio_m.png" alt="">
											</div>
											<figcaption>
												<p class="brand">CLIO 2017 Grand</p>
												<!--													<p class="award-summ">2017 Grand</p>-->
												<p class="title">fearless girl</p>
												<a href="video_detail.php?idx=823">
													<div class="link">
														<svg class="progress-current">
															<circle class="prg-circle" cx="15" cy="15" r="14" fill="none" />
															<polygon points="11,10 21,15 11,20"
																	style="fill:#f7dd30;"/>
														</svg>
														<span class="view">VIEW</span>
													</div>
												</a>
											</figcaption>
										</figure>
									</a>
								</div>
							</div>
							<div class="number-pagination">
								<span class="current">1</span>
								<span class="total">3</span>
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
								<h2 class="list-title">NEW</h2>
								<a href="video_list.php?sort=new" class="view-all">전체보기</a>
							</div>
							<div class="video-list" id="recent_video">
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

//        if ($title_count > 30)
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
			<div class="popup send-mail" id="send-mail">
				<button type="button" class="popup-close" data-popup="@close"></button>
				<div class="inner">
					<div class="title">
						<i></i><span>CONTACT US</span>
					</div>
					<div class="content">
						<div class="input-wrap">
							<div class="input-group">
								<div class="guide">Name</div>
								<div class="input">
									<input type="text">
								</div>
							</div>
							<div class="input-group">
								<div class="guide">E-mail</div>
								<div class="input">
									<input type="text">
								</div>
							</div>
							<div class="input-group">
								<div class="guide">Comment</div>
								<div class="input">
									<textarea name="" id="" cols="30" rows="10"></textarea>
								</div>
							</div>
						</div>
						<button type="button" class="btn-send">보내기</button>
					</div>
				</div>
			</div>
			<? 	include_once "cursor.php"; ?>
		</div>
		<script>
			var video_pg 	        = 0;
			var total_video_num 	= $("#total_video_num").val();
			var total_page 			= $("#total_page").val();
			var view_page 			= $("#view_page").val();
			var current_page        = 1;
			
			$doc = $(document);

			$doc.ready(function () {
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
						type: 'progressbar',
//						clickable: true,
//						renderBullet: function (index, className) {
//							return '<span class="' + className + '">' + (index + 1) + '</span>';
//						},
					},
					//					disableOnInteraction: false,
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
					speed: 600,
					loop: true,
//					effect: 'coverflow',
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
								}, 500 * i);
							})(this, index);
							
						});
						
					}
				});

			});
			// 검색 APPLY 클릭
			$doc.on('click', '#search-layer-submit', function() {
				console.log("search");
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