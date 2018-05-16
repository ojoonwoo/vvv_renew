<?
    include_once "../include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

	$search_keyword		= $_REQUEST["keyword"];
	$search_year		= $_REQUEST["year"];
	$search_nation		= $_REQUEST["nation"];
	$search_category	= $_REQUEST["category"];
	$search_genre		= $_REQUEST["genre"];
	$search_prize		= $_REQUEST["prize"];
	$search_sort		= $_REQUEST["sort"];

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
					<div class="content vid-list">
						<div class="inner">
							<!--검색 영역-->
							<div class="search-wrapper">
								<div class="wrap">
									<div class="search-bar">
										<input type="text">
									</div>
									<button type="button" class="button-refresh">새로고침</button>
								</div>
								<div class="wrap sortings">
									<div class="sort-list">
										<div class="sort">
											<select name="lc-order-date" id="lc-order-date">
												<option disabled selected>연도</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-nation" id="lc-order-nation">
												<option disabled selected>국가</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-industry" id="lc-order-industry">
												<option disabled selected>산업군</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-genre" id="lc-order-genre">
												<option disabled selected>장르</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-awards" id="lc-order-awards">
												<option disabled selected>광고제</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-sortby" id="lc-order-sortby">
												<option disabled selected>분류</option>
												<option>Slower</option>
												<option>Slow</option>
												<option>Medium</option>
												<option>Fast</option>
												<option>Faster</option>
											</select>
										</div>
									</div>
									<button type="button" class="button-apply">
										APPLY
									</button>
								</div>
							</div>
							<!--검색 영역-->
							<div class="list-container">
								<div class="video-list">
