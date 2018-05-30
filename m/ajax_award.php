<?
    include_once "../include/autoload.php";

    $mnv_f          = new mnv_function();
    $my_db          = $mnv_f->Connect_MySQL();

    $award          	    = $_REQUEST["award"];
    $award_date		        = $_REQUEST["award_date"];

	if ($award < 4)
	    $award_query	= "SELECT * FROM awards_list_info WHERE 1 AND awards_name='".$award."' AND awards_winner_year='".$award_date."' GROUP BY video_idx";
	else
		$award_query	= "SELECT * FROM awards_list_info WHERE 1 AND awards_idx='".$award."' AND awards_winner_year='".$award_date."' GROUP BY video_idx";

	$award_result 	= mysqli_query($my_db, $award_query);

    while ($award_data = mysqli_fetch_array($award_result))
    {    
		$video_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$award_data["video_idx"]."'";
		$video_result 	= mysqli_query($my_db, $video_query);
		$video_data		= mysqli_fetch_array($video_result);

		// 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $video_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

        $title_count    = mb_strlen($video_data["video_title"],'utf-8');

        if ($title_count > 45)
            $video_title    = substr($video_data["video_title"],0,45)."...";
        else
			$video_title    = $video_data["video_title"];
?>		
									<div class="video loaded">
										<a href="video_detail.php?idx=<?=$video_data["video_idx"]?>">
											<figure>
												<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
												<figcaption>
													<span class="brand">[<?=$video_data["video_brand"]?>]</span>
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
?>
||
<?
    if ($award == "1")
        $award_name = "CLIO";
    else if ($award == "2")
        $award_name = "NYF";
    else
        $award_name = "CAN";

    $award_query	= "SELECT * FROM awards_info WHERE 1 AND awards_name='".$award_name."'";
    $award_result 	= mysqli_query($my_db, $award_query);
    while ($award_data = mysqli_fetch_array($award_result))
    {    
		if ($award_data["awards_prize"] == "")
		{
?>		
											<option value="<?=$award_data["idx"]?>">ALL</option>
<?
		}else{
?>									
											<option value="<?=$award_data["idx"]?>"><?=$award_data["awards_prize"]?></option>
<?
		}
	}
?>											
