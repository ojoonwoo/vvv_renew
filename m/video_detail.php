<?
    include_once "../include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();

	$video_idx	= $_REQUEST["idx"];

	// 영상 정보
	$detail_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$video_idx."'";
	$detail_result 	= mysqli_query($my_db, $detail_query);
	$detail_data	= mysqli_fetch_array($detail_result);

	// Like 여부 체크
	$like_query		= "SELECT * FROM like_info WHERE mb_email='".$_SESSION['ss_vvv_email']."' AND v_idx='".$video_idx."' AND like_flag='Y'";
	$like_result	= mysqli_query($my_db, $like_query);

	$like_flag = "";
	if (mysqli_num_rows($like_result) > 0)
		$like_flag = "is-active";

	// 유튜브 영상 코드 자르기
	$yt_code_arr1   = explode("v=", $detail_data["video_link"]);
	$yt_code_arr2   = explode("&",$yt_code_arr1[1]);
	$yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";
	

    include_once "./head.php";
?>
	<body>
		<div id="app">
			<div class="app-container sub">
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
					<div class="content detail">
						<div class="inner">
							<div class="wrapper">
								<div class="info-wrap">
									<div class="brand">
										<?=$detail_data["video_brand"]?>
									</div>
									<div class="title">
										<?=$detail_data["video_title"]?>
									</div>
									<div class="date">
										<?=$detail_data["video_date"]?>
										<!-- 2018 - 01 - 01 -->
									</div>
									<div class="icon-wrap">
										<span class="play">
											<i class="icon"></i>
											<span class="cnt" id="play_count"><?=number_format($detail_data["play_count"])?></span>
										</span>
										<span class="comment">
											<i class="icon"></i>
											<span class="cnt"><?=number_format($detail_data["comment_count"])?></span>
										</span>
										<span class="like">
											<i class="icon"></i>
											<span class="cnt" id="like_count"><?=number_format($detail_data["like_count"])?></span>
										</span>
										<span class="collect">
											<i class="icon"></i>
											<span class="cnt"><?=number_format($detail_data["collect_count"])?></span>
										</span>
									</div>
								</div>
								<div class="player" id="video_area">
									<img src="./images/loading.jpg" alt="로딩 이미지">
									<!-- <img src="./images/detail_video_sample.jpg" alt=""> -->
								</div>
								<div class="actions">
									<a href="javascript:like_video('<?=$video_idx?>')" class="action like <?=$like_flag?>"></a>
<?
	if ($_SESSION['ss_vvv_idx'] != "")
	{
?>									
									<a href="javascript:void(0)" class="action collect" data-layer="#collection-save"></a>

<?
	}else{
?>		
									<a href="javascript:alert('로그인 후 이용해 주세요.');location.href='./login.php?refurl=video_detail.php?idx=<?=$video_idx?>'" class="action collect"></a>
<?
	}
?>							
									<!-- <a href="javascript:request_translate('<?=$video_idx?>')" class="action translate"><span>번역</span></a> -->
									<a href="" class="action share"></a>
									<ul class="share-spread">
										<li class="fb"><a href="#"><img src="./images/detail_share_fb.png" alt="페이스북 공유"></a></li>
										<li class="kt"><a href="#"><img src="./images/detail_share_kt.png" alt="카카오톡 공유"></a></li>
										<li class="url"><a href="#"><img src="./images/detail_share_url.png" alt="링크 공유"></a></li>
									</ul>
								</div>
								<div class="block-comment">
									<h5>comment</h5>
									<div class="input-group">
										<div class="text-box">
											<input type="text" id="comment_text">
										</div>
										<div class="button">
											<button type="button" class="button-submit" onclick="ins_comment('<?=$video_idx?>')">
												확인
											</button>
										</div>
									</div>
									<div class="comment-list">
