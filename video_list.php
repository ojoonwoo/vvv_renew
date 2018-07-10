<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();

	$search_keyword		= $_REQUEST["keyword"];
	$search_year		= $_REQUEST["year"];
	$search_nation		= $_REQUEST["nation"];
	$search_category	= $_REQUEST["category"];
	$search_genre		= $_REQUEST["genre"];
	$search_prize		= $_REQUEST["prize"];
	$search_sort		= $_REQUEST["sort"];

	//페이징 코드
//	$pg = $_REQUEST['pg'];
//	if(!$pg) $pg = 1;	// $pg가 없으면 1로 생성

	// if ($mobileYN == "MOBILE")
    // {
    //     echo "<script>location.href='m/index.php';</script>";
    // }
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
				<a href="javascript:void(0)" id="go-top">
					<img src="./images/go_top.png" alt="go top">
				</a>
				<!--페이징 코드-->
<!--
				<form name="frm_execute" method="GET">
					<input type="hidden" name="pg" value="<?=$pg?>">
				</form>
-->
				<div class="main-container">
					<div class="content vid-list">
						<div class="inner">
							<!--검색 영역-->
							<div class="search-wrapper">
								<div class="wrap">
									<div class="search-bar">
										<input type="text" id="lc-order-keyword" value="<?=$search_keyword?>">
									</div>
								</div>
								<div class="wrap sortings">
									<div class="sort-list">
										<button type="button" class="button-refresh" onclick="location.href='video_list.php';">새로고침</button>
										<div class="sort">
											<select name="lc-order-date" id="lc-order-date">
												<option value="" selected>연 도</option>
<?
    $s_year = 2018;
    while( $s_year > 2010 )
    {
?>        
										        <option value="<?=$s_year?>" <?if($search_year == $s_year){?>selected<?}?>><?=$s_year?></option>
<?
        $s_year--;
    }
?>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-nation" id="lc-order-nation">
												<option value="" selected>국 가</option>
												<option value="domestic" <?if($search_nation == "domestic"){?>selected<?}?>>국 내</option>
												<option value="foreign" <?if($search_nation == "foreign"){?>selected<?}?>>해 외</option>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-industry" id="lc-order-industry">
												<option value="" selected>산업군</option>
<?
    $category1_query	= "SELECT * FROM category_info WHERE category_level='1' AND category_useYN='Y'";
    $category1_result 	= mysqli_query($my_db, $category1_query);
    while ($category1_data = mysqli_fetch_array($category1_result))
    {
?>
										        <option value="<?=$category1_data["idx"]?>" <?if($search_category == $category1_data["idx"]){?>selected<?}?>><?=$category1_data["category_name"]?></option>
<?
    }    
?>
											</select>
										</div>
										<div class="sort">
											<select name="lc-order-genre" id="lc-order-genre">
												<option value="" selected>장 르</option>
<?
    $genre_query	= "SELECT * FROM genre_info WHERE genre_showYN='Y'";
    $genre_result 	= mysqli_query($my_db, $genre_query);
    while ($genre_data = mysqli_fetch_array($genre_result))
    {
?>
										        <option value="<?=$genre_data["idx"]?>" <?if($search_genre == $genre_data["idx"]){?>selected<?}?>><?=$genre_data["genre_name"]?></option>
<?
    }    
?>
											</select>
										</div>
<!--
										<div class="sort">
											<select name="lc-order-awards" id="lc-order-awards">
												<option value="" selected>광고제</option>
												<option value="1" <?if($search_prize == "1"){?>selected<?}?>>CLIO</option>
												<option value="3" <?if($search_prize == "3"){?>selected<?}?>>CANNE</option>
												<option value="2" <?if($search_prize == "2"){?>selected<?}?>>NYF</option>
											</select>
										</div>
