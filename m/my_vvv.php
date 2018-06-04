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

	$my_query		= "SELECT * FROM like_info WHERE mb_idx='".$mb_data["idx"]."' AND like_flag='Y'";
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
									<div class="tab collection" data-tab-target="collection">
										<a href="#">Collection</a>
									</div>
									<div class="tab favor" data-tab-target="favor">
										<a href="#">Favorite</a>
									</div>
									<div class="tab like is-active" data-tab-target="like">
										<a href="#">Like</a>
									</div>
								</div>
								<div class="inner">
									<div class="aj-content collection" data-tab-content="collection">
										<div class="wrapper made">
<?
	if ($_SESSION['ss_vvv_idx'] == $my_idx)
	{
?>												
											<div class="text-block">
												<p>당신이 저장한 영상들을 컬렉션으로 만들어 보세요!</p>
											</div>
											<button type="button" class="btn-create" data-popup="#collection-add">만들기</button>
<?
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
	if ($_SESSION['ss_vvv_idx'] == $my_idx)
		$collection_query		= "SELECT * FROM collection_info WHERE collection_mb_idx='".$my_idx."' AND collection_showYN='Y'";
	else
		$collection_query		= "SELECT * FROM collection_info WHERE collection_mb_idx='".$my_idx."' AND collection_secret='Y' AND collection_showYN='Y'";

	$collection_result		= mysqli_query($my_db, $collection_query);
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
									<div class="aj-content favor" data-tab-content="favor">
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
										</div>
<?
	}
?>
									</div>
									<div class="aj-content like is-active" data-tab-content="like">
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

//			$title_count    = mb_strlen($video_data["video_title"],'utf-8');
//			if ($title_count > 20)
//				$video_title    = iconv_substr($video_data["video_title"],0,20)."..";
//			else
//				$video_title    = $video_data["video_title"];
//
//			// 브랜드 줄바꿈 방지 글자 자르기
//			$brand_count    = mb_strlen($video_data["video_brand"],'utf-8');
//			if ($brand_count > 30)
//				$video_brand    = iconv_substr($video_data["video_brand"],0,30)."..";
//			else
//				$video_brand    = $video_data["video_brand"];
			
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
		</div>
		<div id="cursor" class="defualt"></div>
		<div class="popup my-coll-add mycollection" id="collection-add">
			<button type="button" class="popup-close" data-popup="@close"></button>
			<div class="inner">
				<div class="title">
					<h5>컬렉션 만들기</h5>
				</div>
				<div class="content">
					<div class="input-area">
						<div class="input-group">
							<div class="guide">
								<span>이름</span>
							</div>
							<div class="input">
								<input type="text" placeholder="<?=$mb_data['mb_name']?>님의 5월 컬렉션" id="collection_name">
							</div>
						</div>
						<div class="input-group">
							<div class="guide">
								<span>설명</span>
							</div>
							<div class="input">
								<input type="text" id="collection_desc">
							</div>
						</div>
					</div>
					<div class="setting">
						<span class="secret-guide">비밀 설정</span>
						<div class="toggle secret">
							<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="secret" name="secret">
							<div class="toggle-circle"></div>
						</div>
					</div>	
					<div class="button-wrap">
						<button type="button" class="btn-light-grey" data-popup="@close">취소</button>
						<button type="button" onclick="create_collection()">만들기</button>
					</div>
				</div>
			</div>
		</div>
		<div class="popup my-coll-edit mycollection" id="collection-edit">
			<button type="button" class="popup-close" data-popup="@close"></button>
			<div class="inner">
				<div class="title">
					<h5>컬렉션 수정</h5>
				</div>
				<div class="content">
					<div class="input-area">
						<div class="input-group">
							<div class="guide">
								<span>이름</span>
							</div>
							<div class="input">
								<input type="text" placeholder="컬렉션 이름">
							</div>
						</div>
						<div class="input-group">
							<div class="guide">
								<span>설명</span>
							</div>
							<div class="input">
								<input type="text" value="">
							</div>
						</div>
					</div>
					<div class="setting">
						<span class="secret-guide">비밀 설정</span>
						<div class="toggle secret is-active">
							<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="secret" name="secret">
							<div class="toggle-circle"></div>
						</div>
					</div>	
					<div class="button-wrap">
						<button type="button" class="btn-light-grey">컬렉션 삭제</button>
						<button type="button">수정</button>
					</div>
				</div>
			</div>
		</div>
		<div class="popup profile-edit" id="profile-edit">
			<button type="button" class="popup-close" data-popup="@close"></button>
			<div class="inner">
				<div class="title">
					<h5>프로필 수정</h5>
				</div>
				<div class="content">
					<div class="area-picture">
						<div class="pic-wrap">
							<div class="picture">
