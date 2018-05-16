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
					<div class="content awards">
						<div class="inner">
							<div class="awards-banner">
								<div class="banner _01 is-active">
									<a href="javascript:void(0)" onmouseover="bannerResizing(1, this)">
										<figure>
<!--
											<div class="img box-bg">
												<img src="./images/award_01_off.png" alt="">
											</div>
-->
											<figcaption>

											</figcaption>
										</figure>
									</a>
								</div>
								<div class="banner _02">
									<a href="javascript:void(0)" onmouseover="bannerResizing(2, this)">
										<figure>
<!--
											<div class="img box-bg">
												<img src="./images/award_02_off.png" alt="">
											</div>
-->
											<figcaption>

											</figcaption>
										</figure>
									</a>
								</div>
								<div class="banner _03">
									<a href="javascript:void(0)" onmouseover="bannerResizing(3, this)">
										<figure>
<!--
											<div class="img box-bg">
												<img src="./images/award_03_off.png" alt="">
											</div>
-->
											<figcaption>

											</figcaption>
										</figure>
									</a>
								</div>
							</div>
							<div class="cate-wrap">
								<div class="main-cate">
									<ul>
										<li>
											<a href="javascript:sel_award(2)" class="award_name _2 is-active">NEWYORK</a>
										</li>
										<li>
											<a href="javascript:sel_award(3)" class="award_name _3">CANNES</a>
										</li>
										<li>
											<a href="javascript:sel_award(1)" class="award_name _1">CLIO</a>
										</li>
									</ul>
								</div>
								<div class="sub-cate">
									<ul class="award _3" style="display:none;">
										<li>
											<a href="javascript:sel_award(2)" class="is-active">ALL</a>
										</li>
										<li>
											<a href="">Grand</a>
										</li>
										<li>
											<a href="">Gold</a>
										</li>
										<li>
											<a href="">Silver</a>
										</li>
									</ul>
									<ul class="award _2">
										<li>
											<a href="javascript:sel_award(2)" class="is-active">ALL</a>
										</li>
										<li>
											<a href="">Best</a>
										</li>
										<li>
											<a href="">Grand</a>
										</li>
										<li>
											<a href="">First</a>
										</li>
										<li>
											<a href="">Second</a>
										</li>
										<li>
											<a href="">Third</a>
										</li>
									</ul>
									<ul class="award _1" style="display:none;">
										<li>
											<a href="javascript:sel_award(2)" class="is-active">ALL</a>
										</li>
										<li>
											<a href="">Grand</a>
										</li>
										<li>
											<a href="">Hall of Fame</a>
										</li>
										<li>
											<a href="">Gold</a>
										</li>
										<li>
											<a href="">Silver</a>
										</li>
										<li>
											<a href="">Bronze</a>
										</li>
										<li>
											<a href="">Shortlist</a>
										</li>
									</ul>
								</div>
							</div>
							<div>
								<ul>
									<li><a href="">2017</a></li>
									<li><a href="">2016</a></li>
									<li><a href="">2015</a></li>
								</ul>
							</div>
							<div class="list-container">
								<div class="video-list">
<?
    $award_query	= "SELECT * FROM awards_list_info WHERE 1 AND awards_name='1' AND awards_winner_year='2017' GROUP BY video_idx";
	$award_result 	= mysqli_query($my_db, $award_query);
	
	$i = 0;
    while ($award_data = mysqli_fetch_array($award_result))
    {    
		if ($i % 2 == 0)
		{
			// 짝수 배열
			$award_even_list_array[$i] = $award_data;
		}else{
			// 홀수 배열
			$award_odd_list_array[$i] = $award_data;
		}
		$i++;
	}
?>										
									<div class="column">