<?
	$view_pg            = 12;
	$s_page				= 0;

	$WHERE 				= "";

	if ($search_keyword != "")
	{
		$WHERE	.= " AND (video_brand like '%".$search_keyword."%' OR video_title like '%".$search_keyword."%' OR video_desc like '%".$search_keyword."%')";
	}
	if ($search_year != ""){
		$WHERE	.= " AND video_date like '%".$search_year."%'";
	}
	if ($search_nation != ""){
		switch ($search_nation)
		{
			case "domestic" :
				$WHERE	.= " AND video_country = 'KOR'";
			break;
			case "foreign" :
				$WHERE	.= " AND video_country <> 'KOR'";
			break;
		}
	}
	if ($search_category != ""){
		$WHERE	.= " AND video_category1 = '".$search_category."'";
	}
	if ($search_genre != ""){
		$WHERE	.= " AND video_genre = '".$search_genre."'";
	}
	if ($search_prize != ""){
		$where	.= " AND video_awards like '%".$search_prize."%'";
	}

	if ($search_sort == "")
	{
		$ORDER = " ORDER BY video_idx DESC";
	}else{
		switch ($search_sort)
		{
			case "new" :
				$ORDER	= " ORDER BY video_idx DESC";
			break;
			case "best" :
				$ORDER	= " ORDER BY like_count DESC, collect_count DESC, play_count DESC";
			break;
		}
	}

	// 전체 영상 갯수
	$total_query		= "SELECT * FROM video_info2 WHERE showYN='Y' ".$WHERE." ".$ORDER."";
	$total_result		= mysqli_query($my_db, $total_query);
	$total_video_num	= mysqli_num_rows($total_result);
	$total_page			= ceil($total_video_num / $view_pg);
	$list_query	= "SELECT * FROM video_info2 WHERE 1 AND showYN='Y' ".$WHERE." ".$ORDER." LIMIT ".$s_page.", ".$view_pg."";
	// print_r($list_query);
    $list_result 	= mysqli_query($my_db, $list_query);
    while ($list_data = mysqli_fetch_array($list_result))
    {    
		// 영화제 검색
		// if ($search_prize != "")
		// {
		// 	$prize_query	= "SELECT * FROM awards_list_info WHERE 1 AND video_idx='".$list_data["video_idx"]."'";
		// 	$prize_result	= mysqli_query($my_db, $prize_query);
		// 	$prize_num		= mysqli_num_rows($prize_result);

		// 	if ($prize_num == 0)
		// 	{
		// 		continue;
		// 	}
		// }
        // 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $list_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

		$title_count    = mb_strlen($list_data["video_title"],'utf-8');
        if ($title_count > 20)
            $video_title    = iconv_substr($list_data["video_title"],0,20)."..";
        else
			$video_title    = $list_data["video_title"];
			
        // 브랜드 줄바꿈 방지 글자 자르기
        $brand_count    = mb_strlen($list_data["video_brand"],'utf-8');

        if ($brand_count > 30)
            $video_brand    = iconv_substr($list_data["video_brand"],0,30)."..";
        else
            $video_brand    = $list_data["video_brand"];
			
?>                            								
									<div class="video">
										<a href="video_detail.php?idx=<?=$list_data["video_idx"]?>">
											<figure>
												<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
												<figcaption>
													<span class="brand">[<?=$video_brand?>]</span>
													<span class="title"><?=$video_title?></span>
													<span class="icon-wrap">
														<span class="play">
															<i class="icon"></i>
															<span class="cnt"><?=$list_data["play_count"]?></span>
														</span>
														<span class="comment">
															<i class="icon"></i>
															<span class="cnt"><?=$list_data["comment_count"]?></span>
														</span>
														<span class="like">
															<i class="icon"></i>
															<span class="cnt"><?=$list_data["like_count"]?></span>
														</span>
														<span class="collect">
															<i class="icon"></i>
															<span class="cnt"><?=$list_data["collect_count"]?></span>
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
<?
	if ($total_video_num > 12)
	{
?>								
								<button type="button" class="read-more">
									<img src="./images/plus_icon.png" alt="">
								</button>
<?
	}
?>								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="cursor" class="defualt"></div>
		</div>
		<script>
			var video_pg 	        = 0;
			var total_video_num 	= <?=$total_video_num?>;
			var total_page 			= <?=$total_page?>;
			var view_page 			= <?=$view_pg?>;
			var current_page        = 1;

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

			// 검색 APPLY 클릭
			$doc.on('click', '.button-apply', function() {
				var search_keyword      = nullToBlank($("#lc-order-keyword").val());
				var search_year         = nullToBlank($("#lc-order-date").val());
				var search_nation       = nullToBlank($("#lc-order-nation").val());
				var search_category1    = nullToBlank($("#lc-order-industry").val());
				var search_genre        = nullToBlank($("#lc-order-genre").val());
				var search_prize        = nullToBlank($("#lc-order-awards").val());
				var search_sort         = nullToBlank($("#lc-order-sortby").val());

				// video_pg = video_pg + Number(view_page);
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_video.php",
					data:{
						"video_pg"				: video_pg,
						"view_page"				: view_page,
						"total_video_num"		: total_video_num,
						"total_page"			: total_page,
						"search_keyword"		: search_keyword,
						"search_year"			: search_year,
						"search_nation"			: search_nation,
						"search_category1"		: search_category1,
						"search_genre"			: search_genre,
						"search_prize"			: search_prize,
						"sort_val"				: search_sort
					},
					success: function(response){
						res_arr	= response.split("||");
						console.log(res_arr[4]);
						current_page = current_page + 1;
						// console.log(current_page+"||"+res_arr[2]);
						if (current_page > res_arr[2])
							$(".read-more").hide();
						else
							$(".read-more").show();
						// $("#list_video").append(response);
						$("#list_video").html(res_arr[0]);
					}
				});
			});

			// RECENT 더보기 버튼 클릭
			$doc.on('click', '.read-more', function() {
				var search_keyword      = nullToBlank($("#lc-order-keyword").val());
				var search_year         = nullToBlank($("#lc-order-date").val());
				var search_nation       = nullToBlank($("#lc-order-nation").val());
				var search_category1    = nullToBlank($("#lc-order-industry").val());
				var search_genre        = nullToBlank($("#lc-order-genre").val());
				var search_prize        = nullToBlank($("#lc-order-awards").val());
				var search_sort         = nullToBlank($("#lc-order-sortby").val());

				video_pg = video_pg + Number(view_page);
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_video.php",
					data:{
						"video_pg"				: video_pg,
						"view_page"				: view_page,
						"total_video_num"		: total_video_num,
						"total_page"			: total_page,
						"search_keyword"		: search_keyword,
						"search_year"			: search_year,
						"search_nation"			: search_nation,
						"search_category1"		: search_category1,
						"search_genre"			: search_genre,
						"search_prize"			: search_prize,
						"sort_val"				: search_sort
					},
					success: function(response){
						res_arr	= response.split("||");
						// console.log(res_arr[4]);
						current_page = current_page + 1;
						// console.log(current_page+"||"+res_arr[2]);
						if (current_page >= res_arr[2])
							$(".read-more").hide();
						else
							$(".read-more").show();
						$("#list_video").append(res_arr[0]);
						// $("#list_video").html(response);
					}
				});
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
			
			
		</script>
	</body>

</html>