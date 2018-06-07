<?
    include_once "../include/autoload.php";

    $mnv_f			= new mnv_function();
    $my_db         	= $mnv_f->Connect_MySQL();
    $mobileYN      	= $mnv_f->MobileCheck();
	
	$collection_idx		= $_REQUEST["cidx"];
	$mb_idx				= $_REQUEST["midx"];
	$my_idx				= $_REQUEST["my"];
	$follow_idx			= $_REQUEST["midx"]; 

	// 컬렉션 정보 가져오기
	$collection_query		= "SELECT * FROM collection_info WHERE idx='".$collection_idx."'";
	$collection_result		= mysqli_query($my_db, $collection_query);
	$collection_data		= mysqli_fetch_array($collection_result);

	// 회원 정보 가져오기
	$mb_query		= "SELECT * FROM member_info WHERE idx='".$mb_idx."'";
	$mb_result		= mysqli_query($my_db, $mb_query);
	$mb_data		= mysqli_fetch_array($mb_result);

	include_once "./head.php";
?>
	<body>
		<div id="app">
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
		<div class="app-container sub">
<?
    include_once "./header_layer.php";
?>			
				<div class="main-container">
					<div class="content user-page">
						<div class="inner">
<?
    include_once "./my_vvv_head_layer.php";
?>
							<!-- container -->
							<div class="collection-detail check-mode add-video">
								<div class="title">
									<p>당신이 좋아한 영상으로 컬렉션을 만들어보세요</p>
								</div>
								<div class="semi-container">
									<div class="wrapper">
										<div class="inner">
											<div class="list-container">
												<div class="video-list">
<?
	$my_query		= "SELECT * FROM like_info WHERE mb_idx='".$mb_data["idx"]."' AND like_flag='Y'";
	$my_result		= mysqli_query($my_db, $my_query);

	while ($data = mysqli_fetch_array($my_result))
	{
		$video_query		= "SELECT * FROM video_info2 WHERE video_idx='".$data['v_idx']."'";
		$video_result		= mysqli_query($my_db, $video_query);
		$video_data			= mysqli_fetch_array($video_result);

		// 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $video_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
		$yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";
		
		// $title_count    = mb_strlen($video_data["video_title"],'utf-8');
        // if ($title_count > 20)
        //     $video_title    = iconv_substr($video_data["video_title"],0,20)."..";
        // else
		// 	$video_title    = $video_data["video_title"];
			
        // // 브랜드 줄바꿈 방지 글자 자르기
        // $brand_count    = mb_strlen($video_data["video_brand"],'utf-8');
        // if ($brand_count > 30)
        //     $video_brand    = iconv_substr($video_data["video_brand"],0,30)."..";
        // else
        //     $video_brand    = $video_data["video_brand"];

		$video_title    = $video_data["video_title"];
		$video_brand    = $video_data["video_brand"];
?>														
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="#">
															<figure>
																<div class="check-layer">
																	<input type="checkbox" name="likeChk" value="<?=$video_data['video_idx']?>">
																	<div class="checkbox"></div>
																</div>
																<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;">
																</div>
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
												</div>
												<button type="button" class="btn-apply" onclick="addVideo()">
													적용하기
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
			<? 	include_once "cursor.php"; ?>
			<? 	include_once "my_vvv_popup.php"; ?>
			
		</div>
	</body>

</html>