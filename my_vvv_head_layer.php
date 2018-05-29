<div class="user-info">
								<div class="wrapper">
									<div class="profile-img">
										<img src="./images/profile_img_sample.jpg" alt="">
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
												<span>팔로워</span>
												<span class="count"><?=$mb_data['mb_follower_count']?></span>
											</div>
											<div class="f-ing">
												<span>팔로잉</span>
												<span class="count"><?=$mb_data['mb_following_count']?></span>
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
													<a href="javascript:follow_member()" class="already">팔로우중</a>
												</div>
<?
		}else{
?>													
												<div class="follow-state">
													<a href="javascript:follow_member()">팔로우하기</a>
												</div>
<?
		}
	}else{
?>
												<div class="f-add">
													<button type="button">친구추가</button>
												</div>
<?		
	}
?>												
										</div>
									</div>
								</div>
							</div>
			<div class="popup profile-edit" id="profile-edit">
				<button type="button" class="popup-close" data-popup="@close"></button>
				<div class="inner">
					<div class="title">
						<h5>프로필 수정</h5>
					</div>
					<div class="content">
						<div class="area-picture">
							<div class="pic-wrap">
								<div class="picture">
									<img src="./images/newyork_m.png" alt="">
								</div>
								<div class="btn-edit">
									<label for="profile-change">프로필 사진 바꾸기</label>
									<input type="file" id="profile-change">
								</div>
							</div>
						</div>
						<div class="area-info">
							<div class="input-group">
								<div class="guide">
									닉네임
								</div>
								<div class="input">
									<input type="text" value="<?=$mb_data['mb_nickname']?>">
								</div>
							</div>
							<div class="input-group">
								<div class="guide">
									계정정보
								</div>
								<div class="input">
<?
    if ($mb_data["mb_login_way"] == "kakao")
    {
?>   
									<i class="kt"></i>
<?
    }else{
?>        
									<i class="fb"></i>
<?
    }
?>                         
									<input type="text" value="<?=$mb_data['mb_email']?>" readonly disabled>
								</div>
							</div>
							<div class="input-group secret">
								<div class="guide">
									비공개 계정
								</div>
								<div class="input setting">
									<div class="toggle secret is-active">
										<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="profile-secret" name="profile-secret">
										<div class="toggle-circle"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="button-wrap">
							<button type="button" class="btn-light-grey" data-popup="@close">취소</button>
							<button type="button">완료</button>
						</div>
					</div>
				</div>
			</div>