<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

    include_once "./head.php";
?>
	<body>
		<div id="app">
			<div class="app-container sub">
<?
    include_once "./side_nav_layer.php";
?>			
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
											제 1 장 총 칙<br><br>

											제1조 목적<br>
											본 약관은 서비스 이용자가 루리웹닷컴(이하 “회사”라 합니다)이 제공하는 온라인상의 인터넷 서비스<br>
											(이하 “서비스”라고 하며,접속 가능한 유/무선 단말기의 종류와는 상관없이 이용 가능한 “회사”가 제공하는 모든 “서비스”를 의미합니다.<br>
											이하 같습니다)에 회원으로 가입하고 이를 이용함에 있어 회사와 회원(본 약관에 동의하고 회원등록을 완료한 서비스 이용자를 말합니다. <br>
											이하 “회원”이라고 합니다)의 권리•의무 및 책임사항을 규정함을 목적으로 합니다.<br><br>

											제 2 조 (약관의 명시, 효력 및 개정)<br>
											① 회사는 이 약관의 내용을 회원이 쉽게 알 수 있도록 서비스 초기 화면에 게시합니다.<br>
											② 회사는 온라인 디지털콘텐츠산업 발전법, 전자상거래 등에서의 소비자보호에 관한 법률,<br>
											약관의 규제에 관한 법률, 소비자기본법 등 관련법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.<br><br>
											
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro assumenda laborum maxime sint labore, ullam sunt, earum esse architecto recusandae soluta quisquam expedita debitis. Dolorem quae dolore itaque eos sed voluptatibus non, quos, quam qui ad voluptas tempore, animi deleniti dignissimos nesciunt architecto officiis assumenda quis asperiores temporibus vitae vel. Eveniet ipsum sit nostrum nisi natus in quas reprehenderit consequatur perspiciatis asperiores, alias corporis, quidem ad ut nihil voluptas. Hic quisquam soluta explicabo cum minus sequi, in culpa earum iste ut tenetur deleniti, perferendis nam repudiandae inventore! Laudantium nisi commodi, consectetur expedita officia itaque architecto, eaque! Quo, similique vitae rem!
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
											<input type="text">
										</div>
									</div>
									<div class="agree">
										<label for="agree-use3">이메일 수신여부</label>
										<input type="checkbox" id="agree-use3">
										<div class="checkbox"></div>
									</div>
								</div>
								<div class="block-input nickname">
									<div class="input-group">
										<div class="guide">
											닉네임 <span>(선택 사항)</span>
										</div>
										<div class="input">
											<input type="text">
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
			</div>
			<div id="cursor" class="defualt"></div>
		</div>
		<script>
			$(function() {
				//				global search
				$('#order-date').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-nation').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-industry').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-genre').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-awards').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-sortby').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
			});

			//	기본 기능 테스트 코드
			$doc = $(document),
				$win = $(window),
				$html = $('html');
			$doc.on('click', '.button-search', function() {
				$html.addClass('layer-opened');
			});
			$doc.on('click', '.layer-close', function() {
				$html.removeClass('layer-opened');
			});
			$doc.on('click', '.button-menu', function() {
				$html.toggleClass('menu-opened');
			});
			$win.on('scroll', function() {
				if(150 < $(this).scrollTop()) {
					$('.side-nav .search-wrap').css({
						opacity: 1
					});
				} else {
					$('.side-nav .search-wrap').css({
						opacity: 0
					});
				}
			});
		</script>
	</body>

</html>