<?
    include_once "./include/autoload.php";

    $mnv_f          = new mnv_function();
    $my_db          = $mnv_f->Connect_MySQL();

    $video_pg               = $_REQUEST["video_pg"];
    $total_video_num        = $_REQUEST["total_video_num"];
    $total_page             = $_REQUEST["total_page"];
    $view_page              = $_REQUEST["view_page"];
    $search_keyword         = $_REQUEST["search_keyword"];
    $search_year            = $_REQUEST["search_year"];
    $search_nation          = $_REQUEST["search_nation"];
    $search_category1       = $_REQUEST["search_category1"];
    $search_genre           = $_REQUEST["search_genre"];
    $search_prize           = $_REQUEST["search_prize"];
    $sort_val               = $_REQUEST["sort_val"];

    if ($sort_val == "best")
        $order_by = " ORDER BY like_count DESC, play_count DESC, comment_count DESC";
    else
        $order_by = " ORDER BY video_idx DESC";
	$view_pg            = $view_page;
	$s_page				= $video_pg;

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
	if ($search_category1 != ""){
		$WHERE	.= " AND video_category1 = '".$search_category1."'";
	}
	if ($search_genre != ""){
		$WHERE	.= " AND video_genre = '".$search_genre."'";
	}
	if ($search_prize != ""){
		$WHERE	.= " AND video_awards like '%".$search_prize."%'";
	}

	// 전체 상품 갯수
	$all_query				= "SELECT * FROM video_info2 WHERE showYN='Y' ".$WHERE."";
	$all_result				= mysqli_query($my_db, $all_query);
	$all_video_num			= mysqli_num_rows($all_result);
 	$all_page				= ceil($all_video_num / $view_pg);

	$query			= "SELECT * FROM video_info2 WHERE showYN='Y' ".$WHERE." ".$order_by." LIMIT ".$s_page.", ".$view_pg."";
	$result			= mysqli_query($my_db, $query);
	$video_count	= mysqli_num_rows($result);
	// echo $all_video_num."||";
// print_r($query);
	$i = 0;
	while ($data = mysqli_fetch_array($result))
	{
 		// 영화제 검색
		// if ($search_prize != "")
		// {
		// 	$prize_query	= "SELECT * FROM awards_list_info WHERE 1 AND video_idx='".$data["video_idx"]."'";
		// 	$prize_result	= mysqli_query($my_db, $prize_query);
		// 	$prize_num		= mysqli_num_rows($prize_result);

		// 	if ($prize_num == 0)
		// 	{
		// 		continue;
		// 	}
		// }

        // 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

        // 제목 줄바꿈 방지 글자 자르기
        $title_count    = mb_strlen($data["video_title"],'utf-8');

        if ($title_count > 20)
            $video_title    = iconv_substr($data["video_title"],0,20)."..";
        else
            $video_title    = $data["video_title"];

        // 브랜드 줄바꿈 방지 글자 자르기
        $brand_count    = mb_strlen($data["video_brand"],'utf-8');

        if ($brand_count > 30)
            $video_brand    = iconv_substr($data["video_brand"],0,30)."..";
        else
            $video_brand    = $data["video_brand"];
?>
							<div class="video col-lg-4 col-md-3 col-sm-2">
								<a href="video_detail.php?idx=<?=$data['video_idx']?>">
									<figure>
                                        <div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
										<figcaption>
											<span class="brand">[<?=$video_brand?>]</span>
											<span class="title"><?=$video_title?></span>
											<span class="icon-wrap">
												<span class="play">
													<i class="icon"></i>
													<span class="cnt"><?=$data["play_count"]?></span>
												</span>
												<span class="comment">
													<i class="icon"></i>
													<span class="cnt"><?=$data["comment_count"]?></span>
												</span>
												<span class="like">
													<i class="icon"></i>
													<span class="cnt"><?=$data["like_count"]?></span>
												</span>
												<span class="collect">
													<i class="icon"></i>
													<span class="cnt"><?=$data["collect_count"]?></span>
												</span>
											</span>
										</figcaption>
									</figure>
								</a>
                            </div>
<?
    }
?>
    ||<?=$all_video_num?>||<?=$all_page?>||<?=$view_pg?>||<?=$query?>;
