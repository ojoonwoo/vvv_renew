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
										<button class="secret"></button>
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
									<input type="text" id="c_name" value="<?=$collection_data["collection_name"]?>">
								</div>
							</div>
							<div class="input-group">
								<div class="guide">
									<span>설명</span>
								</div>
								<div class="input">
									<input type="text" id="c_desc" value="<?=$collection_data["collection_desc"]?>">
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
							<button type="button" onclick="del_collection();" class="btn-light-grey">컬렉션 삭제</button>
							<button type="button" onclick="edit_collection();">수정</button>
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
								<input type="text" id="search_nickname" onkeyup="search_friends()" placeholder="친구 닉네임 또는 이름 검색">
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
		$follow_query		= "SELECT * FROM follow_info WHERE follow_idx='".$my_idx."' AND follow_YN='Y'";
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
											<img src=".<?=$mb_f_data["mb_profile_url"]?>" alt="">
										</a>
									</div>
									<div class="info">
<?
	if ($mb_f_data['mb_nickname'] == "")
	{
?>										
										<div class="name"><?=$mb_f_data["mb_name"]?></div>
<?
	}else{
?>		
										<div class="name"><?=$mb_f_data["mb_nickname"]?></div>
<?
	}
?>								
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
										<button type="button" class="already f_list_btn_<?=$mb_f_data["idx"]?>" onclick="list_follow_member('<?=$mb_f_data["idx"]?>','already')"></button>
	<?
				}else{
	?>										
										<button type="button" class="add f_list_btn_<?=$mb_f_data["idx"]?>" onclick="list_follow_member('<?=$mb_f_data["idx"]?>','add')"></button>
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
		$follower_query		= "SELECT * FROM follow_info WHERE follower_idx='".$my_idx."' AND follow_YN='Y'";
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
											<img src=".<?=$mb_fer_data["mb_profile_url"]?>" alt="">
										</a>
									</div>
									<div class="info">
<?
	if ($mb_fer_data['mb_nickname'] == "")
	{
?>										
										<div class="name"><?=$mb_fer_data["mb_name"]?></div>
<?
	}else{
?>		
										<div class="name"><?=$mb_fer_data["mb_nickname"]?></div>
<?
	}
?>								
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
										<button type="button" class="already f_list_btn_<?=$mb_fer_data["idx"]?>" onclick="list_follow_member('<?=$mb_fer_data["idx"]?>','already')"></button>
	<?
				}else{
	?>										
										<button type="button" class="add f_list_btn_<?=$mb_fer_data["idx"]?>" onclick="list_follow_member('<?=$mb_fer_data["idx"]?>','add')"></button>
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
		<script>
			// $(function() {
			// 	//				global search
			// 	$('#order-date').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-nation').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-industry').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-genre').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-awards').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-sortby').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// });

			//	기본 기능 테스트 코드
			$doc = $(document);

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

			//프론트 임시 샘플코드
			$doc.on('click', '[data-mode-change]', function() {
				var mode = $(this).data('mode-change');
				if(!$('.collection-detail').hasClass('check-mode')) {
					//삭제 모드로 변경
					$(this).text('완료');
				} else {
					//삭제 코드
					var videoItems = "";
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
						// alert("영상을 선택하시고 완료 버튼을 클릭해 주세요.");
						location.href = "collection_view.php?cidx=<?=$collection_idx?>&midx=<?=$mb_idx?>&my=<?=$_REQUEST["my"]?>";
						return false;
					}

					$.ajax({
						type   : "POST",
						async  : false,
						url    : "../main_exec.php",
						data:{
							"exec"				: "delete_video",
							"c_idx"          	: "<?=$collection_idx?>",
							"m_idx"          	: "<?=$mb_idx?>",
							"video_items"       : videoItems
						},
						success: function(response){
							console.log(response);
							alert("컬렉션에서 선택하신 영상이 삭제되었습니다.");
							location.href = "collection_view.php?cidx=<?=$collection_idx?>&midx=<?=$mb_idx?>";
						}
					});			
					//삭제 완료
					$(this).text('삭제');
				}
				$('.collection-detail').toggleClass('check-mode');
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
							$("#follow_status").addClass("already");
							$("#follow_status").html("팔로우중");
							$(".f-wer .count").html(Number($(".f-wer .count").html()) + 1);
						}else if (response.match("D") == "D"){
							$("#follow_status").removeClass("already");
							$("#follow_status").html("팔로우하기");
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

			function del_collection()
			{
				// e.stopPropagation();
				// e.stopImmediatePropagation();
				// e.preventDefault();
				if (confirm("선택하신 컬렉션을 삭제 할까요?"))
				{
					$.ajax({
						type   : "POST",
						async  : false,
						url    : "../main_exec.php",
						data:{
							"exec"				    : "delete_collection",
							"collection_idx"       	: "<?=$collection_idx?>"
						},
						success: function(response){
							console.log(response);
							location.href = "./my_vvv.php";
						}
					});					
				}
			}

			function edit_collection()
			{
				var collection_name		= $("#c_name").val();
				var collection_desc		= $("#c_desc").val();
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
						"exec"				    : "edit_collection",
						"c_idx"          		: "<?=$collection_idx?>",
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
							// location.reload();
						}else{
							alert("다시 입력해 주세요.");
							location.reload();
						}
					}
				});		
			}

			$doc.on('click', '.favor', function() {
				var cLikeChk	= "Y";
				if(!$(this).hasClass('is-already')) 
					cLikeChk	= "N";


				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"					: "like_collection",
						"collection_idx"        : "<?=$collection_idx?>",
						"showYN"				: cLikeChk
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
							alert("즐겨찾기 되었습니다.");
							$(".favor").addClass("is-already");
						}else if (response.match("L") == "L"){
							alert("로그인 후 즐겨찾기를 해 주세요!");
							location.href = "login.php?refurl=collection_view.php?cidx=<?=$collection_idx?>&midx=<?=$mb_idx?>";
						}else{
							alert("즐겨찾기가 취소 되었습니다.");
							$(".favor").removeClass("is-already");
						}
					}
				});		
			});

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
							$(".f_list_btn_"+idx).attr("class","already");
							$(".f_list_btn_"+idx).attr("onclick","list_follow_member('" + idx + "','already')");
						}else if (response.match("D") == "D"){
							alert("팔로우가 취소 되었습니다.");
							// location.reload();
							$(".f_list_btn_"+idx).attr("class","add");
							$(".f_list_btn_"+idx).attr("onclick","list_follow_member('" + idx + "','add')");
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