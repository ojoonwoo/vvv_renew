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
		$query			= "SELECT * FROM member_info WHERE mb_showYN='Y' AND mb_nickname like '%".$search_nickname."%' OR mb_name like '%".$search_nickname."%'";
		$result			= mysqli_query($my_db, $query);
	}

	while ($data = mysqli_fetch_array($result))
	{
		if ($data["idx"] == $_SESSION["ss_vvv_idx"])
			continue;

		$collect_query			= "SELECT * FROM collection_info WHERE collection_mb_idx='".$data["idx"]."'";
		$collect_result			= mysqli_query($my_db, $collect_query);
		$collect_count			= mysqli_num_rows($collect_result);

		$follow_query			= "SELECT * FROM follow_info WHERE follow_idx='".$data["idx"]."' AND follower_idx='".$_SESSION["ss_vvv_idx"]."'";
		$follow_result			= mysqli_query($my_db, $follow_query);
		$follow_count			= mysqli_num_rows($follow_result);
		if ($follow_count > 0)
			$add_friends	= "already";
		else
			$add_friends	= "add";
?>
								<div class="row">
									<div class="img">
<?
		if ($data["mb_profile_url"] == "")
		{
?>											
											<a href="my_vvv.php?idx=<?=$data["idx"]?>"><img src="./images/profile_sample.jpg" alt=""></a>
<?
		}else{
?>											
											<a href="my_vvv.php?idx=<?=$data["idx"]?>"><img src=".<?=$data["mb_profile_url"]?>" alt=""></a>
<?
		}
?>											
									</div>
									<div class="info">
<?
		if ($data["mb_nickname"] == "")
		{
?>											
										<div class="name"><a href="my_vvv.php?idx=<?=$data["idx"]?>"><?=$data["mb_name"]?></a></div>
<?
		}else{
?>			
										<div class="name"><a href="my_vvv.php?idx=<?=$data["idx"]?>"><?=$data["mb_nickname"]?></a></div>
<?
		}
?>							
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
										<button type="button" class="<?=$add_friends?>" id="f_btn_<?=$data["idx"]?>" onclick="search_follow_member('<?=$data["idx"]?>','<?=$add_friends?>')"></button>
									</div>
								</div>

<?
    }
?>