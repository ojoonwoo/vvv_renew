<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();
    $IEYN          = $mnv_f->IECheck();
    $SafariYN          = $mnv_f->SafariCheck();
    // print_r($_SERVER["HTTP_USER_AGENT"]);
    if ($mobileYN == "MOBILE")
    {
        echo "<script>location.href='m/index.php';</script>";
    }else{
        $saveMedia     = $mnv_f->SaveMedia();
        $rs_tracking   = $mnv_f->InsertTrackingInfo($mobileYN);
	}

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
					<div class="content awards">
						<div class="inner">
							<div class="awards-banner">
								<div class="banner _01 is-active">
									<div class="clickEl" onmouseover="bannerResizing(1, this)">
										<figure>
											<figcaption>
												<p class="award-name">CANNES</p>
												<p class="award-summ">2017 Grand Prix</p>
												<p class="award-title">‘we’re the superhumans’</p>
												<a href="video_detail.php?idx=448" class="view">VIEW</a>
											</figcaption>
										</figure>
									</div>
								</div>
								<div class="banner _02">
									<div class="clickEl" onmouseover="bannerResizing(2, this)">
										<figure>
											<figcaption>
												<p class="award-name">NEWYORK</p>
												<p class="award-summ">2017 BEST OF SHOW</p>
												<p class="award-title">‘MEET GRAHAM’</p>
												<a href="video_detail.php?idx=438" class="view">VIEW</a>
											</figcaption>
										</figure>
									</div>
								</div>
								<div class="banner _03">
									<div class="clickEl" onmouseover="bannerResizing(3, this)">
										<figure>
											<figcaption>
												<p class="award-name">CLIO</p>
												<p class="award-summ">2017 Grand</p>
												<p class="award-title">‘fearless girl’</p>
												<a href="video_detail.php?idx=823" class="view">VIEW</a>
											</figcaption>
										</figure>
									</div>
								</div>
							</div>
							<div class="cate-wrap">
								<div class="main-cate">
									<div class="sort">
										<select name="lc-order-date" id="lc-order-date" onchange="sel_year(this.value)">
											<option disabled>연도</option>
											<option value="2017" selected>2017</option>
											<option value="2016">2016</option>
										</select>
									</div>
									<ul>
										<li>
											<a href="javascript:sel_award(2)" class="award_name _2 is-active">NEWYORK</a>
										</li>
										<li>
											<a href="javascript:sel_award(3)" class="award_name _3">CANNES</a>
										</li>
										<li>
											<a href="javascript:sel_award(1)" class="award_name _1">CLIO</a>
										</li>
									</ul>
								</div>
								<div class="sub-cate">
									<ul class="award _3" style="display:none;">
										<li>
											<a href="javascript:sel_award(3)" class="award_prize _3 is-active">ALL</a>
										</li>
										<li>
											<a href="javascript:sel_award(15)" class="award_prize _15">Grand</a>
										</li>
										<li>
											<a href="javascript:sel_award(16)" class="award_prize _16">Gold</a>
										</li>
										<li>
											<a href="javascript:sel_award(17)" class="award_prize _17">Silver</a>
										</li>
									</ul>
									<ul class="award _2">
										<li>
											<a href="javascript:sel_award(2)" class="award_prize _2 is-active">ALL</a>
										</li>
										<li>
											<a href="javascript:sel_award(10)" class="award_prize _10">Best</a>
										</li>
										<li>
											<a href="javascript:sel_award(11)" class="award_prize _11">Grand</a>
										</li>
										<li>
											<a href="javascript:sel_award(12)" class="award_prize _12">First</a>
										</li>
										<li>
											<a href="javascript:sel_award(13)" class="award_prize _13">Second</a>
										</li>
										<li>
											<a href="javascript:sel_award(14)" class="award_prize _14">Third</a>
										</li>
									</ul>
									<ul class="award _1" style="display:none;">
										<li>
											<a href="javascript:sel_award(1)" class="award_prize _1 is-active">ALL</a>
										</li>
										<li>
											<a href="javascript:sel_award(4)" class="award_prize _4">Grandprix</a>
										</li>
										<li>
											<a href="javascript:sel_award(5)" class="award_prize _5">Grand</a>
										</li>
										<li>
											<a href="javascript:sel_award(6)" class="award_prize _6">Hall of Fame</a>
										</li>
										<li>
											<a href="javascript:sel_award(7)" class="award_prize _7">Gold</a>
										</li>
										<li>
											<a href="javascript:sel_award(8)" class="award_prize _8">Silver</a>
										</li>
										<li>
											<a href="javascript:sel_award(9)" class="award_prize _9">Bronze</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="list-container">
								<div class="video-list" id="award_list">
