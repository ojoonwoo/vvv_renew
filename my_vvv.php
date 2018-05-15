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
										<img src="./images/detail_video_sample.jpg" alt="">
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
											</div>
										</div>
										<div class="wrap-act">
											
										</div>
									</div>
								</div>
							</div>
							<div class="user-feed">
								<div class="wrapper">
									<div class="tab-wrap">
<!--
										<div class="tab">
											<a href="#">Collection</a>
										</div>
-->
										<div class="tab is-active">
											<a href="#">Like</a>
										</div>
									</div>
									<div class="inner">
										<div class="aj-content like">
											<div class="text-block">
												<span>당신이</span> 좋아한 영상입니다!
											</div>
											<div class="list-container">
												<div class="video-list">
<?
	while ($data = mysqli_fetch_array($my_result))
	{
		$video_query		= "SELECT * FROM video_info2 WHERE video_idx='".$data['v_idx']."'";
		$video_result		= mysqli_query($my_db, $video_query);
		$video_data			= mysqli_fetch_array($video_result);

		// 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $video_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
		$yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";
		
		$title_count    = mb_strlen($video_data["video_title"],'utf-8');
        if ($title_count > 20)
            $video_title    = iconv_substr($video_data["video_title"],0,20)."..";
        else
			$video_title    = $video_data["video_title"];
			
        // 브랜드 줄바꿈 방지 글자 자르기
        $brand_count    = mb_strlen($video_data["video_brand"],'utf-8');
        if ($brand_count > 30)
            $video_brand    = iconv_substr($video_data["video_brand"],0,30)."..";
        else
            $video_brand    = $video_data["video_brand"];

?>
													
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="#">
															<figure>
																<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
																<figcaption>
																	<span class="brand">[<?=$video_brand?>]</span>
																	<span class="title"><?=$video_title?></span>
																	<span class="icon-wrap">
																		<span class="play">
																			<i class="icon"></i>
																			<span class="cnt"><?=number_format($video_data["play_count"])?></span>
																		</span>
																		<span class="comment">
																			<i class="icon"></i>
																			<span class="cnt"><?=number_format($video_data["comment_count"])?></span>
																		</span>
																		<span class="like">
																			<i class="icon"></i>
																			<span class="cnt"><?=number_format($video_data["like_count"])?></span>
																		</span>
																		<span class="collect">
																			<i class="icon"></i>
																			<span class="cnt"><?=number_format($video_data["collect_count"])?></span>
																		</span>
																	</span>
																</figcaption>
															</figure>
														</a>
													</div>
<?
	}
?>
													
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