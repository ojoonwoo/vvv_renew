<?
    include_once "../include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

	if (!$_SESSION['ss_vvv_idx'] && $_REQUEST["email"] == "")
		echo "<script>location.href='login.php';</script>";

	// 회원 정보 가져오기
	if ($_REQUEST["idx"])
	{
		$my_idx			= $_REQUEST["idx"];
		$follow_idx		= $_REQUEST["idx"]; 
	}else{
		$my_idx			= $_SESSION['ss_vvv_idx'];
		$follow_idx		= $_REQUEST["idx"]; 
	}

	// if ($_SESSION['ss_vvv_idx'] == $my_idx)
	// {
	// 	$member_query		= "SELECT * FROM member_info WHERE idx='".$my_idx."'";
	// 	$member_result		= mysqli_query($my_db, $member_query);
	// 	$member_data		= mysqli_fetch_array($member_result);
	// }
	
	// 회원 정보 가져오기
	$mb_query		= "SELECT * FROM member_info WHERE idx='".$my_idx."'";
	$mb_result		= mysqli_query($my_db, $mb_query);
	$mb_data		= mysqli_fetch_array($mb_result);

	if ($mb_data["mb_showYN"] == "N" && $mb_data["idx"] != $_SESSION["ss_vvv_idx"])
	{
		echo "<script>alert('비공개된 계정입니다.');</script>";
		echo "<script>history.back();</script>";
	}

	$my_query		= "SELECT * FROM like_info WHERE mb_idx='".$my_idx."' AND like_flag='Y'";
	$my_result		= mysqli_query($my_db, $my_query);
	$my_count		= mysqli_num_rows($my_result);

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
						<div class="user-feed">
							<div class="wrapper">
								<div class="tab-wrap">
									<div class="tab my_tab collection"  data-tab-target="collection">
										<a href="#">Collection</a>
									</div>
									<div class="tab my_tab favor" data-tab-target="favor">
										<a href="#">Favorite</a>
									</div>
									<div class="tab my_tab like is-active" data-tab-target="like">
										<a href="#">Like</a>
									</div>
								</div>
								<div class="inner">
									<div class="aj-content my_content collection" data-tab-content="collection">
										<div class="wrapper made">
<?
	if ($_SESSION['ss_vvv_idx'] == $my_idx)
		$collection_query		= "SELECT * FROM collection_info WHERE collection_mb_idx='".$my_idx."' AND collection_showYN='Y'";
	else
		$collection_query		= "SELECT * FROM collection_info WHERE collection_mb_idx='".$my_idx."' AND collection_secret='Y' AND collection_showYN='Y'";

	$collection_result		= mysqli_query($my_db, $collection_query);
	$collection_count		= mysqli_num_rows($collection_result);
											
	if ($_SESSION['ss_vvv_idx'] == $my_idx)
	{
		if($collection_count < 1) {
?>		
											<div class="result-empty">
												<p>당신이 저장한 영상들을 컬렉션으로 만들어 보세요!</p>
												<a class="link-black" href="javascript:void(0)" data-popup="#collection-add">
													<span>만들기 +</span>
												</a>
											</div>
<?
		} else {
?>
											<div class="text-block">
												<p>당신이 저장한 영상들을 컬렉션으로 만들어 보세요!</p>
											</div>
											<button type="button" class="btn-create" data-popup="#collection-add">만들기</button>
<?
		}
	}else{
?>												
											<div class="text-block">
												<p><?=$mb_data['mb_name']?>님이 만든 컬렉션을 감상해 보세요!</p>
											</div>
<?
	}
?>												
											<div class="list-container">
												<div class="album-list">
<?
	while ($collection_data = mysqli_fetch_array($collection_result))
	{
		// 컬렉션에 담긴 영상 썸네일 추출 
		$collection_item_query		= "SELECT * FROM collection_item_info WHERE c_idx='".$collection_data["idx"]."'";
		$collection_item_result		= mysqli_query($my_db, $collection_item_query);
		$collection_item_data		= mysqli_fetch_array($collection_item_result);
	
		$collection_thumb[0]	= "";
		$collection_thumb[1]	= "";
		$collection_thumb[2]	= "";
		if ($collection_item_data["video_items"] != "")
		{
			$c_thumb_arr	= explode(",",$collection_item_data["video_items"]);
			$i = 0;
			foreach($c_thumb_arr as $key => $val)
			{
				$thumb_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$val."'";
				$thumb_result 	= mysqli_query($my_db, $thumb_query);
				$thumb_data		= mysqli_fetch_array($thumb_result);
			
				// 유튜브 영상 코드 자르기
				$yt_code_arr1   = explode("v=", $thumb_data["video_link"]);
				$yt_code_arr2   = explode("&",$yt_code_arr1[1]);
				$collection_thumb[$i]       = "url('https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg') 50% 50% / cover";
				$i++;
			}
		}
?>														
													<div class="album" id="album_<?=$collection_data["idx"]?>">
														<figure>
															<a href="collection_view.php?cidx=<?=$collection_data["idx"]?>&midx=<?=$my_idx?>&my=<?=$my_idx?>&tab=collection" id="album_link_<?=$collection_data["idx"]?>">
																<div class="frame">
																	<div class="thumbnail" style="background: <?=$collection_thumb[0]?> #dcdcdc no-repeat"></div>
																	<div class="thumbnail" style="background: <?=$collection_thumb[1]?> #dcdcdc no-repeat"></div>
																	<div class="thumbnail" style="background: <?=$collection_thumb[2]?> #dcdcdc no-repeat"></div>
																</div>
<?
		// if ($_SESSION['ss_vvv_idx'] == $my_idx)
		// {
?>																													
																<!-- <div class="over-layer">
																	<button type="button" class="btn-delete" onclick="del_collection(event, <?=$collection_data["idx"]?>)"></button>
																</div> -->
<?
		// }
?>																	
															</a>
															<figcaption>
																<span class="title"><?=$collection_data["collection_name"]?></span>
																<span class="desc"><?=$collection_data["collection_desc"]?></span>
																<span class="icon-wrap">
																	<div class="like">
																		<i></i>
																		<span class="count"><?=$collection_data["collection_like_count"]?></span>
																	</div>
																</span>
															</figcaption>
														</figure>
													</div>
<?
	}