<?
	if ($mb_data['mb_nickname'] == "")
	{
?>
								<img src="./images/profile_img_sample.jpg" alt="">
<?
    }else{
?>        
                                <img src=".<?=$mb_data["mb_profile_url"]?>" alt="">
<?
    }
?>                                
							</div>
							<div class="btn-edit">
								<label for="profile-change">프로필 사진 바꾸기</label>
								<input type="file" id="profile-change">
							</div>
						</div>
					</div>
					<div class="area-info">
						<div class="input-group">
							<div class="guide">
								닉네임
							</div>
							<div class="input">
								<input type="text" id="edit_nickname" value="<?=$mb_data['mb_nickname']?>">
							</div>
						</div>
						<div class="input-group">
							<div class="guide">
								계정정보
							</div>
							<div class="input">
<?
    if ($mb_data["mb_login_way"] == "kakao")
    {
?>   
								<i class="kt"></i>
<?
    }else{
?>        
								<i class="fb"></i>
<?
	}
	
	$is_secret = "";
	$is_checked = "";

	if ($mb_data["mb_showYN"] == "N")
	{
		$is_secret = "is-active";
		$is_checked = "checked";
	}
?>                         
								<input type="text" value="<?=$mb_data['mb_email']?>" readonly disabled>
							</div>
						</div>
						<div class="input-group secret">
							<div class="guide">
								비공개 계정
							</div>
							<div class="input setting">
								<div class="toggle secret <?=$is_secret?>">
									<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="profile-secret" name="profile-secret" <?=$is_checked?>>
									<div class="toggle-circle"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="button-wrap">
						<button type="button" class="btn-light-grey" data-popup="@close">취소</button>
						<button type="button" onclick="edit_profile()">완료</button>
					</div>
				</div>
			</div>
		</div>
		<div class="popup search-friends" id="search-friends">
			<button type="button" class="popup-close" data-popup="@close"></button>
			<div class="inner">
				<div class="title">
					<h5>친구 검색</h5>
				</div>
				<div class="content">
					<div class="search-wrap">
						<div class="search-bar">
							<input type="text" id="search_nickname" onkeyup="search_friends()" placeholder="친구 닉네임 검색">
							<div class="placeholder-icon"></div>
						</div>
						<div class="search-result">
							<div class="scroll-box">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="popup follow-state" id="follow-state">
			<button type="button" class="popup-close" data-popup="@close"></button>
			<div class="inner">
				<div class="content">
					<div class="area-tab">
						<div class="tab-wrap">
							<div class="tab is-active" data-tab-target="follow">
								<a href="#">팔로우</a>
							</div>
							<div class="tab" data-tab-target="following">
								<a href="#">팔로잉</a>
							</div>
						</div>
					</div>
					<div class="area-list">
						
						<div class="scroll-box follow is-active" data-tab-content="follow">
