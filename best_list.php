<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

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
							<h4 class="title">
								Editor's PICK
							</h4>
							<div class="list-container">
								<div class="video-list">
<?
    $best_query	= "SELECT * FROM video_info2 WHERE 1 AND showYN='Y' AND best_pick='Y' ORDER BY best_num ASC";
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
									<div class="video col-lg-3 col-md-3 col-sm-2">
										<a href="video_detail.php?idx=<?=$best_data['video_idx']?>">
											<figure>
												<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
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
<?
	}
?>									
								</div>
								<!-- <button type="button" class="read-more">
									<img src="./images/plus_icon.png" alt="">
								</button> -->
							</div>
						</div>
					</div>
				</div>
<? 	include_once "footer_layer.php"; ?>
			</div>
<? 	include_once "cursor.php"; ?>
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
			
		</script>
	</body>

</html>