-->
										<div class="sort">
											<select name="lc-order-sortby" id="lc-order-sortby">
												<option value="" disabled selected>분 류</option>
												<option value="new" <?if($search_sort == "new"){?>selected<?}?>>최신순</option>
										        <option value="best" <?if($search_sort == "best"){?>selected<?}?>>인기순</option>
										        <option value="reg" <?if($search_sort == "reg"){?>selected<?}?>>등록순</option>
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
								<div class="video-list" id="list_video">
<?
	$view_pg            = 12;
	// 페이징 코드
//	$block_size 		= 9;	// 한 화면에 나타낼 페이지 번호 개수
	$s_page				= 0;

	$WHERE 				= "";

	if ($search_keyword != "")
	{
		$where_q_txt		= "";
		$cate_query		= "SELECT * FROM category_info WHERE category_name like '%".$search_keyword."%' AND category_level='1'";
		$cate_result	= mysqli_query($my_db, $cate_query);
		while ($cate_data = mysqli_fetch_array($cate_result))
		{
			$where_q_txt .= " OR video_category1='".$cate_data["idx"]."'";
		}
		
		$genre_query	= "SELECT * FROM genre_info WHERE genre_name like '%".$search_keyword."%' AND genre_showYN='Y'";
		$genre_result	= mysqli_query($my_db, $genre_query);
		while ($genre_data = mysqli_fetch_array($genre_result))
		{
			$where_q_txt .= " OR video_genre='".$genre_data["idx"]."'";
		}

		if ($search_keyword == "깐느" || $search_keyword == "칸느" || strtolower($search_keyword) == "canne")
			$where_q_txt .= " OR video_awards='3'";
		
		if ($search_keyword == "클리오" || $search_keyword == "끌리오" || strtolower($search_keyword) == "clio")
			$where_q_txt .= " OR video_awards='1'";
		
		if ($search_keyword == "뉴욕" || $search_keyword == "뉴욕페스티발" || strtolower($search_keyword) == "nyf")
			$where_q_txt .= " OR video_awards='2'";
		
		$WHERE	.= " AND (video_brand like '%".$search_keyword."%' OR video_title like '%".$search_keyword."%' OR video_desc like '%".$search_keyword."%'".$where_q_txt.")";
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
		$WHERE	.= " AND video_genre = '%".$search_genre."%'";
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
				$ORDER	= " ORDER BY video_date DESC";
			break;
			case "best" :
				$ORDER	= " ORDER BY like_count DESC, collect_count DESC, play_count DESC";
			break;
			case "reg" :
				$ORDER	= " ORDER BY idx DESC";
			break;
		}
	}

	// 전체 영상 갯수
	$total_query		= "SELECT * FROM video_info2 WHERE showYN='Y' ".$WHERE." ".$ORDER."";
	$total_result		= mysqli_query($my_db, $total_query);
	$total_video_num	= mysqli_num_rows($total_result);
	$total_page			= ceil($total_video_num / $view_pg);
									
	// 페이징 코드
//	$PAGE_CLASS = new mnv_page($pg,$total_video_num,$view_pg,$block_size);
//	$BLOCK_LIST = $PAGE_CLASS->blockList5();
//	$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
									
	$list_query	= "SELECT * FROM video_info2 WHERE 1 AND showYN='Y' ".$WHERE." ".$ORDER." LIMIT ".$s_page.", ".$view_pg."";
	// print_r($list_query);
