<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();
    // if ($mobileYN == "MOBILE")
    // {
    //     echo "<script>location.href='m/index.php';</script>";
	// }
	$video_idx	= $_REQUEST["idx"];

	if ($mobileYN == "MOBILE")
    {
        echo "<script>location.href='./m/video_detail.php?idx=".$video_idx."';</script>";
    }

	// 영상 정보
	$detail_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$video_idx."'";
	$detail_result 	= mysqli_query($my_db, $detail_query);
	$detail_data	= mysqli_fetch_array($detail_result);

	// Like 여부 체크
	$like_query		= "SELECT * FROM like_info WHERE m_idx='".$_SESSION['ss_vvv_idx']."' AND v_idx='".$video_idx."' AND like_flag='Y'";
	$like_result	= mysqli_query($my_db, $like_query);

	$like_flag = "";
	if (mysqli_num_rows($like_result) > 0)
		$like_flag = "is-active";

	// $like_flag = "";
	// if (mysqli_num_rows($like_result) > 0)
	// 	$like_flag = "is-active";

	// Collectio 여부 체크
	$collection_flag 	= "";
	$c_flag_query		= "SELECT * FROM collection_item_info WHERE m_idx='".$_SESSION['ss_vvv_idx']."'";
	$c_flag_result		= mysqli_query($my_db, $c_flag_query);
	while ($c_flag_data = mysqli_fetch_array($c_flag_result))
	{
		$c_flag_arr	= explode(",", $c_flag_data["video_items"]);
		foreach ($c_flag_arr as $key => $val)
		{
			if ($val == $video_idx)
			{
				$collection_flag = "is-active";
			}
		}
	}

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
								<div class="player" id="video_area" data-mouse-type="hidden">
									<img src="./images/loading.jpg" alt="로딩 이미지">
									<!-- <img src="./images/detail_video_sample.jpg" alt=""> -->
								</div>
								<div class="actions">
									<a href="javascript:like_video('<?=$video_idx?>')" class="action like <?=$like_flag?>" id="like_img"></a>