<?
	$comment_query		= "SELECT * FROM comment_info WHERE v_idx='".$video_idx."' AND showYN='Y' ORDER BY idx DESC";
	$comment_result		= mysqli_query($my_db, $comment_query);

	while ($comment_data = mysqli_fetch_array($comment_result))
	{
?>
										<div class="row">
											<div class="u-id">
												<a href="my_vvv.php?idx=<?=$comment_data["mb_idx"]?>"><?=$comment_data["mb_name"]?></a>
											</div>
											<div class="u-comment">
												<?=$comment_data["comment_text"]?>
											</div>
											<div class="date">
												<?=substr($comment_data["comment_regdate"],0,10)?>
											</div>
											<!-- <div class="actions">
												<button type="button" class="remove-comment"></button>
											</div> -->
										</div>
<?
	}
?>										
									</div>
								</div>
<?
	$related_query		= "SELECT * FROM video_info2 WHERE video_brand='".$detail_data["video_brand"]."' AND video_idx NOT IN ('".$detail_data["video_idx"]."') ORDER BY like_count DESC LIMIT 4";
	$related_result		= mysqli_query($my_db, $related_query);
	$related_count 		= mysqli_num_rows($related_result);
	if ($related_count > 0)
	{
?>
								<div class="block-related">
									<h5>관련 영상</h5>
									<div class="list-container">
										<div class="video-list">
<?
		while ($related_data = mysqli_fetch_array($related_result))
		{
			// 유튜브 영상 코드 자르기
			$rel_yt_code_arr1   = explode("v=", $related_data["video_link"]);
			$rel_yt_code_arr2   = explode("&",$rel_yt_code_arr1[1]);
			$rel_yt_thumb       = "https://img.youtube.com/vi/".$rel_yt_code_arr2[0]."/hqdefault.jpg";
?>											
											<div class="video">
												<a href="video_detail.php?idx=<?=$related_data["video_idx"]?>">
													<figure>
														<div class="thumbnail box-bg" style="background: url(<?=$rel_yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
														<figcaption>
															<span class="brand">[<?=$related_data["video_brand"]?>]</span>
															<span class="title"><?=$related_data["video_title"]?></span>
															<span class="icon-wrap">
																<span class="play">
																	<i class="icon"></i>
																	<span class="cnt"><?=number_format($related_data["play_count"])?></span>
																</span>
																<span class="comment">
																	<i class="icon"></i>
																	<span class="cnt"><?=number_format($related_data["comment_count"])?></span>
																</span>
																<span class="like">
																	<i class="icon"></i>
																	<span class="cnt"><?=number_format($related_data["like_count"])?></span>
																</span>
																<span class="collect">
																	<i class="icon"></i>
																	<span class="cnt"><?=number_format($related_data["collect_count"])?></span>
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
			<div id="cursor" class="defualt"></div>
			<div class="layer collection-pick" id="collection-save">
				<button type="button" class="layer-close" data-layer="@close"></button>
				<div class="inner">
					<div class="title">
						<h5>Collection</h5>
					</div>
					<div class="content">
						<div class="block video-info">
							<figure>
								<div class="thumb-wrap">
									<div class="thumbnail" style="background: url(./images/collection_pick_sample.jpg) 0 0 / 100% auto no-repeat; padding-bottom: 62.2%;"></div>
								</div>
								<figcaption>
									<div class="vid-brand">ADEPOL SC</div>
									<div class="vid-title">We Understand Your Surffering</div>
									<div class="vid-date">2017년 5월</div>
								</figcaption>
							</figure>

						</div>
						<div class="block collection-info">
							<h6>컬렉션 선택</h6>
							<div class="collection-list">
								<div class="scroll-box">
									<ul>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info is-secret">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
										<li class="c-info">
											<span>asd</span><i class="secret"></i>
										</li>
									</ul>
								</div>
							</div>
							<button type="button" class="btn-add" data-layer="#collection-add">
								<span class="icon"></span>
								<span>컬렉션 추가하기</span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="layer collection-pick" id="collection-add">
				<button type="button" class="layer-close" data-layer="@close"></button>
				<div class="inner">
					<div class="title">
						<h5>Collection</h5>
					</div>
					<div class="content">
						<div class="block video-info">
							<figure>
								<div class="thumb-wrap">
									<div class="thumbnail" style="background: url(./images/collection_pick_sample.jpg) 0 0 / 100% auto no-repeat; padding-bottom: 62.59%;"></div>
								</div>
								<figcaption>
									<div class="vid-brand">ADEPOL SC</div>
									<div class="vid-title">We Understand Your Surffering</div>
									<div class="vid-date">2017년 5월</div>
								</figcaption>
							</figure>

						</div>
						<div class="block collection-info">
							<div class="collection-setting">
								<div class="input-wrap">
									<span>컬렉션 추가하기</span>
									<div class="input-group">
										<div class="guide">이름</div>
										<div class="input">
											<input type="text" value="오준우님의 5월 컬렉션">
										</div>
									</div>
									<div class="input-group">
										<div class="guide">설명</div>
										<div class="input">
											<input type="text" value="아주 재밌는 영상 모음 ㅇㅇㅇ">
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
							</div>	
							<div class="button-wrap">
								<button type="button">
									취소
								</button>
								<button type="button">
									만들기
								</button>
							</div>	
						</div>
					</div>
				</div>
			</div>
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

			// 유튜브 api 재생 클릭시 이벤트 설정
			var tag = document.createElement('script');

			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			var player;

			if ($(window).width() < 1040)
			{
				var yt_width = $(window).width() -48;
				var yt_height = Math.round((yt_width / 16) * 9);
			}else{
				var yt_width = '1200';
				var yt_height = '630';
			}

			function onYouTubeIframeAPIReady() {
				player = new YT.Player('video_area', {
					height: yt_height,
					width: yt_width,
					videoId: '<?=$yt_code_arr2[0]?>',
					events: {
						// 'onReady': onPlayerReady,
						'onStateChange': onPlayerStateChange
					}
				});
			}

			var play_flag = 0;
			function onPlayerStateChange(event) {
				if (event.data == 1)
				{
					if (play_flag == 0)
					{
						$.ajax({
							type   : "POST",
							async  : false,
							url    : "../main_exec.php",
							data:{
								"exec"				    : "view_video",
								"v_idx"		            : "<?=$video_idx?>"
							},
							success: function(response){
								console.log(response);
								if (response.match("Y") == "Y")
								{
									$("#play_count").html(Number($("#play_count").html()) + 1);
								}
							}
						});
					}
				}else if (event.data == 2){
					play_flag = 1;
				}
			}

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

			function like_video(v_idx)
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"				    : "like_video",
						"v_idx"		            : v_idx
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
							// alert("Like 되었습니다!");
							$(".action.like").addClass("is-active");
							$("#like_count").html(Number($("#like_count").html()) + 1);
						}else if (response.match("L") == "L"){
							alert("로그인 후 이용해 주세요!");
							location.href = "login.php?refurl=video_detail.php?idx=<?=$video_idx?>";
						}else{
							// alert("Like 에서 제외 되었습니다!");
							$(".action.like").removeClass("is-active");
							$("#like_count").html($("#like_count").html() - 1);
						}
					}
				});
			}

			function request_translate(v_idx)
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"				    : "request_translate",
						"v_idx"		            : v_idx
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
							alert("번역 요청이 접수 되었습니다. 번역이 완료되면 이메일로 알려드리겠습니다.");
						}else if (response.match("L") == "L"){
							alert("로그인 후 이용해 주세요!");
							location.href = "login.php?refurl=video_detail.php?idx=<?=$video_idx?>";
						}else{
							alert("다시 시도해 주세요.");
						}
					}
				});
			}

			function ins_comment(idx)
			{
				var comment_text 	= $("#comment_text").val();

				if (comment_text == "")
				{
					alert("댓글을 입력해 주세요.");
					return false;
				}

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"				    : "insert_comment",
						"idx"		            : idx,
						"comment_text"          : comment_text
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
							// alert("덧글이 입력되었습니다.");
							location.reload();
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
		</script>
	</body>

</html>