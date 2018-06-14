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
							<div class="list-container">
								<div class="video-list" id="list_video">
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
		$WHERE	.= " AND video_awards like '%".$search_prize."%'";
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
    $list_result 	= mysqli_query($my_db, $list_query);

	while ($list_data = mysqli_fetch_array($list_result))
    {    
        // 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $list_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

		// $title_count    = mb_strlen($list_data["video_title"],'utf-8');
        // if ($title_count > 20)
        //     $video_title    = iconv_substr($list_data["video_title"],0,20)."..";
        // else
		// 	$video_title    = $list_data["video_title"];
			
        // // 브랜드 줄바꿈 방지 글자 자르기
        // $brand_count    = mb_strlen($list_data["video_brand"],'utf-8');

        // if ($brand_count > 30)
        //     $video_brand    = iconv_substr($list_data["video_brand"],0,30)."..";
        // else
        //     $video_brand    = $list_data["video_brand"];

			$video_title    = $list_data["video_title"];
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
<?
	if ($total_video_num < 1) {
?>
								<div class="result-empty">
									<p>검색결과가 없습니다</p>
									<p>다른 키워드로 검색을 시도해보세요!</p>
								</div>							
<?
	}
?>
							</div>
						</div>
					</div>
				</div>
<? include_once "footer_layer.php"; ?>
			</div>
<? 	include_once "cursor.php"; ?>
		</div>
		<script>
			
			var video_pg 	        = 0;
			var total_video_num 	= <?=$total_video_num?>;
			var total_page 			= <?=$total_page?>;
			var view_page 			= <?=$view_pg?>;
			var current_page        = 1;

			$doc = $(document);
			
			// 검색 APPLY 클릭
//			$doc.on('click', '.button-apply', function() {
//				var search_keyword      = nullToBlank($("#lc-order-keyword").val());
//				var search_year         = nullToBlank($("#lc-order-date").val());
//				var search_nation       = nullToBlank($("#lc-order-nation").val());
//				var search_category1    = nullToBlank($("#lc-order-industry").val());
//				var search_genre        = nullToBlank($("#lc-order-genre").val());
//				var search_prize        = nullToBlank($("#lc-order-awards").val());
//				var search_sort         = nullToBlank($("#lc-order-sortby").val());
//
//				// video_pg = video_pg + Number(view_page);
//				$.ajax({
//					type   : "POST",
//					async  : false,
//					url    : "./ajax_video.php",
//					data:{
//						"video_pg"				: video_pg,
//						"view_page"				: view_page,
//						"total_video_num"		: total_video_num,
//						"total_page"			: total_page,
//						"search_keyword"		: search_keyword,
//						"search_year"			: search_year,
//						"search_nation"			: search_nation,
//						"search_category1"		: search_category1,
//						"search_genre"			: search_genre,
//						"search_prize"			: search_prize,
//						"sort_val"				: search_sort
//					},
//					success: function(response){
//						res_arr	= response.split("||");
//						console.log(res_arr[4]);
//						current_page = current_page + 1;
//						// console.log(current_page+"||"+res_arr[2]);
//						if (current_page > res_arr[2])
//							$(".read-more").hide();
//						else
//							$(".read-more").show();
//						// $("#list_video").append(response);
//						$("#list_video").html(res_arr[0]);
//					}
//				});
//			});

			// RECENT 더보기 버튼 클릭
			$doc.on('click', '.read-more', function() {
				var search_keyword      = nullToBlank($("#search_keyword").val());
				var search_year         = nullToBlank($("#order-date").val());
				var search_nation       = nullToBlank($("#order-nation").val());
				var search_category1    = nullToBlank($("#order-industry").val());
				var search_genre        = nullToBlank($("#order-genre").val());
				var search_prize        = nullToBlank($("#order-awards").val());
				var search_sort         = nullToBlank($("#order-sortby").val());

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
						console.log(response);
						res_arr	= response.split("||");
						// console.log(res_arr[4]);
						current_page = current_page + 1;
						// console.log(current_page+"||"+res_arr[2]);
						if (current_page >= res_arr[2])
							$(".read-more").hide();
						else
							$(".read-more").show();
						
						$("#list_video").append(res_arr[0]);
						$("#list_video > .video.loaded").each(function(index) {
							(function(that, i) { 
								var t = setTimeout(function() { 
									$(that).removeClass('loaded');
								}, 500 * i);
							})(this, index);

						});
						// $("#list_video").html(response);
					}
				});
			});

		</script>
	</body>

</html>