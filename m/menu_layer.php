		<div class="global-menu">
			<div class="inner">
				<a href="#" class="btn-close button-menu anim-blur">
					<img src="./images/close_x_black.png" alt="">
				</a>
				<div class="user-status anim-blur">
	<?
		if (!$_SESSION['ss_vvv_email'])
		{
	?>                                
					<a href="login.php?refurl=my_vvv.php">MY VVV</a>
					<a href="login.php">LOGIN</a>
	<?
		}else{
	?>        
					<a href="my_vvv.php">MY VVV</a>
					<a href="logout.php">LOGOUT</a>
	<?
		}
	?>                        
				</div>
				<div class="list-wrap">
					<ul class="list anim-blur">
						<li>
							<a href="index.php" class="is-active">HOME</a>
						</li>
						<li>
							<a href="video_list.php?sort=new">ALL VVV</a>
						</li>
						<li>
							<a href="best_list.php">Editor's PICK</a>
						</li>
						<li>
							<a href="video_list.php?sort=new">NEW</a>
						</li>
						<li>
							<a href="award_list.php">AWARDS</a>
						</li>
					</ul>
				</div>
				<div class="about-us anim-blur">
					<div class="line"></div>
					<div class="contacts">
						<p><span>CONTACT US</span></p>
<!--
						<p class="tel">
							<i></i>
							<span>+82 (02)532-2475</span>
						</p>
-->
						<p class="sns">
							<a href="javascript:void(0)" data-popup="#send-mail">
								<i class="mail"></i>
							</a>
							<a href="https://www.facebook.com/VVV-%EB%B0%94%ED%81%90_%EB%B0%94%EC%9D%B4%EB%9F%B4-%ED%81%90%EB%A0%88%EC%9D%B4%ED%8C%85-344746659385832/" target="_blank">
								<i class="facebook"></i>
							</a>
							<a href="https://www.instagram.com/vvv_valuableviralvideo/" target="_blank">
								<i class="instagram"></i>
							</a>
						</p>
					</div>
				</div>
				<div class="copyright anim-blur">
					COPYRIGHTS©2018 Valuable Viral Video ALL RIGHT RESERVED.
				</div>
			</div>
		</div>

			<div class="popup send-mail" id="send-mail">
				<button type="button" class="popup-close" data-popup="@close"></button>
				<div class="inner">
					<div class="title">
						<i></i><span>CONTACT US</span>
					</div>
					<div class="content">
						<div class="input-wrap">
							<div class="input-group">
								<div class="guide">Name</div>
								<div class="input">
									<input type="text" id="contact_name">
								</div>
							</div>
							<div class="input-group">
								<div class="guide">E-mail</div>
								<div class="input">
									<input type="text" id="contact_email">
								</div>
							</div>
							<div class="input-group">
								<div class="guide">Comment</div>
								<div class="input">
									<textarea name="" id="contact_comment" cols="30" rows="10"></textarea>
								</div>
							</div>
						</div>
						<button type="button" class="btn-send" onclick="send_contact()">보내기</button>
					</div>
				</div>
			</div>
			<script>
	function send_contact()
	{
		var contact_name 		= $("#contact_name").val();
		var contact_email 		= $("#contact_email").val();
		var contact_comment 	= $("#contact_comment").val();

		if (contact_name == "")
		{
			alert("이름을 입력해 주세요");
			return false;
		}

		if (contact_email == "")
		{
			alert("이메일을 입력해 주세요");
			return false;
		}
		
		if (contact_comment == "")
		{
			alert("코멘트를 입력해 주세요");
			return false;
		}

		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../main_exec.php",
			data:{
				"exec"				    : "insert_contact",
				"contact_name"          : contact_name,
				"contact_email"         : contact_email,
				"contact_comment"       : contact_comment
			},
			success: function(response){
				console.log(response);
				if (response.match("Y") == "Y")
				{
					alert("담당자에게 메일이 발송되었습니다.");
					location.reload();
				}else{
					alert("다시 입력해 주세요.");
					location.reload();
				}
			}
		});			
	}
</script>