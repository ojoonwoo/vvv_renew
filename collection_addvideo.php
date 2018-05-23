<?
    include_once "./include/autoload.php";

    $mnv_f			= new mnv_function();
    $my_db         	= $mnv_f->Connect_MySQL();
    $mobileYN      	= $mnv_f->MobileCheck();
	
	$collection_idx		= $_REQUEST["cidx"];
	$mb_idx				= $_REQUEST["midx"];

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
										<img src="./images/profile_img_sample.jpg" alt="">
									</div>
									<div class="info-wrap">
										<div class="wrap-user">
											<div class="user-id">
												<span class="u-id"><?=$mb_data['mb_name']?></span>
												<a href="javascript:void(0)" class="setting">
													<img src="./images/icon_profile_setting.png" alt="">
												</a>
												<div class="follow-state">
<?
	if ($_SESSION['ss_vvv_idx'] != $mb_idx)
	{
		// 팔로우 여부 확인
		$follow_query		= "SELECT * FROM follow_info WHERE follow_idx='".$follow_idx."' AND follower_idx='".$_SESSION['ss_vvv_idx']."' AND follow_YN='Y'";
		$follow_result		= mysqli_query($my_db, $follow_query);
		$follow_count		= mysqli_num_rows($follow_result);
		
		if ($follow_count > 0)
		{
?>
													<a href="javascript:follow_member()" class="already">팔로우중</a>
<?
		}else{
?>													
													<a href="javascript:follow_member()">팔로우하기</a>
<?
		}
	}
?>
												</div>
											</div>
										</div>
										<div class="wrap-actions">
											<div class="f-wer">
												<span>팔로워</span>
												<span class="count"><?=$mb_data['mb_follower_count']?></span>
											</div>
											<div class="f-ing">
												<span>팔로잉</span>
												<span class="count"><?=$mb_data['mb_following_count']?></span>
											</div>
											<div class="f-add">
<?
	if ($_SESSION['ss_vvv_idx'] != $my_idx)
	{
?>
												<button type="button">친구추가</button>
<?
	}
?>												
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- container -->
							<div class="collection-detail add-video">
								<div class="title">
									<h3>좋아요 리스트</h3>
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
														<a href="video_detail.php?idx=<?=$video_data['video_idx']?>">
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
									<input type="text" placeholder="오준우님의 5월 컬렉션">
								</div>
							</div>
							<div class="input-group">
								<div class="guide">
									<span>설명</span>
								</div>
								<div class="input">
									<input type="text">
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
							<button type="button">만들기</button>
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
									<input type="text" value="오준우님의 5월 컬렉션">
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
							<button type="button" class="btn-light-grey" data-popup="@close">취소</button>
							<button type="button">수정</button>
						</div>
					</div>
				</div>
			</div>
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

			function addVideo()
			{
				var videoItems = "";
				var videoCount	= 0;

				var i = 0;
				$('input:checkbox[type=checkbox]:checked').each(function () {
					if (i != 0)
					{
						videoItems += ",";
					}
					videoItems += $(this).val();
					i++;
				});

				if (videoItems == "")
				{
					alert("영상을 선택하시고 적용 버튼을 클릭해 주세요.");
					return false;
				}

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
					data:{
						"exec"				: "add_video",
						"c_idx"          	: "<?=$collection_idx?>",
						"m_idx"          	: "<?=$mb_idx?>",
						"video_items"       : videoItems
					},
					success: function(response){
						console.log(response);
						alert("컬렉션에 영상이 적용되었습니다.");
						location.href = "collection_view.php?cidx=<?=$collection_idx?>&midx=<?=$mb_idx?>";
					}
				});			

			}
		</script>
	</body>

</html>