?>													
												</div>
											</div>
										</div>
									</div>
<?
	$collection_like_query		= "SELECT * FROM collection_like_info WHERE m_idx='".$my_idx."' AND showYN='Y'";
	$collection_like_result		= mysqli_query($my_db, $collection_like_query);
	$collection_like_count		= mysqli_num_rows($collection_like_result);
									
?>
									<div class="aj-content my_content favor" data-tab-content="favor">
										<div class="wrapper liked">
<? 
	if($collection_like_count < 1) {
?>
											<div class="result-empty">
												<p>다른 친구의 컬렉션을 추가해 생각을 공유해보세요!</p>
											</div>
<?
	}else {		
?>
											<div class="text-block">
												<p>당신이 좋아한 컬렉션입니다!</p>
											</div>
											<div class="list-container">
												<div class="album-list">
<?

		while ($collection_like_data = mysqli_fetch_array($collection_like_result))
		{
			$collection_query		= "SELECT * FROM collection_info WHERE idx='".$collection_like_data["c_idx"]."'";
			$collection_result		= mysqli_query($my_db, $collection_query);
			$collection_data		= mysqli_fetch_array($collection_result);

			// 컬렉션에 담긴 영상 썸네일 추출 
			$collection_item_query		= "SELECT * FROM collection_item_info WHERE c_idx='".$collection_data["idx"]."'";
			$collection_item_result		= mysqli_query($my_db, $collection_item_query);
			$collection_item_data		= mysqli_fetch_array($collection_item_result);

			$collection_thumb[0]	= "";
			$collection_thumb[1]	= "";
			$collection_thumb[2]	= "";
			if ($collection_item_data["video_items"] != "")
			{
				$c_thumb_arr	= explode(",",$collection_item_data["video_items"]);
				$i = 0;
				foreach($c_thumb_arr as $key => $val)
				{
					$thumb_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$val."'";
					$thumb_result 	= mysqli_query($my_db, $thumb_query);
					$thumb_data		= mysqli_fetch_array($thumb_result);

					// 유튜브 영상 코드 자르기
					$yt_code_arr1   = explode("v=", $thumb_data["video_link"]);
					$yt_code_arr2   = explode("&",$yt_code_arr1[1]);
					$collection_thumb[$i]       = "url('https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg') 50% 50% / cover";
					$i++;
				}
			}
?>														
													<div class="album" id="album_like_<?=$collection_data["idx"]?>">
														<figure>
															<a href="collection_view.php?cidx=<?=$collection_data["idx"]?>&midx=<?=$collection_item_data["m_idx"]?>&my=<?=$my_idx?>&tab=favor">
																<div class="frame">
																	<div class="thumbnail" style="background: <?=$collection_thumb[0]?> #dcdcdc no-repeat"></div>
																	<div class="thumbnail" style="background: <?=$collection_thumb[1]?> #dcdcdc no-repeat"></div>
																	<div class="thumbnail" style="background: <?=$collection_thumb[2]?> #dcdcdc no-repeat"></div>
																</div>
<?
		// if ($_SESSION['ss_vvv_idx'] == $my_idx)
		// {
?>																													
																<!-- <div class="over-layer">
																	<button type="button" class="btn-delete" onclick="del_like_collection(event, <?=$collection_data["idx"]?>)"></button>
																</div> -->
<?
		// }
?>																	
															</a>
															<figcaption>
																<span class="title"><?=$collection_data["collection_name"]?></span>
																<span class="desc"><?=$collection_data["collection_desc"]?></span>
																<span class="icon-wrap">
																	<div class="like">
																		<i></i>
																		<span class="count"><?=$collection_data["collection_like_count"]?></span>
																	</div>
																</span>
															</figcaption>
														</figure>
													</div>
<?
		}
?>													
												</div>
											</div>
<?
	}
?>
										</div>
									</div>
									<div class="aj-content my_content like is-active" data-tab-content="like">
<?
	if($my_count < 1) {
?>
										<div class="result-empty">
											<p>하트를 눌러 좋아하는 영상을 추가해보세요!</p>
											<a class="link-black" href="./video_list.php?sort=new">
												<span>영상 보러가기</span>
											</a>
										</div>
										<?
	} else {
										?>
										<div class="text-block">
										<?
		if ($_SESSION['ss_vvv_idx'] == $my_idx)
		{
?>												
											<span>당신이</span> 좋아한 영상입니다!
<?
		}else{
?>			
											<span><?=$mb_data['mb_name']?>님이</span> 좋아한 영상입니다!
<?
		}
?>									
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

			$video_title    = $video_data["video_title"];
			$video_brand    = $video_data["video_brand"];
?>													
												<div class="video col-lg-3 col-md-3 col-sm-2">
													<a href="video_detail.php?idx=<?=$video_data['video_idx']?>">
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
												<!-- <button type="button" class="read-more">
													<img src="./images/plus_icon.png" alt="">
												</button> -->
											</div>
										</div>
<?
	}
?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<? include_once "footer_layer.php"; ?>
		</div>
<? 	include_once "cursor.php"; ?>
<? 	include_once "my_vvv_popup.php"; ?>
		
	</div>
</body>

</html>