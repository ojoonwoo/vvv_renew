<?
    include_once "./include/autoload.php";

    $mnv_f			= new mnv_function();
    $my_db         	= $mnv_f->Connect_MySQL();
    $mobileYN      	= $mnv_f->MobileCheck();
	
	$collection_idx		= $_REQUEST["cidx"];
	$mb_idx				= $_REQUEST["midx"];
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
	if ($collection_data["collection_secret"] == "Y")
		$secret_flag	= "is-active";
	// 컬렉션 아이템 전체 갯수 및 아이템 배열로 재 분류하기
	$collection_item_arr	= explode(",", $collection_item_data["video_items"]);
	$total_collection_item	= count($collection_item_arr);

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
<?
    include_once "./my_vvv_head_layer.php";
?>
							<!-- container -->
							<div class="collection-detail">
								<div class="collection-info">
									<div class="texts">
										<span class="title"><?=$collection_data["collection_name"]?></span>
										<span class="summary"><?=$collection_data["collection_desc"]?></span>
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
									<div class="action-wrap">
										<div class="inner">
<?
	if ($_SESSION['ss_vvv_idx'] == $mb_idx)
	{
?>											
											<!--내 컬렉션일경우-->
											<div class="myaction">
												<button type="button" class="edit" data-popup="#collection-edit"></button>
												<button type="button" class="add" onclick="location.href='collection_addvideo.php?cidx=<?=$collection_data["idx"]?>&midx=<?=$mb_idx?>'"></button>
												<button type="button" class="delete" data-mode-change="delete"></button>
											</div>
											<!--내 컬렉션일경우-->											
<?
	}else{
?>		
											<!--내 컬렉션이 아닐경우-->
												<!--시크릿 전에 favor 선행 필수-->
											<div class="anyaction">
												<!-- is-already 클래스 토글 on/off -->
												<button class="favor <?=$collection_likeYN?>"></button>
												<!-- <button class="secret"></button> -->
												<a href="javascript:void(0)" class="link-own"><span>miniverminiverminiver</span></a>
											</div>
											<!--내 컬렉션이 아닐경우-->
<?
	}
?>									
										</div>
									</div>
								</div>
								<div class="semi-container">
									<div class="wrapper">
										<div class="inner">
											<!-- <div class="content-empty">
												<a href="#">
													<span>+</span>
													<span>당신이 좋아한 영상으로 컬렉션을 만들어보세요</span>
												</a>
											</div> -->

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
							<div class="toggle secret <?=$secret_flag?>">
								<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="secret" name="secret">
								<div class="toggle-circle"></div>
							</div>
						</div>	
						<div class="button-wrap">
							<button type="button" class="btn-light-grey" data-popup="@close">취소</button>
							<button type="button" onclick="edit_collection();">수정</button>
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

			
			//프론트 임시 샘플코드
			$doc.on('click', '[data-mode-change]', function() {
				var mode = $(this).data('mode-change');
				if(!$('.list-container').hasClass('delete-mode')) {
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
						alert("영상을 선택하시고 완료 버튼을 클릭해 주세요.");
						return false;
					}

					$.ajax({
						type   : "POST",
						async  : false,
						url    : "./main_exec.php",
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
				$('.list-container').toggleClass('delete-mode');
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
					url    : "./main_exec.php",
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
					url    : "./main_exec.php",
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

		</script>
	</body>

</html>