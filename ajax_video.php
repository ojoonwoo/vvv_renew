<?
    include_once "./include/autoload.php";

    $mnv_f          = new mnv_function();
    $my_db          = $mnv_f->Connect_MySQL();

    $video_pg               = $_REQUEST["video_pg"];
    $total_video_num        = $_REQUEST["total_video_num"];
    $total_page             = $_REQUEST["total_page"];
    $search_keyword         = $_REQUEST["search_keyword"];
    $sort_val               = $_REQUEST["sort_val"];

    if ($sort_val == "new")
        $order_by = " ORDER BY idx DESC";
    else
        $order_by = " ORDER BY like_count DESC, play_count DESC, comment_count DESC";
	$view_pg            = 8;
	$s_page				= $video_pg;

	if ($search_keyword != "")
		$where 	= " AND (video_company like '%".$search_keyword."%' OR video_title like '%".$search_keyword."%' OR video_desc like '%".$search_keyword."%')";
	else
		$where	= "";

	// 전체 상품 갯수
	$all_query				= "SELECT * FROM video_info2 WHERE showYN='Y' ".$where."";
	$all_result				= mysqli_query($my_db, $all_query);
	$all_video_num			= mysqli_num_rows($all_result);
 	$all_page				= ceil($all_video_num / $view_pg);

	$query			= "SELECT * FROM video_info2 WHERE showYN='Y' ".$where." ".$order_by." LIMIT ".$s_page.", ".$view_pg."";
	$result			= mysqli_query($my_db, $query);
	// $video_count	= mysqli_num_rows($result);
	// echo $all_video_num."||";

	$i = 0;
	while ($data = mysqli_fetch_array($result))
	{
        // 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

        $title_count    = mb_strlen($data["video_title"],'utf-8');

        if ($title_count > 30)
            $video_title    = substr($data["video_title"],0,30)."...";
        else
            $video_title    = $data["video_title"];
?>
							<div class="video col-lg-4 col-md-3 col-sm-2">
								<a href="#">
									<figure>
                                        <div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
										<figcaption>
											<span class="brand">[<?=$data["video_brand"]?>]</span>
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