<?
	// $my_idx
	$follow_query		= "SELECT * FROM follow_info WHERE follow_idx='".$my_idx."'";
	$follow_result		= mysqli_query($my_db, $follow_query);

	while ($follow_data = mysqli_fetch_array($follow_result))
	{
		$mb_f_query		= "SELECT * FROM member_info WHERE idx='".$follow_data["follower_idx"]."'";
		$mb_f_result	= mysqli_query($my_db, $mb_f_query);
		$mb_f_data		= mysqli_fetch_array($mb_f_result);

		// 라이크 갯수
		$like_f_query	= "SELECT * FROM like_info WHERE mb_idx='".$mb_f_data["idx"]."' AND like_flag='Y'";
		$like_f_result	= mysqli_query($my_db, $like_f_query);
		$like_f_count	= mysqli_num_rows($like_f_result);
		
		// 컬렉션 갯수
		$collection_f_query		= "SELECT * FROM collection_info WHERE collection_mb_idx='".$mb_f_data["idx"]."' AND collection_showYN='Y'";
		$collection_f_result	= mysqli_query($my_db, $collection_f_query);
		$collection_f_count		= mysqli_num_rows($collection_f_result);
?>								
							<div class="row">
								<div class="img">
									<a href="my_vvv.php?idx=<?=$mb_f_data["idx"]?>">
										<img src="<?=$mb_f_data["mb_profile_url"]?>" alt="">
									</a>
								</div>
								<div class="info">
									<div class="name"><?=$mb_f_data["mb_name"]?></div>
									<div class="counts">
										<div class="wrap like">
											<i></i>
											<span><?=$like_f_count?></span>
										</div>
										<div class="wrap collection">
											<i></i>
											<span><?=$collection_f_count?></span>
										</div>
									</div>
								</div>
								<div class="action">
<?
	if ($_SESSION["ss_vvv_idx"] != $follow_data["follower_idx"])
	{
		if (!$_SESSION['ss_vvv_idx'])
		{
?>
									<button type="button" class="already" onclick="alert('로그인 후 친구추가해 주세요.');location.href='login.php?refurl=<?=$_SERVER['REQUEST_URI']?>'"></button>
<?
		}else{
			$add_query		= "SELECT * FROM follow_info WHERE follow_idx='".$mb_f_data["idx"]."' AND follower_idx='".$_SESSION["ss_vvv_idx"]."' AND follow_YN='Y'";
			$add_result		= mysqli_query($my_db, $add_query);
			$add_count		= mysqli_num_rows($add_result);
			
			if ($add_count > 0)
			{
?>		
									<button type="button" class="already" id="f_list_btn_<?=$mb_f_data["idx"]?>" onclick="list_follow_member('<?=$mb_f_data["idx"]?>','already')"></button>
<?
			}else{
?>										
									<button type="button" class="add" id="f_list_btn_<?=$mb_f_data["idx"]?>" onclick="list_follow_member('<?=$mb_f_data["idx"]?>','add')"></button>
<?
			}
		}
	}
?>								
								</div>
							</div>
<?
	}
?>							
						</div>

						<div class="scroll-box following" data-tab-content="following">