<?
    $award_query	= "SELECT * FROM awards_list_info WHERE 1 AND awards_name='2' AND awards_winner_year='2017' GROUP BY video_idx";
	$award_result 	= mysqli_query($my_db, $award_query);
	$award_count	= mysqli_num_rows($award_result);
	
	$i = 0;
    while ($award_data = mysqli_fetch_array($award_result))
    {    
		if ($i % 2 == 0)
		{
			// 짝수 배열
			$award_even_list_array[$i] = $award_data;
		}else{
			// 홀수 배열
			$award_odd_list_array[$i] = $award_data;
		}
		$i++;
	}
?>										
									<div class="column">
<?
	foreach($award_even_list_array as $key => $val)
	{
		$video_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$val["video_idx"]."'";
		$video_result 	= mysqli_query($my_db, $video_query);
		$video_data		= mysqli_fetch_array($video_result);

		// 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $video_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        // $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/maxresdefault.jpg";

        $title_count    = mb_strlen($video_data["video_title"],'utf-8');

        if ($title_count > 45)
            $video_title    = substr($video_data["video_title"],0,45)."...";
        else
			$video_title    = $video_data["video_title"];
?>										
										<div class="video">
											<a href="video_detail.php?idx=<?=$video_data['video_idx']?>">
												<figure>
													<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
													<figcaption>
														<span class="brand">[<?=$video_data["video_brand"]?>]</span>
														<span class="title"><?=$video_data["video_title"]?></span>
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
									</div>
									<div class="column right">
<?
	foreach($award_odd_list_array as $key => $val)
	{
		$video_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$val["video_idx"]."'";
		$video_result 	= mysqli_query($my_db, $video_query);
		$video_data		= mysqli_fetch_array($video_result);

		// 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $video_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        // $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/maxresdefault.jpg";

//        $title_count    = mb_strlen($video_data["video_title"],'utf-8');
//
//        if ($title_count > 45)
//            $video_title    = substr($video_data["video_title"],0,45)."...";
//        else
//			$video_title    = $video_data["video_title"];
		
		$video_title    = $video_data["video_title"];
?>										
										<div class="video">
											<a href="video_detail.php?idx=<?=$video_data['video_idx']?>">
												<figure>
													<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
													<figcaption>
														<span class="brand">[<?=$video_data["video_brand"]?>]</span>
														<span class="title"><?=$video_data["video_title"]?></span>
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
									</div>
								</div>
								<!-- <button type="button" class="read-more">
									<img src="./images/plus_icon.png" alt="">
								</button> -->
								<div class="result-empty <?= ($award_count > 0) ? 'hide' : '' ?>">
									<p>검색결과가 없습니다</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="cursor" class="defualt"></div>
		</div>
		<script>
			var select_award = "2";

			$(function() {
				//				global search
				$('#order-date').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-nation').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-industry').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-genre').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-awards').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				$('#order-sortby').selectmenu().selectmenu('menuWidget').addClass( "overflow" );
				//				local search - award
				$('#lc-order-date').selectmenu({
					change: function(event, ui) {
						// console.log(event);
						// console.log(ui.item.value);
						$.ajax({
							type   : "POST",
							async  : false,
							url    : "./ajax_award.php",
							data:{
								"award"					: select_award,
								"award_date"			: ui.item.value
							},
							success: function(response){
//								console.log(response);
								var res_count = response.split('||')[1];
//								console.log(res_count);
								if(res_count < 1)
									$(".result-empty").removeClass('hide');
								else
									$(".result-empty").addClass('hide');
								$("#award_list").html(response);
							}
						});
					}
				}).selectmenu('menuWidget').addClass("overflow");
			});

			//	기본 기능 테스트 코드
			$doc = $(document);
			$win.on('load', function() {
				bannerResizing(1, $('.banner._01').find('.clickEl'));
			});
			function bannerResizing(idx, el) {
				var $me = $(el).parent();
				$me.addClass('is-active');
				$('.awards-banner .banner').not($me).removeClass('is-active');
//				var $notMe = $('.banner').each(function() {
//					
//				});
				
				switch (idx) {
					case 1:
						$me.css({
							left: 0,
							width: 75.4+'%',
							background: "url(./images/cannes_on.png) left center / cover no-repeat",
						});
						$('.banner._02').css({
							width: 40+'%',
							left: 45.5+'%',
							background: "url(./images/newyork_off.png) left center / cover no-repeat",
						});
						$('.banner._03').css({
							width: 40+'%',
							left: 65.2+'%',
							background: "url(./images/clio_off.png) left center / cover no-repeat",
						});
					break;
					case 2:
						$me.css({
							width: 75.4+'%',
							left: 12+'%',
							background: "url(./images/newyork_on.png) left center / cover no-repeat",
						});
						$('.banner._01').css({
							width: 40+'%',
							background: "url(./images/cannes_off.png) left center / cover no-repeat",
						});
						$('.banner._03').css({
							width: 40+'%',
							left: 72+'%',
							background: "url(./images/clio_off.png) left center / cover no-repeat",
						});
					break;
					case 3:
						$me.css({
							width: 75.4+'%',
							left: 30+'%',
							background: "url(./images/clio_on.png) left center / cover no-repeat",
						});
						$('.banner._01').css({
							width: 40+'%',
							background: "url(./images/cannes_off.png) left center / cover no-repeat",
						});
						$('.banner._02').css({
							width: 40+'%',
							left: 10+'%',
							background: "url(./images/newyork_off.png) left center / cover no-repeat",
						});
					break;
				}
			}
			
			function sel_award(award)
			{
				select_award	= award;
				var award_date 	= $("#lc-order-date").val();
				if (award < 4)
				{
					$(".award").hide();
					$(".award._"+award).show();
					$(".award_name").removeClass("is-active");
					$(".award_name._"+award).addClass("is-active");
				}
				$(".award_prize").removeClass("is-active");
				$(".award_prize._"+award).addClass("is-active");


				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_award.php",
					data:{
						"award"					: select_award,
						"award_date"			: award_date
					},
					success: function(response){
//						console.log(response);
						var res_count = response.split('||')[1];
//						console.log(res_count);
						if(res_count < 1)
							$(".result-empty").removeClass('hide');
						else
							$(".result-empty").addClass('hide');
						// res_arr	= response.split("||");
						// current_page = current_page + 1;
						// if (current_page >= total_page)
						// 	$(".read-more").hide();
						// else
						// 	$(".read-more").show();
						$("#award_list").html(response);
					}
				});
			}

			function sel_year(a_date)
			{
				// select_award	= award;
				// var award_date 	= $("#lc-order-date").val();
				// if (award < 4)
				// {
				// 	$(".award").hide();
				// 	$(".award._"+award).show();
				// 	$(".award_name").removeClass("is-active");
				// 	$(".award_name._"+award).addClass("is-active");
				// }
				// $(".award_prize").removeClass("is-active");
				// $(".award_prize._"+award).addClass("is-active");

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_award.php",
					data:{
						"award"					: select_award,
						"award_date"			: a_date
					},
					success: function(response){
//						console.log(response);
						var res_count = response.split('||')[1];
						if(res_count < 1)
							$(".result-empty").removeClass('hide');
						else
							$(".result-empty").addClass('hide');
//						console.log(res_count);
						$("#award_list").html(response);
					}
				});
			}

			// 검색 APPLY 클릭
			$doc.on('click', '#search-layer-submit', function() {
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
		</script>
	</body>

</html>