<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

	// 회원 정보 가져오기
	if ($_REQUEST["idx"])
	{
		$my_idx			= $_REQUEST["idx"];
		$follow_idx		= $_REQUEST["idx"]; 
	}else{
		$my_idx	= $_SESSION['ss_vvv_idx'];
		$follow_idx		= $_REQUEST["idx"]; 
	}

	if (!$_SESSION['ss_vvv_idx'] && $_REQUEST["email"] == "")
		echo "<script>location.href='login.php';</script>";

	// 회원 정보 가져오기
	$mb_query		= "SELECT * FROM member_info WHERE idx='".$my_idx."'";
	$mb_result		= mysqli_query($my_db, $mb_query);
	$mb_data		= mysqli_fetch_array($mb_result);


	$my_query		= "SELECT * FROM like_info WHERE mb_idx='".$mb_data["idx"]."' AND like_flag='Y'";
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
										<img src="./images/profile_img_sample.jpg" alt="">
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
												<a href="javascript:void(0)" class="setting">
													<img src="./images/icon_profile_setting.png" alt="">
												</a>
												<div class="follow-state">
<?
	if ($_SESSION['ss_vvv_idx'] != $my_idx)
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
												<span class="count"><?=$member_data['mb_follower_count']?></span>
											</div>
											<div class="f-ing">
												<span>팔로잉</span>
												<span class="count"><?=$member_data['mb_following_count']?></span>
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
							<div class="user-feed">
								<div class="wrapper">
									<div class="tab-wrap">
										<div class="tab is-active">
											<a href="#">Collection</a>
										</div>
										<div class="tab">
											<a href="#">Like</a>
										</div>
									</div>
									<div class="inner">
										<div class="aj-content collection is-active">
											<div class="wrapper made">
												<div class="text-block">
													<h5>내가 만든 컬렉션</h5>
													<p>당신이 저장한 영상들을 컬렉션으로 만들어 보세요!</p>
													<button type="button" class="btn-create" data-popup="#collection-add">만들기</button>
												</div>
												<div class="list-container">
													<div class="album-list">
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																</figcaption>
															</figure>
														</div>
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																</figcaption>
															</figure>
														</div>
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																	<div class="secret-mode"></div>
																</figcaption>
															</figure>
														</div>
													</div>
												</div>
											</div>
											<div class="wrapper liked">
												<div class="text-block">
													<h5>내가 좋아한 컬렉션</h5>
													<p>당신이 좋아한 컬렉션입니다!</p>
												</div>
												<div class="list-container">
													<div class="album-list">
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																</figcaption>
															</figure>
														</div>
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																</figcaption>
															</figure>
														</div>
														<div class="album">
															<figure>
																<a href="">
																	<div class="frame">
																		<div class="thumbnail" style="background: url(./images/myvvv_album_sample.jpg) 50% 50% / cover #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																		<div class="thumbnail" style="background: #dcdcdc no-repeat"></div>
																	</div>
																	<div class="over-layer">
																		<button type="button" class="btn-delete"></button>
																	</div>
																</a>
																<figcaption>
																	<span class="title">해외 광고</span>
																	<span class="desc">서브 설명 텍스트</span>
																	<span class="icon-wrap">
																		<div class="like">
																			<i></i>
																			<span class="count">2</span>
																		</div>
																	</span>
																	<div class="secret-mode"></div>
																</figcaption>
															</figure>
														</div>
													</div>
												</div>
											</div>
										</div>
										
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
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="cursor" class="defualt"></div>
			<!--popup-wrap 동적생성-->
<!--			<div class="popup-wrap">-->
				<div class="popup my-coll-add" id="collection-add">
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
										<input type="text" placeholder="오준우님의 5월 컬렉션" id="collection_name">
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
<!--			</div>-->
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

			// 검색 APPLY 클릭
			$doc.on('click', '#search-layer-submit', function() {
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

			function follow_member()
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
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
							location.href = "login.php?refurl=video_detail.php?idx=<?=$video_idx?>";
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
					url    : "./main_exec.php",
					data:{
						"exec"				    : "create_collection",
						"collection_name"       : collection_name,
						"collection_desc"		: collection_desc,
						"collection_secret"		: collection_secret
					},
					success: function(response){
						console.log(response);
					}
				});			

			}
		</script>
	</body>

</html>