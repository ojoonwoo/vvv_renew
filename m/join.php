<?
    include_once "../include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

    include_once "./head.php";
?>
	<body>
		<div id="app">
				<!--햄버거 클릭 메뉴-->
<?
    include_once "./menu_layer.php";
?>							
				<!--햄버거 클릭 메뉴-->
				<!--검색 메뉴-->
<?
    include_once "./search_layer.php";
?>			
				<!--검색 메뉴-->
			<div class="app-container sub">
<?
    include_once "./header_layer.php";
?>			
				<div class="main-container">
					<div class="content join">
						<div class="inner">
							<div class="title">
								<h3>
									VVV
								</h3>
							</div>
							<div class="block-wrap">
								<div class="block-terms">
									<h5 class="title">이용약관</h5>
									<div class="scroll-box">
										<div class="inner">
<?
	include_once "./agree1_txt.html";
?>											
										</div>
									</div>
									<div class="agree">
										<label for="agree-use1">이용약관에 동의합니다</label>
										<input type="checkbox" id="agree-use1">
										<div class="checkbox"></div>
									</div>
								</div>
								<div class="block-terms">
									<h5 class="title">개인정보 수집 및 이용에 대한 동의</h5>
									<div class="scroll-box">
										<div class="inner">
<?
	include_once "./agree2_txt.html";
?>
										</div>
									</div>
									<div class="agree">
										<label for="agree-use2">개인정보 제공에 동의합니다</label>
										<input type="checkbox" id="agree-use2">
										<div class="checkbox"></div>
									</div>
								</div>
							</div>
							<div class="block-wrap">
								<div class="block-input">
									<div class="input-group">
										<div class="guide">
											이메일 <span>(필수 사항)</span>
										</div>
										<div class="input">
											<input type="text" id="mb_email" placeholder="이메일">
										</div>
									</div>
									<div class="agree">
										<div class="guide">이벤트 및 서비스 안내 등 홍보 마케팅에 활용됩니다</div>
										<div class="check-wrap">
											<label for="agree-use3">수신여부</label>
											<input type="checkbox" id="agree-use3">
											<div class="checkbox"></div>
										</div>
									</div>
								</div>
								<div class="block-input nickname">
									<div class="input-group">
										<div class="guide">
											닉네임 <span>(선택 사항)</span>
										</div>
										<div class="input">
											<input type="text" id="mb_nickname" placeholder="닉네임">
										</div>
									</div>
									<span class="guide">사용할 닉네임을 입력해주세요! 프로필,친구찾기 등에 사용됩니다</span>
								</div>
								<button type="button" class="btn-join">
									가입
								</button>
							</div>
						</div>
					</div>
				</div>
<? include_once "footer_layer.php"; ?>
			</div>
<? 	include_once "cursor.php"; ?>
		</div>
		<script>
			// $(function() {
			// 	//				global search
			// 	$('#order-date').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-nation').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-industry').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-genre').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-awards').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// 	$('#order-sortby').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			// });

			//	기본 기능 테스트 코드
			$doc = $(document);

			$doc.on('click', '.btn-join', function() {
				var mb_email 		= $("#mb_email").val();
				var mb_nickname 	= $("#mb_nickname").val();
				var mb_emailYN 		= $("#agree-use3").is(":checked");

				if ($("#agree-use1").is(":checked") === false)
				{
					alert("이용약관에 동의하셔야만 회원가입을 하실 수 있습니다");
					return false;
				}
				
				if ($("#agree-use2").is(":checked") === false)
				{
					alert("개인정보 제공에 동의하셔야만 회원가입을 하실 수 있습니다");
					return false;
				}

				if (mb_email == "")
				{
					alert("이메일은 필수 입력 사항입니다.");
					return false;
				}

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "../main_exec.php",
					data:{
						"exec"				    : "update_member",
						"mb_email"       		: mb_email,
						"mb_nickname"			: mb_nickname,
						"mb_emailYN"			: mb_emailYN
					},
					success: function(response){
						// console.log(response);
						if (response.match("Y") == "Y")
						{
							alert("회원 가입이 완료 되었습니다!");
							location.href = "./index.php";
						}else if (response.match("D") == "D"){
							alert("중복된 닉네임입니다. 다른 닉네임을 입력해주세요");
						}else{
							alert("다시 입력해 주세요.");
							location.reload();
						}
					}
				});
			});
		</script>
	</body>

</html>