<?
	foreach($award_even_list_array as $key => $val)
	{
		$video_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$val["video_idx"]."'";
		$video_result 	= mysqli_query($my_db, $video_query);
		$video_data		= mysqli_fetch_array($video_result);

		// 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $video_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

        $title_count    = mb_strlen($video_data["video_title"],'utf-8');

        if ($title_count > 45)
            $video_title    = substr($video_data["video_title"],0,45)."...";
        else
			$video_title    = $video_data["video_title"];
?>										
										<div class="video">
											<a href="#">
												<figure>
													<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
													<figcaption>
														<span class="brand">[<?=$video_data["video_brand"]?>]</span>
														<span class="title"><?=$video_data["video_title"]?></span>
														<span class="icon-wrap">
															<span class="play">
																<i class="icon"></i>
																<span class="cnt"><?=$video_data["play_count"]?></span>
															</span>
															<span class="comment">
																<i class="icon"></i>
																<span class="cnt"><?=$video_data["comment_count"]?></span>
															</span>
															<span class="like">
																<i class="icon"></i>
																<span class="cnt"><?=$video_data["like_count"]?></span>
															</span>
															<span class="collect">
																<i class="icon"></i>
																<span class="cnt"><?=$video_data["collect_count"]?></span>
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
									<div class="column right">
<?
	foreach($award_odd_list_array as $key => $val)
	{
		$video_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$val["video_idx"]."'";
		$video_result 	= mysqli_query($my_db, $video_query);
		$video_data		= mysqli_fetch_array($video_result);

		// 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $video_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

        $title_count    = mb_strlen($video_data["video_title"],'utf-8');

        if ($title_count > 45)
            $video_title    = substr($video_data["video_title"],0,45)."...";
        else
			$video_title    = $video_data["video_title"];
?>										
										<div class="video">
											<a href="#">
												<figure>
													<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
													<figcaption>
														<span class="brand">[<?=$video_data["video_brand"]?>]</span>
														<span class="title"><?=$video_data["video_title"]?></span>
														<span class="icon-wrap">
															<span class="play">
																<i class="icon"></i>
																<span class="cnt"><?=$video_data["play_count"]?></span>
															</span>
															<span class="comment">
																<i class="icon"></i>
																<span class="cnt"><?=$video_data["comment_count"]?></span>
															</span>
															<span class="like">
																<i class="icon"></i>
																<span class="cnt"><?=$video_data["like_count"]?></span>
															</span>
															<span class="collect">
																<i class="icon"></i>
																<span class="cnt"><?=$video_data["collect_count"]?></span>
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
								</div>
								<!-- <button type="button" class="read-more">
									<img src="./images/plus_icon.png" alt="">
								</button> -->
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
			$win.on('load', function() {
				bannerResizing(1, $('.banner._01').find('a'));
			});
			function bannerResizing(idx, el) {
				var $me = $(el).parent();
				$me.addClass('is-active');
				$('.awards-banner .banner').not($me).removeClass('is-active');
//				var $notMe = $('.banner').each(function() {
//					
//				});
				
				switch (idx) {
					case 1:
						$me.css({
							left: 0,
							width: 75.4+'%',
							background: "url(./images/cannes_on.png) left center / cover no-repeat",
						});
						$('.banner._02').css({
							width: 40+'%',
							left: 45.5+'%',
							background: "url(./images/newyork_off.png) left center / cover no-repeat",
						});
						$('.banner._03').css({
							width: 40+'%',
							left: 65.2+'%',
							background: "url(./images/clio_off.png) left center / cover no-repeat",
						});
						break;
					case 2:
						$me.css({
							width: 75.4+'%',
							left: 12+'%',
							background: "url(./images/newyork_on.png) left center / cover no-repeat",
						});
						$('.banner._01').css({
							width: 40+'%',
							background: "url(./images/cannes_off.png) left center / cover no-repeat",
						});
						$('.banner._03').css({
							width: 40+'%',
							left: 72+'%',
							background: "url(./images/clio_off.png) left center / cover no-repeat",
						});
						break;
					case 3:
						$me.css({
							width: 75.4+'%',
							left: 30+'%',
							background: "url(./images/clio_on.png) left center / cover no-repeat",
						});
						$('.banner._01').css({
							width: 40+'%',
							background: "url(./images/cannes_off.png) left center / cover no-repeat",
						});
						$('.banner._02').css({
							width: 40+'%',
							left: 10+'%',
							background: "url(./images/newyork_off.png) left center / cover no-repeat",
						});
						break;
				}
			}
			
			function sel_award(award)
			{
				$(".award").hide();
				$(".award._"+award).show();
				$(".award_name").removeClass("is-active");
				$(".award_name._"+award).addClass("is-active");
				// switch (award)
				// {
				// 	case 1:

				// 	break;
				// 	case 2:
				// 	break;
				// 	case 3:
				// 	break;
				// }
			}
		</script>
	</body>

</html>