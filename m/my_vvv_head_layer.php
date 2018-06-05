						<div class="user-info">
							<div class="wrapper">
								<div class="profile-img">
<?
	if ($mb_data['mb_profile_url'] == "")
	{
?>
<!--                                        <img src="./images/profile_img_sample.jpg" alt="">-->
									<div class="default">
										<span><?=$mb_data['mb_nickname']?></span>
									</div>
<?
    }else{
?>        
									<img src=".<?=$mb_data["mb_profile_url"]?>" alt="">
<?
    }
?>                                
								</div>
								<div class="info-wrap">
									<!--me, not me-->
									<div class="wrap-user">
										<div class="user-id">
<?
	if ($mb_data['mb_nickname'] == "")
	{
?>
											<span class="u-id"><?=$mb_data['mb_name']?></span>
<?
	}else{
?>
											<span class="u-id"><?=$mb_data['mb_nickname']?></span>
<?
	}
?>
											<a href="javascript:void(0)" class="setting" data-popup="#profile-edit">
												<img src="./images/icon_profile_setting.png" alt="">
											</a>
										</div>
									</div>
									<div class="wrap-actions">
										<div class="f-wer">
											<a href="javascript:void(0)" data-popup="#follow-state">
												<span>팔로워</span>
												<span class="count"><?=$mb_data['mb_follower_count']?></span>
											</a>
										</div>
										<div class="f-ing">
											<a href="javascript:void(0)" data-popup="#follow-state">
												<span>팔로잉</span>
												<span class="count"><?=$mb_data['mb_following_count']?></span>
											</a>
										</div>
<?
	if ($_SESSION['ss_vvv_idx'] != $my_idx)
	{
		// 팔로우 여부 확인
		$follow_query		= "SELECT * FROM follow_info WHERE follow_idx='".$follow_idx."' AND follower_idx='".$_SESSION['ss_vvv_idx']."' AND follow_YN='Y'";
		$follow_result		= mysqli_query($my_db, $follow_query);
		$follow_count		= mysqli_num_rows($follow_result);
		
		if ($follow_count > 0)
		{
?>
												<div class="follow-state">
													<a href="javascript:follow_member()" class="already" id="follow_status">팔로우중</a>
												</div>
<?
		}else{
?>													
												<div class="follow-state">
													<a href="javascript:follow_member()" id="follow_status">팔로우하기</a>
												</div>
<?
		}
	}else{
?>
												<div class="f-add">
													<button type="button" data-popup="#search-friends">친구추가</button>
												</div>
<?		
	}
?>												
									</div>
								</div>
							</div>
						</div>					