//	페이징 코드
//	$list_query	= "SELECT * FROM video_info2 WHERE 1 AND showYN='Y' ".$WHERE." ".$ORDER." LIMIT ".$PAGE_CLASS->page_start.", ".$view_pg."";
	// print_r($list_query);
    $list_result 	= mysqli_query($my_db, $list_query);
    while ($list_data = mysqli_fetch_array($list_result))
    {    
        // 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $list_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

//		$title_count    = mb_strlen($list_data["video_title"],'utf-8');
//        if ($title_count > 20)
//            $video_title    = iconv_substr($list_data["video_title"],0,20)."..";
//        else
//			$video_title    = $list_data["video_title"];
//			
//        // 브랜드 줄바꿈 방지 글자 자르기
//        $brand_count    = mb_strlen($list_data["video_brand"],'utf-8');
//
//        if ($brand_count > 30)
//            $video_brand    = iconv_substr($list_data["video_brand"],0,30)."..";
//        else
//            $video_brand    = $list_data["video_brand"];
		
		$video_title    = $list_data["video_title"];
		$video_brand    = $list_data["video_brand"];
			
?>                            
									<div class="video col-lg-4 col-md-3 col-sm-2">
										<a href="video_detail.php?idx=<?=$list_data['video_idx']?>">
											<figure>
<?
	if (!empty($list_data["video_awards"]))
	{
?>												
												<div class="prize_icon">
													<img src="./images/prize_winner.png" alt="수상작">
												</div>
<?
	}
?>												
												<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52%;"></div>
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
<!--
									 <input type="hidden" id="total_video_num" value="<?=$total_video_num?>">
									<input type="hidden" id="total_page" value="<?=$total_page?>">                     
									<input type="hidden" id="view_page" value="<?=$view_pg?>">                      
-->
								</div>
								<button type="button" class="read-more <?= ($total_video_num < 12) ? 'hide' : '' ?>">
									<img src="./images/plus_icon.png" alt="">
								</button>
								<!--페이징 코드-->
<!--							<?php echo $BLOCK_LIST?>-->
								<div class="result-empty <?= ($total_video_num > 0) ? 'hide' : '' ?>">
									<p>검색결과가 없습니다</p>
									<p>다른 키워드로 검색을 시도해보세요!</p>
								</div>
							</div>
						</div>
					</div>
				</div>
<? 	include_once "footer_layer.php"; ?>
			</div>
<? 	include_once "cursor.php"; ?>
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
			$doc = $(document);

			// 검색 APPLY 클릭
			function nullToBlank(str)
			{
				if (str == null)
					str = "";

				return str;
			}
			
			$doc.on('click', '.button-apply', function() {
				var search_keyword      = nullToBlank($("#lc-order-keyword").val());
				var search_year         = nullToBlank($("#lc-order-date").val());
				var search_nation       = nullToBlank($("#lc-order-nation").val());
				var search_category1    = nullToBlank($("#lc-order-industry").val());
				var search_genre        = nullToBlank($("#lc-order-genre").val());
				var search_prize        = nullToBlank($("#lc-order-awards").val());
				var search_sort         = nullToBlank($("#lc-order-sortby").val());
				video_pg				= 0;
				current_page 			= 1;
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
						current_page = current_page + 1;
						// console.log(current_page+"||"+res_arr[2]);
						if(res_arr[1] < 1)
							$(".result-empty").removeClass('hide');
						else
							$(".result-empty").addClass('hide');

						if (current_page > res_arr[2])
							$(".read-more").addClass('hide');
						else
							$(".read-more").removeClass('hide');
						// $("#list_video").append(response);
						$("#list_video").html(res_arr[0]);
						$("#list_video > .video.loaded").each(function(index) {
							(function(that, i) { 
								var t = setTimeout(function() { 
									$(that).removeClass('loaded');
								}, 100 * i);
							})(this, index);

						});
						
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
						console.log(current_page+"///"+res_arr[2]);
						if (current_page >= res_arr[2])
							$(".read-more").addClass('hide');
						else
							$(".read-more").removeClass('hide');
						$("#list_video").append(res_arr[0]);
						$("#list_video > .video.loaded").each(function(index) {
							(function(that, i) { 
								var t = setTimeout(function() { 
									$(that).removeClass('loaded');
								}, 100 * i);
							})(this, index);

						});
					}
				});
			});

			
			//페이징 코드
//			function pageRun(num)
//			{
//				f = document.frm_execute;
//				f.pg.value = num;
//				f.submit();
//			}
		</script>
	</body>

</html>