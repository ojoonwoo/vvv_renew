<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    // if ($mobileYN == "MOBILE")
    // {
    //     echo "<script>location.href='m/index.php';</script>";
	// }
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
									<!-- <img src="./images/loading.jpg" alt="로딩 이미지"> -->
									<img src="./images/detail_video_sample.jpg" alt="">
								</div>
								<div class="actions">
									<a href="javascript:like_video('<?=$video_idx?>')" class="action like <?=$like_flag?>" id="like_img"></a>
									<a href="" class="action collect"></a>
									<a href="" class="action translate"><span>번역</span></a>
									<a href="" class="action share"></a>
									<ul class="share-spread">
										<li><a href="#"><img src="./images/detail_share_fb.png" alt="페이스북 공유"></a></li>
										<li><a href="#"><img src="./images/detail_share_kt.png" alt="카카오톡 공유"></a></li>
										<li><a href="#"><img src="./images/detail_share_url.png" alt="링크 공유"></a></li>
									</ul>
								</div>
								<div class="block-comment">
									<h5>comment</h5>
									<div class="input-group">
										<div class="text-box">
											<input type="text">
										</div>
										<div class="button">
											<button type="button" class="button-submit">
												등록
											</button>
										</div>
									</div>
									<div class="comment-list">
										<div class="row">
											<div class="u-id">
												ojoonwoo
											</div>
											<div class="u-comment">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit.
											</div>
											<div class="date">
												2018-01-01
											</div>
										</div>
										<div class="row">
											<div class="u-id">
												ojoonwoo
											</div>
											<div class="u-comment">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor consectetur facere incidunt ipsum aspernatur beatae impedit amet asperiores ab delectus repellat expedita laborum alias, perferendis mollitia eveniet doloremque nulla quis?
											</div>
											<div class="date">
												2018-01-01
											</div>
										</div>
									</div>
								</div>
								<div class="block-related">
									<h5>관련 영상</h5>
									<div class="list-container">
										<div class="video-list">
											<div class="video col-lg-3 col-md-3 col-sm-2">
												<a href="#">
													<figure>
														<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
														<figcaption>
															<span class="brand">[UNICEF]</span>
															<span class="title">Furniture That Hides From Hurting copy 4</span>
															<span class="icon-wrap">
																<span class="play">
																	<i class="icon"></i>
																	<span class="cnt">4</span>
																</span>
																<span class="comment">
																	<i class="icon"></i>
																	<span class="cnt">0</span>
																</span>
																<span class="like">
																	<i class="icon"></i>
																	<span class="cnt">2</span>
																</span>
																<span class="collect">
																	<i class="icon"></i>
																	<span class="cnt">2</span>
																</span>
															</span>
														</figcaption>
													</figure>
												</a>
											</div>
											<div class="video col-lg-3 col-md-3 col-sm-2">
												<a href="#">
													<figure>
														<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
														<figcaption>
															<span class="brand">[UNICEF]</span>
															<span class="title">Furniture That Hides From Hurting copy 4</span>
															<span class="icon-wrap">
																<span class="play">
																	<i class="icon"></i>
																	<span class="cnt">4</span>
																</span>
																<span class="comment">
																	<i class="icon"></i>
																	<span class="cnt">0</span>
																</span>
																<span class="like">
																	<i class="icon"></i>
																	<span class="cnt">2</span>
																</span>
																<span class="collect">
																	<i class="icon"></i>
																	<span class="cnt">2</span>
																</span>
															</span>
														</figcaption>
													</figure>
												</a>
											</div>
											<div class="video col-lg-3 col-md-3 col-sm-2">
												<a href="#">
													<figure>
														<div class="thumbnail box-bg" style="background: url(./images/main_video_thumb.jpg) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
														<figcaption>
															<span class="brand">[UNICEF]</span>
															<span class="title">Furniture That Hides From Hurting copy 4</span>
															<span class="icon-wrap">
																<span class="play">
																	<i class="icon"></i>
																	<span class="cnt">4</span>
																</span>
																<span class="comment">
																	<i class="icon"></i>
																	<span class="cnt">0</span>
																</span>
																<span class="like">
																	<i class="icon"></i>
																	<span class="cnt">2</span>
																</span>
																<span class="collect">
																	<i class="icon"></i>
																	<span class="cnt">2</span>
																</span>
															</span>
														</figcaption>
													</figure>
												</a>
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

			// 유튜브 api 재생 클릭시 이벤트 설정
			var tag = document.createElement('script');

			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			var player;

			if ($(window).width() < 1040)
			{
				var yt_width = $(window).width();
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
							url    : "./main_exec.php",
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

			function like_video(v_idx)
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
					data:{
						"exec"				    : "like_video",
						"v_idx"		            : v_idx
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
							alert("Like 되었습니다!");
							$(".action.like").addClass("is-active");
							$("#like_count").html(Number($("#like_count").html()) + 1);
						}else if (response.match("L") == "L"){
							alert("로그인 후 이용해 주세요!");
							location.href = "login.php?refurl=video_detail.php?idx=<?=$video_idx?>";
						}else{
							alert("Like 에서 제외 되었습니다!");
							$(".action.like").removeClass("is-active");
							$("#like_count").html($("#like_count").html() - 1);
						}
					}
				});
			}

		</script>
	</body>

</html>