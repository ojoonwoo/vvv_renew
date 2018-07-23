                            <div class="user-info">
								<div class="wrapper">
									<div class="profile-img">
<?
	if ($mb_data['mb_profile_url'] == "")
	{
?>
										<div class="default">
											<span><?=($mb_data["mb_nickname"] != '') ? mb_substr($mb_data["mb_nickname"], 0, 1, 'utf-8') : mb_substr($mb_data["mb_name"], 0, 1, 'utf-8')?></span>
										</div>
<?
	}else{
?>        
										<img src="<?=$mb_data["mb_profile_url"]?>" alt="">
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

	if ($_SESSION['ss_vvv_idx'] == $my_idx)
	{
?>
												<a href="javascript:void(0)" class="setting" data-popup="#profile-edit">
													<img src="./images/icon_profile_setting.png" alt="">
												</a>
<?
	}
?>												
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
<?
	if ($mb_data['mb_profile_url'] == "")
	{
?>
									<div class="default">
										<span><?=($mb_data["mb_nickname"] != '') ? mb_substr($mb_data["mb_nickname"], 0, 1, 'utf-8') : mb_substr($mb_data["mb_name"], 0, 1, 'utf-8')?></span>
									</div>
<?
	}else{
?>        
									<img src="<?=$mb_data["mb_profile_url"]?>" alt="">
<?
	}
?>           
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
									<input type="text" id="edit_nickname" value="<?=$mb_data['mb_nickname']?>">
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
<?
	$is_secret = "";
	$is_checked = "";
	if ($mb_data["mb_showYN"] == "N")
	{
		$is_secret = "is-active";
		$is_checked = "checked";

	}
?>
									<div class="toggle secret <?=$is_secret?>">
										<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="profile-secret" name="profile-secret" <?=$is_checked?>>
										<div class="toggle-circle"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="button-wrap">
							<button type="button" class="btn-light-grey" data-popup="@close">취소</button>
							<button type="button" onclick="edit_profile()">완료</button>
						</div>
					</div>
				</div>
            </div>
            <div class="popup search-friends" id="search-friends">
				<button type="button" class="popup-close" data-popup="@close"></button>
				<div class="inner">
					<div class="title">
						<h5>친구 검색</h5>
					</div>
					<div class="content">
						<div class="search-wrap">
							<div class="search-bar">
								<input type="text" id="search_nickname" onkeyup="search_friends()" placeholder="친구 닉네임 또는 이름 검색">
								<div class="placeholder-icon"></div>
							</div>
							<div class="search-result">
								<div class="scroll-box">
									<!-- <div class="row">
										<div class="img">
											<img src="./images/profile_sample.jpg" alt="">
										</div>
										<div class="info">
											<div class="name">오준우</div>
											<div class="counts">
												<div class="wrap like">
													<i></i>
													<span>21</span>
												</div>
												<div class="wrap collection">
													<i></i>
													<span>11</span>
												</div>
											</div>
										</div>
										<div class="action">
											<button type="button" class="add"></button>
										</div>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="popup follow-state" id="follow-state">
				<button type="button" class="popup-close" data-popup="@close"></button>
				<div class="inner">
					<div class="content">
						<div class="area-tab">
							<div class="tab-wrap">
								<div class="tab is-active" data-tab-target="follow">
									<a href="#">팔로우</a>
								</div>
								<div class="tab" data-tab-target="following">
									<a href="#">팔로잉</a>
								</div>
							</div>
						</div>
						<div class="area-list">
							<div class="scroll-box follow is-active aj-content" data-tab-content="follow">
<?
	// $my_idx
	$follow_query		= "SELECT * FROM follow_info WHERE follow_idx='".$my_idx."' AND follow_YN='Y'";
	$follow_result		= mysqli_query($my_db, $follow_query);

	while ($follow_data = mysqli_fetch_array($follow_result))
	{
		$mb_f_query		= "SELECT * FROM member_info WHERE idx='".$follow_data["follower_idx"]."'";
		$mb_f_result	= mysqli_query($my_db, $mb_f_query);
		$mb_f_data		= mysqli_fetch_array($mb_f_result);

		// 라이크 갯수
		$like_f_query	= "SELECT * FROM like_info WHERE mb_idx='".$mb_f_data["idx"]."' AND like_flag='Y'";
		$like_f_result	= mysqli_query($my_db, $like_f_query);
		$like_f_count	= mysqli_num_rows($like_f_result);
		
		// 컬렉션 갯수
		$collection_f_query		= "SELECT * FROM collection_info WHERE collection_mb_idx='".$mb_f_data["idx"]."' AND collection_showYN='Y'";
		$collection_f_result	= mysqli_query($my_db, $collection_f_query);
		$collection_f_count		= mysqli_num_rows($collection_f_result);
?>								
								<div class="row">
									<div class="img">
										<a href="my_vvv.php?idx=<?=$mb_f_data["idx"]?>">
<?
		if($mb_f_data["mb_profile_url"] != "") {
?>
											<img src="<?=$mb_f_data["mb_profile_url"]?>" alt="">
<?											
		} else {
?>
											<div class="default">
												<span><?=($mb_f_data["mb_nickname"] != '') ? mb_substr($mb_f_data["mb_nickname"], 0, 1, 'utf-8') : mb_substr($mb_f_data["mb_name"], 0, 1, 'utf-8')?></span>
											</div>
<?
		}
?>
										</a>
									</div>
									<div class="info">
										<a href="my_vvv.php?idx=<?=$mb_f_data["idx"]?>">
<?
		if ($mb_f_data['mb_nickname'] == "")
		{
?>										
											<div class="name"><?=$mb_f_data["mb_name"]?></div>
<?
		}else{
?>			
											<div class="name"><?=$mb_f_data["mb_nickname"]?></div>
<?
		}
?>								
										</a>
										<div class="counts">
											<div class="wrap like">
												<i></i>
												<span><?=$like_f_count?></span>
											</div>
												<div class="wrap collection">
													<i></i>
												<span><?=$collection_f_count?></span>
											</div>
										</div>
									</div>
									<div class="action">
<?
	if ($_SESSION["ss_vvv_idx"] != $follow_data["follower_idx"])
	{
		if (!$_SESSION['ss_vvv_idx'])
		{
?>
										<button type="button" class="already" onclick="alert('로그인 후 친구추가해 주세요.');location.href='login.php?refurl=<?=$_SERVER['REQUEST_URI']?>'"></button>
<?
		}else{
			$add_query		= "SELECT * FROM follow_info WHERE follow_idx='".$mb_f_data["idx"]."' AND follower_idx='".$_SESSION["ss_vvv_idx"]."' AND follow_YN='Y'";
			$add_result		= mysqli_query($my_db, $add_query);
			$add_count		= mysqli_num_rows($add_result);
			
			if ($add_count > 0)
			{
?>		
										<button type="button" class="already f_list_btn_<?=$mb_f_data["idx"]?>" onclick="list_follow_member('<?=$mb_f_data["idx"]?>','already')"></button>
<?
			}else{
?>										
										<button type="button" class="add f_list_btn_<?=$mb_f_data["idx"]?>" onclick="list_follow_member('<?=$mb_f_data["idx"]?>','add')"></button>
<?
			}
		}
	}
?>								
									</div>
								</div>
<?
	}
?>								
							</div>
							<div class="scroll-box following aj-content" data-tab-content="following">
<?
	// $my_idx
	$follower_query		= "SELECT * FROM follow_info WHERE follower_idx='".$my_idx."' AND follow_YN='Y'";
	$follower_result	= mysqli_query($my_db, $follower_query);

	while ($follower_data = mysqli_fetch_array($follower_result))
	{
		$mb_fer_query		= "SELECT * FROM member_info WHERE idx='".$follower_data["follow_idx"]."'";
		$mb_fer_result		= mysqli_query($my_db, $mb_fer_query);
		$mb_fer_data		= mysqli_fetch_array($mb_fer_result);

		// 라이크 갯수
		$like_fer_query		= "SELECT * FROM like_info WHERE mb_idx='".$mb_fer_data["idx"]."' AND like_flag='Y'";
		$like_fer_result	= mysqli_query($my_db, $like_fer_query);
		$like_fer_count		= mysqli_num_rows($like_fer_result);
		
		// 컬렉션 갯수
		$collection_fer_query		= "SELECT * FROM collection_info WHERE collection_mb_idx='".$mb_fer_data["idx"]."' AND collection_showYN='Y'";
		$collection_fer_result		= mysqli_query($my_db, $collection_fer_query);
		$collection_fer_count		= mysqli_num_rows($collection_fer_result);
?>								
								<div class="row">
									<div class="img">
										<a href="my_vvv.php?idx=<?=$mb_fer_data["idx"]?>">
<?
			if($mb_fer_data["mb_profile_url"] != "") {
?>
											<img src="<?=$mb_fer_data["mb_profile_url"]?>" alt="">
			} else {
?>
											<div class="default">
												<span><?=($mb_fer_data["mb_nickname"] != '') ? mb_substr($mb_fer_data["mb_nickname"], 0, 1, 'utf-8') : mb_substr($mb_fer_data["mb_name"], 0, 1, 'utf-8')?></span>
											</div>
<?
			}
?>
											<img src="<?=$mb_fer_data["mb_profile_url"]?>" alt="">
										</a>
									</div>
									<div class="info">
										<a href="my_vvv.php?idx=<?=$mb_fer_data["idx"]?>">
<?
		if ($mb_fer_data['mb_nickname'] == "")
		{
?>										
											<div class="name"><?=$mb_fer_data["mb_name"]?></div>
<?
		}else{
?>			
											<div class="name"><?=$mb_fer_data["mb_nickname"]?></div>
<?
		}
?>								
										</a>
										<div class="counts">
											<div class="wrap like">
												<i></i>
												<span><?=$like_fer_count?></span>
											</div>
												<div class="wrap collection">
													<i></i>
												<span><?=$collection_fer_count?></span>
											</div>
										</div>
									</div>
									<div class="action">
<?
	if ($_SESSION["ss_vvv_idx"] != $follower_data["follow_idx"])
	{
		if (!$_SESSION['ss_vvv_idx'])
		{
?>
										<button type="button" class="already" onclick="alert('로그인 후 친구추가해 주세요.');location.href='login.php?refurl=<?=$_SERVER['REQUEST_URI']?>'"></button>
<?
		}else{
			$add_query		= "SELECT * FROM follow_info WHERE follow_idx='".$mb_fer_data["idx"]."' AND follower_idx='".$_SESSION["ss_vvv_idx"]."' AND follow_YN='Y'";
			$add_result		= mysqli_query($my_db, $add_query);
			$add_count		= mysqli_num_rows($add_result);
			
			if ($add_count > 0)
			{
?>		
										<button type="button" class="already f_list_btn_<?=$mb_fer_data["idx"]?>" onclick="list_follow_member('<?=$mb_fer_data["idx"]?>','already')"></button>
<?
			}else{
?>										
										<button type="button" class="add f_list_btn_<?=$mb_fer_data["idx"]?>" onclick="list_follow_member('<?=$mb_fer_data["idx"]?>','add')"></button>
<?
			}
		}
	}
?>								
									</div>
								</div>
<?
	}
?>								
							</div>
						</div>
					</div>
				</div>
			</div>

            <script src="./lib/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
            <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
            <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
            <script src="./lib/jQuery-File-Upload/js/jquery.fileupload.js"></script>
            <script src="./lib/jQuery-File-Upload/js/jquery.fileupload-process.js"></script>
            <script src="./lib/jQuery-File-Upload/js/jquery.fileupload-image.js"></script>
            <script>
            var profile_url = "";
            $(function () {
                'use strict';
                var url = './Upload.php?mid=<?=$_SESSION['ss_vvv_idx']?>';
                $('#profile-change').fileupload({
                    url: url,
                    dataType: 'json',
                    autoUpload: true,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    maxFileSize: 10000000,
                    disableImageResize: /Android(?!.*Chrome)|Opera/
                        .test(window.navigator.userAgent),
                    previewThumbnail: false,
                    previewCrop: false
                }).on('fileuploadadd', function (e, data) {
                    data.context = $('<div id="prev_thum"/>').appendTo('.img-area');
                    $.each(data.files, function (index, file) {
                        var node = $('<p style="margin:0" />');
                        node.appendTo(data.context);
                    });
                }).on('fileuploadprocessalways', function (e, data) {
                    var index = data.index,
                        file = data.files[index],
                        node = $(data.context.children()[index]);
                    if (file.preview) {
                        node
                            .prepend('<br>')
                            .prepend(file.preview);
                    }
                    if (file.error) {
                        node
                            .append('<br>')
                            .append($('<span class="text-danger"/>').text(file.error));
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }).on('fileuploaddone', function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        console.log(file);
                        if (file.url) {
                            profile_url = file.url;
                            $(".picture > img").attr("src",file.url);
                        } else if (file.error) {
                            var error = $('<span class="text-danger"/>').text(file.error);
                            $(data.context.children()[index])
                                .append('<br>')
                                .append(error);
                        }
                    });
                }).on('fileuploadfail', function (e, data) {
                    $.each(data.files, function (index) {
                        var error = $('<span class="text-danger"/>').text('File upload failed.');
                        $(data.context.children()[index])
                            .append('<br>')
                            .append(error);
                    });
                }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
            });     
            
            function edit_profile()
            {
                var edit_nickname   = $("#edit_nickname").val();
                var edit_secret	    = $("input:checkbox[id='profile-secret']").is(":checked");
console.log(edit_secret);
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
					data:{
						"exec"				: "edit_member",
						"edit_nickname"     : edit_nickname,
						"edit_secret"		: edit_secret,
						"profile_url"		: profile_url
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
                            alert("회원 정보가 수정 되었습니다.");
							location.reload();
						}else{
							alert("다시 수정해 주세요.");
							location.reload();
						}
					}
				});
            }

            function search_friends()
            {
                var search_nickname = $("#search_nickname").val();

                $.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_friends.php",
					data:{
						"search_nickname"   : search_nickname
					},
					success: function(response){
                        console.log(response);
                        $(".scroll-box").html(response);
					}
				});
                
            }

            function search_follow_member(idx, followClass)
			{
                if (followClass == "already")
                {
                    var confirm_message = "이 친구를 팔로우 취소 할까요?";
                    var followYN        = "Y";
                }else{
                    var confirm_message = "이 친구를 팔로우 할까요?";
                    var followYN        = "N";
                }

                if (confirm(confirm_message))
                {
                    $.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
					data:{
						"exec"				    : "search_follow_member",
						"follow_idx"          	: idx,
						"followYN"          	: followYN
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
                            alert("팔로우 되었습니다.");
                            // location.reload();
                            $("#f_btn_"+idx).attr("class","already");
                            $("#f_btn_"+idx).attr("onclick","search_follow_member('" + idx + "','already')");
						}else if (response.match("D") == "D"){
                            alert("팔로우가 취소 되었습니다.");
                            // location.reload();
                            $("#f_btn_"+idx).attr("class","add");
                            $("#f_btn_"+idx).attr("onclick","search_follow_member('" + idx + "','add')");
						}else{
							alert("다시 입력해 주세요.");
							location.reload();
						}
					}
				});			

                }
			}

            function list_follow_member(idx, followClass, listFlag)
			{
                if (followClass == "already")
                {
                    var confirm_message = "이 친구를 팔로우 취소 할까요?";
                    var followYN        = "Y";
                }else{
                    var confirm_message = "이 친구를 팔로우 할까요?";
                    var followYN        = "N";
                }

                if (confirm(confirm_message))
                {
                    $.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
					data:{
						"exec"				    : "search_follow_member",
						"follow_idx"          	: idx,
						"followYN"          	: followYN
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
                            alert("팔로우 되었습니다.");
                            // location.reload();
                            $(".f_list_btn_"+idx).attr("class","already");
                            $(".f_list_btn_"+idx).attr("onclick","list_follow_member('" + idx + "','already')");
						}else if (response.match("D") == "D"){
                            alert("팔로우가 취소 되었습니다.");
                            // location.reload();
                            $(".f_list_btn_"+idx).attr("class","add");
                            $(".f_list_btn_"+idx).attr("onclick","list_follow_member('" + idx + "','add')");
						}else{
							alert("다시 입력해 주세요.");
							location.reload();
						}
					}
				});			

                }
			}

            </script>