<?
	// $my_idx
	$follower_query		= "SELECT * FROM follow_info WHERE follower_idx='".$my_idx."'";
	$follower_result	= mysqli_query($my_db, $follower_query);

	while ($follower_data = mysqli_fetch_array($follower_result))
	{
		$mb_fer_query		= "SELECT * FROM member_info WHERE idx='".$follower_data["follow_idx"]."'";
		$mb_fer_result		= mysqli_query($my_db, $mb_fer_query);
		$mb_fer_data		= mysqli_fetch_array($mb_fer_result);

		// 라이크 갯수
		$like_fer_query		= "SELECT * FROM like_info WHERE mb_idx='".$mb_fer_data["idx"]."' AND like_flag='Y'";
		$like_fer_result	= mysqli_query($my_db, $like_fer_query);
		$like_fer_count		= mysqli_num_rows($like_fer_result);
		
		// 컬렉션 갯수
		$collection_fer_query		= "SELECT * FROM collection_info WHERE collection_mb_idx='".$mb_fer_data["idx"]."' AND collection_showYN='Y'";
		$collection_fer_result		= mysqli_query($my_db, $collection_fer_query);
		$collection_fer_count		= mysqli_num_rows($collection_fer_result);
?>								
							<div class="row">
								<div class="img">
									<a href="my_vvv.php?idx=<?=$mb_fer_data["idx"]?>">
										<img src="<?=$mb_fer_data["mb_profile_url"]?>" alt="">
									</a>
								</div>
								<div class="info">
									<div class="name"><?=$mb_fer_data["mb_name"]?></div>
									<div class="counts">
										<div class="wrap like">
											<i></i>
											<span><?=$like_fer_count?></span>
										</div>
										<div class="wrap collection">
											<i></i>
											<span><?=$collection_fer_count?></span>
										</div>
									</div>
								</div>
								<div class="action">
<?
	if ($_SESSION["ss_vvv_idx"] != $follower_data["follow_idx"])
	{
		if (!$_SESSION['ss_vvv_idx'])
		{
?>
									<button type="button" class="already" onclick="alert('로그인 후 친구추가해 주세요.');location.href='login.php?refurl=<?=$_SERVER['REQUEST_URI']?>'"></button>
<?
		}else{
			$add_query		= "SELECT * FROM follow_info WHERE follow_idx='".$mb_fer_data["idx"]."' AND follower_idx='".$_SESSION["ss_vvv_idx"]."' AND follow_YN='Y'";
			$add_result		= mysqli_query($my_db, $add_query);
			$add_count		= mysqli_num_rows($add_result);
			
			if ($add_count > 0)
			{
?>		
									<button type="button" class="already" id="f_list_btn_<?=$mb_fer_data["idx"]?>" onclick="list_follow_member('<?=$mb_fer_data["idx"]?>','already')"></button>
<?
			}else{
?>										
									<button type="button" class="add" id="f_list_btn_<?=$mb_fer_data["idx"]?>" onclick="list_follow_member('<?=$mb_fer_data["idx"]?>','add')"></button>
<?
			}
		}
	}
?>								
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
	<script src="../lib/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
	<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
	<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	<script src="../lib/jQuery-File-Upload/js/jquery.fileupload.js"></script>
	<script src="../lib/jQuery-File-Upload/js/jquery.fileupload-process.js"></script>
	<script src="../lib/jQuery-File-Upload/js/jquery.fileupload-image.js"></script>
	<script>
		var profile_url = "";

			$(function() {
<?
	// collection_view 에서 리스트로 돌아가기 했을때 해당 탭으로 이동
	$tab	= $_REQUEST["tab"];
	if ($tab)
	{
?>
				$(".tab").removeClass("is-active");
				$(".tab.<?=$tab?>").addClass("is-active");

				$(".aj-content").removeClass("is-active");
				$(".aj-content.<?=$tab?>").addClass("is-active");
<?
	}
?>				
			});

		//	기본 기능 테스트 코드
		$doc = $(document);

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

		// $doc.on('click', '.tab', function() {
		// 	$(".tab").removeClass("is-active");
		// 	$(this).addClass("is-active");

		// 	var target = $(this).data('tab-content');
		// 	$(".aj-content").removeClass("is-active");
		// 	$(".aj-content."+target).addClass("is-active");

		// 	return false;
		// });

		$doc.on('click', '.tab', function() {
			$wrap = $(this).closest('.tab-wrap');
			$wrap.find('.tab').removeClass('is-active');
//				$(".tab").removeClass("is-active");
			$(this).addClass("is-active");

			var target = $(this).data('tab-target');
			$('[data-tab-content='+target+']').siblings().removeClass('is-active');
			$('[data-tab-content='+target+']').addClass("is-active");
//				$(".aj-content."+target).addClass("is-active");

			return false;
		});

		function follow_member()
		{
			$.ajax({
				type   : "POST",
				async  : false,
				url    : "../main_exec.php",
				data:{
					"exec"				    : "follow_member",
					"follow_idx"          	: "<?=$follow_idx?>"
				},
				success: function(response){
					console.log(response);
					if (response.match("Y") == "Y")
					{
						// alert("덧글이 입력되었습니다.");
						$(".follow-state a").addClass("already");
						$(".follow-state a").html("팔로우중");
						$(".f-wer .count").html(Number($(".f-wer .count").html()) + 1);
					}else if (response.match("D") == "D"){
						$(".follow-state a").removeClass("already");
						$(".follow-state a").html("팔로우하기");
						$(".f-wer .count").html(Number($(".f-wer .count").html()) - 1);
					}else if (response.match("L") == "L"){
						alert("로그인 후 이용해 주세요!");
						location.href = "login.php?refurl=my_vvv.php?idx=<?=$follow_idx?>";
					}else{
						alert("다시 입력해 주세요.");
						location.reload();
					}
				}
			});			
		}

		function create_collection()
		{
			var collection_name		= $("#collection_name").val();
			var collection_desc		= $("#collection_desc").val();
			var collection_secret	= $("input:checkbox[id='secret']").is(":checked");

			if (collection_name == "")
			{
				alert("컬렉션 이름을 입력해 주세요.");
				return false;
			}

			if (collection_desc == "")
			{
				alert("컬렉션 설명을 입력해 주세요.");
				return false;
			}

			$.ajax({
				type   : "POST",
				async  : false,
				url    : "../main_exec.php",
				data:{
					"exec"				    : "create_collection",
					"collection_name"       : collection_name,
					"collection_desc"		: collection_desc,
					"collection_secret"		: collection_secret
				},
				success: function(response){
					console.log(response);
					if (response.match("Y") == "Y")
					{
						location.reload();
					}else if (response.match("D") == "D"){
						alert("이미 생성된 컬렉션 이름입니다. 다른 이름으로 생성해 주세요.")
						location.reload();
					}else{
						alert("다시 입력해 주세요.");
						location.reload();
					}
				}
			});			

		}

		function del_collection(e,idx)
		{
			// e.stopPropagation();
			// e.stopImmediatePropagation();
			e.preventDefault();
			if (confirm("선택하신 컬렉션을 삭제 할까요?"))
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"				    : "delete_collection",
						"collection_idx"       	: idx
					},
					success: function(response){
						console.log(response);
						$("#album_"+idx).hide();
					}
				});					
			}
		}

		function del_like_collection(e,idx)
		{
			e.preventDefault();
			if (confirm("선택하신 컬렉션을 Favorite에서 삭제 할까요?"))
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"					: "delete_like_collection",
						"collection_idx"        : idx
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
							alert("즐겨찾기가 취소 되었습니다.");
							$("#album_like_"+idx).hide();
						}
					}
				});		
			}
		}

		$(function () {
			'use strict';
			var url = '../Upload.php?mid=<?=$_SESSION['ss_vvv_idx']?>';
			$('#profile-change').fileupload({
				url: url,
				dataType: 'json',
				autoUpload: true,
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
				maxFileSize: 10000000,
				disableImageResize: /Android(?!.*Chrome)|Opera/
					.test(window.navigator.userAgent),
				previewThumbnail: false,
				previewCrop: false
			}).on('fileuploadadd', function (e, data) {
				data.context = $('<div id="prev_thum"/>').appendTo('.img-area');
				$.each(data.files, function (index, file) {
					var node = $('<p style="margin:0" />');
					node.appendTo(data.context);
				});
			}).on('fileuploadprocessalways', function (e, data) {
				var index = data.index,
					file = data.files[index],
					node = $(data.context.children()[index]);
				if (file.preview) {
					node
						.prepend('<br>')
						.prepend(file.preview);
				}
				if (file.error) {
					node
						.append('<br>')
						.append($('<span class="text-danger"/>').text(file.error));
				}
			}).on('fileuploadprogressall', function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress .progress-bar').css(
					'width',
					progress + '%'
				);
			}).on('fileuploaddone', function (e, data) {
				$.each(data.result.files, function (index, file) {
					console.log(file);
					if (file.url) {
						profile_url = file.url;
						$(".picture > img").attr("src","."+file.url);
					} else if (file.error) {
						var error = $('<span class="text-danger"/>').text(file.error);
						$(data.context.children()[index])
							.append('<br>')
							.append(error);
					}
				});
			}).on('fileuploadfail', function (e, data) {
				$.each(data.files, function (index) {
					var error = $('<span class="text-danger"/>').text('File upload failed.');
					$(data.context.children()[index])
						.append('<br>')
						.append(error);
				});
			}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
		});     
		
		function edit_profile()
		{
			var edit_nickname   = $("#edit_nickname").val();
			var edit_secret	    = $("input:checkbox[id='profile-secret']").is(":checked");

			$.ajax({
				type   : "POST",
				async  : false,
				url    : "../main_exec.php",
				data:{
					"exec"				: "edit_member",
					"edit_nickname"     : edit_nickname,
					"edit_secret"		: edit_secret,
					"profile_url"		: profile_url
				},
				success: function(response){
					console.log(response);
					if (response.match("Y") == "Y")
					{
						alert("회원 정보가 수정 되었습니다.");
						location.reload();
					}else{
						alert("다시 수정해 주세요.");
						location.reload();
					}
				}
			});
		}

		function search_friends()
		{
			var search_nickname = $("#search_nickname").val();

			$.ajax({
				type   : "POST",
				async  : false,
				url    : "./ajax_friends.php",
				data:{
					"search_nickname"   : search_nickname
				},
				success: function(response){
					console.log(response);
					$(".scroll-box").html(response);
				}
			});
			
		}

		function search_follow_member(idx, followClass)
		{
			if (followClass == "already")
			{
				var confirm_message = "이 친구를 팔로우 취소 할까요?";
				var followYN        = "Y";
			}else{
				var confirm_message = "이 친구를 팔로우 할까요?";
				var followYN        = "N";
			}

			if (confirm(confirm_message))
			{
				$.ajax({
				type   : "POST",
				async  : false,
				url    : "../main_exec.php",
				data:{
					"exec"				    : "search_follow_member",
					"follow_idx"          	: idx,
					"followYN"          	: followYN
				},
				success: function(response){
					console.log(response);
					if (response.match("Y") == "Y")
					{
						alert("팔로우 되었습니다.");
						// location.reload();
						$("#f_btn_"+idx).attr("class","already");
						$("#f_btn_"+idx).attr("onclick","search_follow_member('" + idx + "','already')");
					}else if (response.match("D") == "D"){
						alert("팔로우가 취소 되었습니다.");
						// location.reload();
						$("#f_btn_"+idx).attr("class","add");
						$("#f_btn_"+idx).attr("onclick","search_follow_member('" + idx + "','add')");
					}else{
						alert("다시 입력해 주세요.");
						location.reload();
					}
				}
			});			

			}
		}

		function list_follow_member(idx, followClass)
		{
			if (followClass == "already")
			{
				var confirm_message = "이 친구를 팔로우 취소 할까요?";
				var followYN        = "Y";
			}else{
				var confirm_message = "이 친구를 팔로우 할까요?";
				var followYN        = "N";
			}

			if (confirm(confirm_message))
			{
				$.ajax({
				type   : "POST",
				async  : false,
				url    : "../main_exec.php",
				data:{
					"exec"				    : "search_follow_member",
					"follow_idx"          	: idx,
					"followYN"          	: followYN
				},
				success: function(response){
					console.log(response);
					if (response.match("Y") == "Y")
					{
						alert("팔로우 되었습니다.");
						// location.reload();
						$("#f_list_btn_"+idx).attr("class","already");
						$("#f_list_btn_"+idx).attr("onclick","list_follow_member('" + idx + "','already')");
					}else if (response.match("D") == "D"){
						alert("팔로우가 취소 되었습니다.");
						// location.reload();
						$("#f_list_btn_"+idx).attr("class","add");
						$("#f_list_btn_"+idx).attr("onclick","list_follow_member('" + idx + "','add')");
					}else{
						alert("다시 입력해 주세요.");
						location.reload();
					}
				}
			});			

			}
		}

	</script>
</body>

</html>