<?
	if ($_SESSION['ss_vvv_idx'] != "")
	{
?>									
									<a href="javascript:void(0)" class="action collect <?=$collection_flag?>" data-popup="#collection-save"></a>
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
										<li><a href="javascript:void(0)" onclick="sns_share('fb')"><img src="./images/detail_share_fb.png" alt="페이스북 공유"></a></li>
										<!-- <li><a href="javascript:void(0)" onclick="sns_share('kt')"><img src="./images/detail_share_kt.png" alt="카카오톡 공유"></a></li> -->
										<li><a href="javascript:void(0)" class="clipboardBtn" onclick="sns_share('lk')" data-clipboard-text="http://minivertising-test.com/video_detail.php?idx=<?=$video_idx?>" data-toggle="tooltip"><img src="./images/detail_share_url.png" alt="링크 공유"></a></li>
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
												등록
											</button>
										</div>
									</div>
									<div class="comment-list">
<?
	$comment_query		= "SELECT * FROM comment_info WHERE v_idx='".$video_idx."' AND showYN='Y' ORDER BY idx DESC";
	$comment_result		= mysqli_query($my_db, $comment_query);

	while ($comment_data = mysqli_fetch_array($comment_result))
	{
		$comment_mb_query		= "SELECT * FROM member_info WHERE idx='".$comment_data["mb_idx"]."'";
		$comment_mb_result		= mysqli_query($my_db, $comment_mb_query);
		$comment_mb_data		= mysqli_fetch_array($comment_mb_result);

		if ($comment_mb_data["mb_nickname"] != "")
			$comment_data["mb_name"] = $comment_mb_data["mb_nickname"];
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
<?
		if ($_SESSION["ss_vvv_idx"] == $comment_data["mb_idx"])
		{
?>											
											<div class="actions">
												<button type="button" class="remove-comment" onclick="remove_comment('<?=$comment_data["idx"]?>','<?=$video_idx?>')"></button>
											</div>
<?
		}
?>											
										</div>
<?
	}
?>
										
										<!-- <div class="row">
											<div class="u-id">
												ojoonwoo
											</div>
											<div class="u-comment">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor consectetur facere incidunt ipsum aspernatur beatae impedit amet asperiores ab delectus repellat expedita laborum alias, perferendis mollitia eveniet doloremque nulla quis?
											</div>
											<div class="date">
												2018-01-01
											</div>
										</div> -->
									</div>
								</div>
<?
	$related_query		= "SELECT * FROM video_info2 WHERE video_brand='".$detail_data["video_brand"]."' AND video_idx NOT IN ('".$detail_data["video_idx"]."') ORDER BY like_count DESC LIMIT 3";
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
											<div class="video col-lg-3 col-md-3 col-sm-2">
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
			<? 	include_once "cursor.php"; ?>
			<div class="popup collection-pick" id="collection-save">
				<button type="button" class="popup-close" data-popup="@close"></button>
				<div class="inner">
					<div class="title">
						<h5>Collection</h5>
					</div>
					<div class="content">
						<div class="block video-info">
							<figure>
								<div class="thumbnail" style="background: url(<?=$yt_thumb?>) center / 100% auto no-repeat; padding-bottom: 62.59%;"></div>
								<figcaption>
									<div class="vid-brand"><?=$detail_data["video_brand"]?></div>
									<div class="vid-title"><?=$detail_data["video_title"]?></div>
									<div class="vid-date"><?=$detail_data["video_date"]?></div>
								</figcaption>
							</figure>
						</div>
						<div class="block collection-info" id="choice_collection">
							<h6>컬렉션 선택</h6>
							<div class="collection-list">
								<div class="scroll-box">
									<ul id="my_collection_list">
<?
	// 컬렉션 리스트 정보
	$collection_query	= "SELECT * FROM collection_info WHERE 1 AND collection_mb_idx='".$_SESSION["ss_vvv_idx"]."' AND collection_showYN='Y'";
	$collection_result 	= mysqli_query($my_db, $collection_query);

	while($collection_data = mysqli_fetch_array($collection_result))
	{
		$secret_flag	= "";
		if ($collection_data["collection_secret"] == "N")
			$secret_flag	= "is-secret";
?>										
										<li class="c-info <?=$secret_flag?>">
											<span onclick="collect_video('<?=$video_idx?>','<?=$collection_data["idx"]?>');"><?=$collection_data["collection_name"]?></span><i class="secret"></i>
										</li>
<?
	}
?>										
										<!-- <li class="c-info is-secret">
											<span>asd</span><i class="secret"></i>
										</li> -->
									</ul>
								</div>
							</div>
							<!-- <button type="button" class="btn-add" data-popup="#collection-add"> -->
							<button type="button" class="btn-add" onclick="open_add_collection()">
								<span class="icon"></span>
								<span>컬렉션 추가하기</span>
							</button>
						</div>
						<div class="block collection-info" id="add_collection" style="display:none;">
							<h6>컬렉션 추가하기</h6>
							<div class="collection-setting">
								<div class="input-group">
									<div class="guide">이름</div>
									<div class="input">
										<input type="text" id="collection_name">
									</div>
								</div>
								<div class="input-group">
									<div class="guide">설명</div>
									<div class="input">
										<input type="text" id="collection_desc">
									</div>
								</div>
								<div class="setting">
									<span class="secret-guide">비밀 설정</span>
									<!-- <div class="toggle secret is-active"> -->
									<div class="toggle secret">
										<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="secret" name="secret" checked>
										<div class="toggle-circle"></div>
									</div>
								</div>
								<div class="button-wrap">
									<!-- <button type="button" data-popup="@close"> -->
									<button type="button" onclick="cancel_create_collection()">
										취소
									</button>
									<button type="button" onclick="create_collection()">
										만들기
									</button>
								</div>	
							</div>	
						</div>
					</div>
				</div>
			</div>
			<div class="popup collection-pick" id="collection-add">
				<button type="button" class="popup-close" data-popup="@close"></button>
				<div class="inner">
					<div class="title">
						<h5>Collection</h5>
					</div>
					<div class="content">
						<div class="block video-info">
							<figure>
								<div class="thumbnail" style="background: url(<?=$yt_thumb?>) 0 0 / 100% auto no-repeat; padding-bottom: 62.59%;"></div>
								<figcaption>
									<div class="vid-brand"><?=$detail_data["video_brand"]?></div>
									<div class="vid-title"><?=$detail_data["video_title"]?></div>
									<div class="vid-date"><?=$detail_data["video_date"]?></div>
								</figcaption>
							</figure>

						</div>
						<div class="block collection-info">
							<h6>컬렉션 추가하기</h6>
							<div class="collection-setting">
								<div class="input-group">
									<div class="guide">이름</div>
									<div class="input">
										<input type="text" id="collection_name">
									</div>
								</div>
								<div class="input-group">
									<div class="guide">설명</div>
									<div class="input">
										<input type="text" id="collection_desc">
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
									<button type="button" data-popup="@close">
										취소
									</button>
									<button type="button" onclick="create_collection()">
										만들기
									</button>
								</div>	
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="./lib/clipboard/dist/clipboard.min.js"></script>
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
			$doc = $(document);
			
//			공유 버튼 토글
			$doc.on('click', '.actions .share', function() {
				$(this).toggleClass('is-active');
				return false;
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

			function collect_video(v_idx, c_idx)
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
					data:{
						"exec"				    : "collect_video",
						"v_idx"		            : v_idx,
						"c_idx"		            : c_idx
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
							alert("선택하신 컬렉션에 영상이 담겼습니다");
							vvv.popup.close($("#collection-save"));
						}else if (response.match("D") == "D"){
							alert("선택하신 컬렉션에 이미 해당 영상이 담겨 있습니다");
						}else{
							alert("다시 시도해 주세요");
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
				var secretFlag			= "";
				var appendTxt			= "";

				if (collection_secret === false)
				{
					secretFlag = "is-secret";
				}

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
						"exec"				    : "create_detail_collection",
						"collection_name"       : collection_name,
						"collection_desc"		: collection_desc,
						"collection_secret"		: collection_secret
					},
					success: function(response){
						console.log(response);
						res_arr 	= response.split("||");
						if (res_arr[0].match("Y") == "Y")
						{
							appendTxt += "<li class='c-info "+ secretFlag +"'>";
							appendTxt += "<span onclick=collect_video('<?=$video_idx?>','" + res_arr[1] + "');>" + collection_name + "</span><i class='secret'></i>";
							appendTxt += "</li>";

							$("#my_collection_list").append(appendTxt);
							// vvv.popup.close($("#collection-add"));
							$("#choice_collection").show();
							$("#add_collection").hide();
						}else if (res_arr[0].match("D") == "D"){
							alert("이미 생성된 컬렉션 이름입니다. 다른 이름으로 생성해 주세요.")
						}else{
							alert("다시 입력해 주세요.");
							// location.reload();
						}
					}
				});			

			}

			function cancel_create_collection()
			{
				$("#choice_collection").show();
				$("#add_collection").hide();				
			}
			
			function open_add_collection()
			{
				$("#choice_collection").hide();
				$("#add_collection").show();
			}

			function request_translate(v_idx)
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
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
					url    : "./main_exec.php",
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

			function remove_comment(idx, v_idx)
			{
				if (confirm("댓글을 삭제 할까요?"))
				{
					$.ajax({
						type   : "POST",
						async  : false,
						url    : "./main_exec.php",
						data:{
							"exec"				    : "remove_comment",
							"v_idx"		            : v_idx,
							"idx"		            : idx
						},
						success: function(response){
							console.log(response);
							if (response.match("Y") == "Y")
							{
								alert("댓글이 삭제되었습니다.");
								location.reload();
							}else{
								alert("다시 시도해 주세요.");
								location.reload();
							}
						}
					});					
				}
			}

			function sns_share(media)
			{
				if (media == "fb")
				{

					var newWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('http://www.minivertising-test.com/video_detail.php?idx=<?=$video_idx?>'),'sharer','toolbar=0,status=0,width=600,height=325');
					$.ajax({
						type   : "POST",
						async  : false,
						url    : "./main_exec.php",
						data:{
							"exec"      : "insert_share_info",
							"sns_media" : media
						}
					});
				} else if(media == "kt") {
					Kakao.Link.sendTalkLink({
						label: "<?='['.$detail_data['video_company'].'] '.$detail_data['video_title']?>",
						image: {
							src: "<?=$yt_thumb?>",
							width: '1200',
							height: '630'
						},
						webButton: {
							text: "영상 보러 가기",
							url: 'http://www.minivertising-test.com/video_detail.php?idx=<?=$video_idx?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
						}
					});
					$.ajax({
						type   : "POST",
						async  : false,
						url    : "./main_exec.php",
						data:{
							"exec"      : "insert_share_info",
							"sns_media" : media
						},
						success: function(res) {
							console.log(res);
						}
					});
				} else {
					var clipboard = new Clipboard('.clipboardBtn');
					clipboard.on('success', function(e) {
						console.info('Action:', e.action);
						console.info('Text:', e.text);
						console.info('Trigger:', e.trigger);
						$('.spread .lk').tooltip('show');
						e.clearSelection();

						alert("링크가 클립보드에 복사되었습니다.");

						$.ajax({
							type   : "POST",
							async  : false,
							url    : "./main_exec.php",
							data:{
								"exec"      : "insert_share_info",
								"sns_media" : media
							},
							success: function(res) {
								console.log(res);
							}
						});
					});
					clipboard.on('error', function(e) {
					console.error('Action:', e.action);
					console.error('Trigger:', e.trigger);
					});
				}
			}

		</script>
	</body>

</html>