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

	// 컬렉션 아이템 정보 가져오기
	$collection_item_query		= "SELECT * FROM collection_item_info WHERE c_idx='".$collection_idx."' AND m_idx='".$mb_idx."'";
	$collection_item_result		= mysqli_query($my_db, $collection_item_query);
	$collection_item_data		= mysqli_fetch_array($collection_item_result);
	$collection_item_count		= mysqli_num_rows($collection_item_result);

	// 컬렉션 즐겨찾기 여부 체크
	$collection_likeYN			= "";
	if ($_SESSION['ss_vvv_idx'])
	{
		$collection_like_query		= "SELECT * FROM collection_like_info WHERE c_idx='".$collection_idx."' AND m_idx='".$_SESSION['ss_vvv_idx']."' AND showYN='Y'";
		$collection_like_result		= mysqli_query($my_db, $collection_like_query);
		$collection_like_count		= mysqli_num_rows($collection_like_result);

		if ($collection_like_count > 0)
			$collection_likeYN		= "is-already";
	}

	$secret_flag	= "";
	if ($collection_data["collection_secret"] == "N")
		$secret_flag	= "is-active";
	// 컬렉션 아이템 전체 갯수 및 아이템 배열로 재 분류하기
	$collection_item_arr	= explode(",", $collection_item_data["video_items"]);
	$total_collection_item	= count($collection_item_arr);

	// 회원 정보 가져오기
	// if ($_SESSION["ss_vvv_idx"])
	// 	$mb_query		= "SELECT * FROM member_info WHERE idx='".$_SESSION["ss_vvv_idx"]."'";
	// else
	// 	$mb_query		= "SELECT * FROM member_info WHERE idx='".$mb_idx."'";
		$mb_query		= "SELECT * FROM member_info WHERE idx='".$_REQUEST["my"]."'";
	
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
							<div class="collection-detail">
								<div class="collection-info">
									<!-- <a href="javascript:history.back()" class="list-back"> -->
									<a href="my_vvv.php?idx=<?=$_REQUEST["midx"]?>&tab=<?=$_REQUEST["tab"]?>" class="list-back">
										<i><</i>리스트로 돌아가기
									</a>
									<div class="texts">
										<span class="title"><?=$collection_data["collection_name"]?></span>
										<span class="summary"><?=$collection_data["collection_desc"]?></span>
<?
	if ($collection_data["collection_secret"] == "N")
	{
?>										
										<div class="secret-mode"></div>
<?
	}
?>										
									</div>
									<div class="counts">
										<span class="wrap">
											<i class="icon video"></i>
											<span class="count"><?=$total_collection_item?></span>
										</span>
										<span class="wrap">
											<i class="icon follow"></i>
											<span class="count"><?=$collection_data["collection_like_count"]?></span>
										</span>
									</div>
<?
	if ($_SESSION['ss_vvv_idx'] == $mb_idx)
	{
?>									
									<!--내 컬렉션일경우-->
									<div class="myaction">
										<button type="button" class="edit" data-popup="#collection-edit">설정</button>
										<button type="button" class="add" onclick="location.href='collection_addvideo.php?cidx=<?=$collection_data["idx"]?>&midx=<?=$mb_idx?>&my=<?=$my_idx?>'">추가</button>
										<button type="button" class="delete" data-mode-change="delete">삭제</button>
									</div>
									<!--내 컬렉션일경우-->
<?
	}else{
		$mb_query2		= "SELECT * FROM member_info WHERE idx='".$mb_idx."'";	
		$mb_result2		= mysqli_query($my_db, $mb_query2);
		$mb_data2		= mysqli_fetch_array($mb_result2);

		if ($mb_data2["mb_nickname"] == "")
			$nick_first		= mb_substr($mb_data2["mb_name"], 0, 1, 'utf-8');
		else
			$nick_first		= mb_substr($mb_data2["mb_nickname"], 0, 1, 'utf-8');

?>		
									<!--내 컬렉션이 아닐경우-->
									<!--시크릿 전에 favor 선행 필수-->
									<div class="anyaction">
										<button class="favor <?=$collection_likeYN?>"></button>
										<!-- <button class="secret"></button> -->
										<!-- 디폴트: 닉네임 맨 앞 한글자만 노출 -->
										<a href="my_vvv.php?idx=<?=$mb_data2["idx"]?>" class="link-own"><span><?=$nick_first?></span></a>
									</div>
									<!--내 컬렉션이 아닐경우-->
<?
	}
?>									
								</div>
								<div class="semi-container">
									<div class="wrapper">
										<div class="inner">
											<!--
<div class="result-empty">
<a href="#">
<span></span>
<span>당신이 좋아한 영상으로 컬렉션을 만들어보세요</span>
</a>
</div>
-->
											<div class="list-container">
												<div class="video-list">
<?
	if ($collection_item_count > 0)
	{
		foreach($collection_item_arr as $key => $val)
		{
			$video_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$val."'";
			$video_result 	= mysqli_query($my_db, $video_query);	
			$video_data		= mysqli_fetch_array($video_result);

			// 유튜브 영상 코드 자르기
			$yt_code_arr1   = explode("v=", $video_data["video_link"]);
			$yt_code_arr2   = explode("&",$yt_code_arr1[1]);
			$yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

			$title_count    = mb_strlen($video_data["video_title"],'utf-8');

			if ($title_count > 30)
				$video_title    = substr($video_data["video_title"],0,30)."...";
			else
				$video_title    = $video_data["video_title"];
				
			// 브랜드 줄바꿈 방지 글자 자르기
			$brand_count    = mb_strlen($video_data["video_brand"],'utf-8');

			if ($title_count > 30)
				$video_brand    = substr($video_data["video_brand"],0,30)."..";
			else
				$video_brand    = $video_data["video_brand"];		
?>												
													<div class="video col-lg-3 col-md-3 col-sm-2">
														<a href="video_detail.php?idx=<?=$video_data['video_idx']?>">
															<figure>
																<div class="check-layer">
																	<input type="checkbox" name="collectionChk" value="<?=$video_data['video_idx']?>">
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
	}
?>													
												</div>
<!--
												<button type="button" class="read-more">
													<img src="./images/plus_icon.png" alt="">
												</button>
-->
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