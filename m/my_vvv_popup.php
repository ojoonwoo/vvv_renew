<div class="popup my-coll-add mycollection" id="collection-add">
			<button type="button" class="popup-close" data-popup="@close"></button>
			<div class="inner">
				<div class="title">
					<h5>컬렉션 만들기</h5>
				</div>
				<div class="content">
					<div class="input-area">
						<div class="input-group">
							<div class="guide">
								<span>이름</span>
							</div>
							<div class="input">
								<input type="text" placeholder="<?=$mb_data['mb_name']?>님의 5월 컬렉션" id="collection_name">
							</div>
						</div>
						<div class="input-group">
							<div class="guide">
								<span>설명</span>
							</div>
							<div class="input">
								<input type="text" id="collection_desc">
							</div>
						</div>
					</div>
					<div class="setting">
						<span class="secret-guide">비밀 설정</span>
						<div class="toggle secret">
							<input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="secret" name="secret">
							<div class="toggle-circle"></div>
						</div>
					</div>	
					<div class="button-wrap">
						<button type="button" class="btn-light-grey" data-popup="@close">취소</button>
						<button type="button" onclick="create_collection()">만들기</button>
					</div>
				</div>
			</div>
		</div>
        <div class="popup my-coll-edit mycollection" id="collection-edit">
            <button type="button" class="popup-close" data-popup="@close"></button>
            <div class="inner">
                <div class="title">
                    <h5>컬렉션 수정</h5>
                </div>
                <div class="content">
                    <div class="input-area">
                        <div class="input-group">
                            <div class="guide">
                                <span>이름</span>
                            </div>
                            <div class="input">
                                <input type="text" id="c_name" value="<?=$collection_data["collection_name"]?>">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="guide">
                                <span>설명</span>
                            </div>
                            <div class="input">
                                <input type="text" id="c_desc" value="<?=$collection_data["collection_desc"]?>">
                            </div>
                        </div>
                    </div>
                    <div class="setting">
                        <span class="secret-guide">비밀 설정</span>
                        <div class="toggle secret is-active">
                            <input type="checkbox" type="checkbox" class="secret-toggle toggle-trigger" id="secret" name="secret">
                            <div class="toggle-circle"></div>
                        </div>
                    </div>	
                    <div class="button-wrap">
                        <button type="button" onclick="del_collection();" class="btn-light-grey">컬렉션 삭제</button>
                        <button type="button" onclick="edit_collection();">수정</button>
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
								<img src=".<?=$mb_data["mb_profile_url"]?>" alt="">
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
	
	$is_secret = "";
	$is_checked = "";

	if ($mb_data["mb_showYN"] == "N")
	{
		$is_secret = "is-active";
		$is_checked = "checked";
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
							
							<div class="scroll-box follow is-active" data-tab-content="follow">
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
			if ($mb_f_data['mb_profile_url'] == "")
			{
?>
											<div class="default">
												<span><?=($mb_f_data["mb_nickname"] != '') ? mb_substr($mb_f_data["mb_nickname"], 0, 1, 'utf-8') : mb_substr($mb_f_data["mb_name"], 0, 1, 'utf-8')?></span>
											</div>
<?
			}else{
?>        
											<img src=".<?=$mb_f_data["mb_profile_url"]?>" alt="">
<?
			}
?>
										</a>
									</div>
									<div class="info">
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

							<div class="scroll-box following" data-tab-content="following">
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
			if ($mb_fer_data['mb_profile_url'] == "")
			{
?>
											<div class="default">
												<span><?=($mb_fer_data["mb_nickname"] != '') ? mb_substr($mb_fer_data["mb_nickname"], 0, 1, 'utf-8') : mb_substr($mb_fer_data["mb_name"], 0, 1, 'utf-8')?></span>
											</div>
<?
			}else{
?>        
											<img src=".<?=$mb_fer_data["mb_profile_url"]?>" alt="">
<?
			}
?>                                 
										</a>
									</div>
									<div class="info">
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
            <script src="../lib/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
            <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
            <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
            <script src="../lib/jQuery-File-Upload/js/jquery.fileupload.js"></script>
            <script src="../lib/jQuery-File-Upload/js/jquery.fileupload-process.js"></script>
            <script src="../lib/jQuery-File-Upload/js/jquery.fileupload-image.js"></script>
            <script>
		var profile_url = "";

			$(function() {
<?
	// collection_view 에서 리스트로 돌아가기 했을때 해당 탭으로 이동
	$tab	= $_REQUEST["tab"];
	if ($tab)
	{
?>
				$(".my_tab").removeClass("is-active");
				$(".tab.<?=$tab?>").addClass("is-active");

				$(".my_content").removeClass("is-active");
				$(".aj-content.<?=$tab?>").addClass("is-active");
<?
	}
?>				
			});

		//	기본 기능 테스트 코드
		$doc = $(document);

		// 검색 APPLY 클릭
		$doc.on('click', '#search-layer-submit', function() {
			console.log("search");
			var search_keyword      = nullToBlank($("#search_keyword").val());
			var search_year         = nullToBlank($("#order-date").val());
			var search_nation       = nullToBlank($("#order-nation").val());
			var search_category1    = nullToBlank($("#order-industry").val());
			var search_genre        = nullToBlank($("#order-genre").val());
			var search_prize        = nullToBlank($("#order-awards").val());
			var search_sort         = nullToBlank($("#order-sortby").val());

			location.href = "video_list.php?keyword=" + search_keyword + "&year=" + search_year + "&nation=" + search_nation + "&category=" + search_category1 + "&genre=" + search_genre + "&prize=" + search_prize + "&sort=" + search_sort;
		});

		function nullToBlank(str)
		{
			if (str == null)
				str = "";
				
			return str;
		}

		$doc.on('click', '#search-layer-refresh', function() {
			$("#search_keyword").val("");
			$("#order-date").val("");
			$("#order-nation").val("");
			$("#order-industry").val("");
			$("#order-genre").val("");
			$("#order-awards").val("");
			$("#order-sortby").val("new");        
		});

		// $doc.on('click', '.tab', function() {
		// 	$(".tab").removeClass("is-active");
		// 	$(this).addClass("is-active");

		// 	var target = $(this).data('tab-content');
		// 	$(".aj-content").removeClass("is-active");
		// 	$(".aj-content."+target).addClass("is-active");

		// 	return false;
		// });
			$doc.on('click', '.tab', function() {
				$wrap = $(this).closest('.tab-wrap');
				$wrap.find('.tab').removeClass('is-active');
//				$(".tab").removeClass("is-active");
				$(this).addClass("is-active");

				var target = $(this).data('tab-target');
				$('[data-tab-content='+target+']').siblings().removeClass('is-active');
				$('[data-tab-content='+target+']').addClass("is-active");
//				$(".aj-content."+target).addClass("is-active");

				return false;
			});

			$doc.on('click', '.favor_scrap', function() {
				var cLikeChk	= "Y";
				if(!$(this).hasClass('is-already')) 
					cLikeChk	= "N";


				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"					: "like_collection",
						"collection_idx"        : "<?=$collection_idx?>",
						"showYN"				: cLikeChk
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
							alert("즐겨찾기 되었습니다.");
							$(".favor").addClass("is-already");
						}else if (response.match("L") == "L"){
							alert("로그인 후 즐겨찾기를 해 주세요!");
							location.href = "login.php?refurl=collection_view.php?cidx=<?=$collection_idx?>&midx=<?=$mb_idx?>";
						}else{
							alert("즐겨찾기가 취소 되었습니다.");
							$(".favor").removeClass("is-already");
						}
					}
				});		
			});


		function follow_member()
		{
			$.ajax({
				type   : "POST",
				async  : false,
				url    : "../main_exec.php",
				data:{
					"exec"				    : "follow_member",
					"follow_idx"          	: "<?=$follow_idx?>"
				},
				success: function(response){
					console.log(response);
					if (response.match("Y") == "Y")
					{
						// alert("덧글이 입력되었습니다.");
						$("#follow_status").addClass("already");
						$("#follow_status").html("팔로우중");
						$(".f-wer .count").html(Number($(".f-wer .count").html()) + 1);
					}else if (response.match("D") == "D"){
						$("#follow_status").removeClass("already");
						$("#follow_status").html("팔로우하기");
						$(".f-wer .count").html(Number($(".f-wer .count").html()) - 1);
					}else if (response.match("L") == "L"){
						alert("로그인 후 이용해 주세요!");
						location.href = "login.php?refurl=my_vvv.php?idx=<?=$follow_idx?>";
					}else{
						alert("다시 입력해 주세요.");
						location.reload();
					}
				}
			});			
		}

		function create_collection()
		{
			var collection_name		= $("#collection_name").val();
			var collection_desc		= $("#collection_desc").val();
			var collection_secret	= $("input:checkbox[id='secret']").is(":checked");

			if (collection_name == "")
			{
				alert("컬렉션 이름을 입력해 주세요.");
				return false;
			}

			if (collection_desc == "")
			{
				alert("컬렉션 설명을 입력해 주세요.");
				return false;
			}

			$.ajax({
				type   : "POST",
				async  : false,
				url    : "../main_exec.php",
				data:{
					"exec"				    : "create_collection",
					"collection_name"       : collection_name,
					"collection_desc"		: collection_desc,
					"collection_secret"		: collection_secret
				},
				success: function(response){
					console.log(response);
					if (response.match("Y") == "Y")
					{
						location.reload();
					}else if (response.match("D") == "D"){
						alert("이미 생성된 컬렉션 이름입니다. 다른 이름으로 생성해 주세요.")
						location.reload();
					}else{
						alert("다시 입력해 주세요.");
						location.reload();
					}
				}
			});			

		}

		function del_collection(e,idx)
		{
			// e.stopPropagation();
			// e.stopImmediatePropagation();
			e.preventDefault();
			if (confirm("선택하신 컬렉션을 삭제 할까요?"))
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"				    : "delete_collection",
						"collection_idx"       	: idx
					},
					success: function(response){
						console.log(response);
						$("#album_"+idx).hide();
					}
				});					
			}
		}

		function del_like_collection(e,idx)
		{
			e.preventDefault();
			if (confirm("선택하신 컬렉션을 Favorite에서 삭제 할까요?"))
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"					: "delete_like_collection",
						"collection_idx"        : idx
					},
					success: function(response){
						console.log(response);
						if (response.match("Y") == "Y")
						{
							alert("즐겨찾기가 취소 되었습니다.");
							$("#album_like_"+idx).hide();
						}
					}
				});		
			}
		}

		$(function () {
			'use strict';
			var url = '../Upload.php?mid=<?=$_SESSION['ss_vvv_idx']?>';
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
						$(".picture > img").attr("src","."+file.url);
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

			$.ajax({
				type   : "POST",
				async  : false,
				url    : "../main_exec.php",
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
					url    : "../main_exec.php",
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

			function list_follow_member(idx, followClass)
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
					url    : "../main_exec.php",
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

// collection_view

			//프론트 임시 샘플코드
			$doc.on('click', '[data-mode-change]', function() {
				var mode = $(this).data('mode-change');
				if(!$('.collection-detail').hasClass('check-mode')) {
					//삭제 모드로 변경
					$(this).text('완료');
				} else {
					//삭제 코드
					var videoItems = "";
					var i = 0;
					$('input:checkbox[type=checkbox]:checked').each(function () {
						if (i != 0)
						{
							videoItems += ",";
						}
						
						videoItems += $(this).val();
						i++;
					});

					if (videoItems == "")
					{
						// alert("영상을 선택하시고 완료 버튼을 클릭해 주세요.");
						location.href = "collection_view.php?cidx=<?=$collection_idx?>&midx=<?=$mb_idx?>&my=<?=$_REQUEST["my"]?>";
						return false;
					}

					$.ajax({
						type   : "POST",
						async  : false,
						url    : "../main_exec.php",
						data:{
							"exec"				: "delete_video",
							"c_idx"          	: "<?=$collection_idx?>",
							"m_idx"          	: "<?=$mb_idx?>",
							"video_items"       : videoItems
						},
						success: function(response){
							console.log(response);
							alert("컬렉션에서 선택하신 영상이 삭제되었습니다.");
							location.href = "collection_view.php?cidx=<?=$collection_idx?>&midx=<?=$mb_idx?>";
						}
					});			
					//삭제 완료
					$(this).text('삭제');
				}
				$('.collection-detail').toggleClass('check-mode');
			});

// collection_add

			function addVideo()
			{
				var videoItems = "";

				var i = 0;
				$('input:checkbox[type=checkbox]:checked').each(function () {
					if (i != 0)
					{
						videoItems += ",";
					}
					
					videoItems += $(this).val();
					i++;
				});
console.log(videoItems);
return false;
				if (videoItems == "")
				{
					location.href = "collection_view.php?cidx=<?=$collection_idx?>&midx=<?=$mb_idx?>&my=<?=$_REQUEST["my"]?>";
					return false;
				}

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"				: "add_video",
						"c_idx"          	: "<?=$collection_idx?>",
						"m_idx"          	: "<?=$mb_idx?>",
						"video_items"       : videoItems
					},
					success: function(response){
						console.log(response);
						alert("컬렉션에 영상이 적용되었습니다.");
						location.href = "collection_view.php?cidx=<?=$collection_idx?>&midx=<?=$mb_idx?>&my=<?=$_REQUEST["my"]?>";
					}
				});			

			}


	</script>
