<?
    include_once "../include/autoload.php";

    $mnv_f          = new mnv_function();
    $my_db          = $mnv_f->Connect_MySQL();

    $search_nickname         = $_REQUEST["search_nickname"];

	if ($search_nickname == "")
	{
		$query			= "SELECT * FROM member_info WHERE mb_showYN='Y' AND mb_nickname like '%abcdefghijklmnopqrstuvwxyz%'";
		$result			= mysqli_query($my_db, $query);
	}else{
		$query			= "SELECT * FROM member_info WHERE mb_showYN='Y' AND mb_nickname like '%".$search_nickname."%'";
		$result			= mysqli_query($my_db, $query);
	}

	while ($data = mysqli_fetch_array($result))
	{
		$collect_query			= "SELECT * FROM collection_info WHERE collection_mb_idx='".$data["idx"]."'";
		$collect_result			= mysqli_query($my_db, $query);
		$collect_count			= mysqli_num_rows($collect_result);
?>
								<div class="row">
									<div class="img">
<?
		if ($data["mb_profile_url"] == "")
		{
?>											
											<img src="./images/profile_sample.jpg" alt="">
<?
		}else{
?>											
											<img src=".<?=$data["mb_profile_url"]?>" alt="">
<?
		}
?>											
									</div>
									<div class="info">
										<div class="name"><?=$data["mb_nickname"]?></div>
										<div class="counts">
											<div class="wrap like">
												<i></i>
												<span><?=$data["mb_follower_count"]?></span>
											</div>
											<div class="wrap collection">
												<i></i>
												<span><?=$collect_count?></span>
											</div>
										</div>
									</div>
									<div class="action">
										<button type="button" class="add" onclick="search_follow_member(<?=$data["idx"]?>)"></button>
									</div>
								</div>

<?
    }
?>