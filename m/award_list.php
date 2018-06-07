<?
    include_once "../include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();
    $IEYN          = $mnv_f->IECheck();
    $SafariYN          = $mnv_f->SafariCheck();
    // print_r($_SERVER["HTTP_USER_AGENT"]);
    if ($mobileYN == "PC")
    {
        echo "<script>location.href='../index.php';</script>";
    }else{
        $saveMedia     = $mnv_f->SaveMedia();
        $rs_tracking   = $mnv_f->InsertTrackingInfo($mobileYN);
	}

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
					<div class="content awards">
						<div class="inner">
							<div class="awards-banner swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<a href="">
											<figure class="box-content">
												<div class="img box-bg">
													<img src="./images/cannes_m.png" alt="">
												</div>
												<figcaption>
													<p class="award-name">CANNES 2017 Grand Prix</p>
<!--													<p class="award-summ">2017 Grand Prix</p>-->
													<p class="award-title">we're the superhumans</p>
													<div class="link">
														<svg class="progress-current">
															<circle class="prg-circle" cx="15" cy="15" r="14" fill="none" />
															<polygon points="11,10 21,15 11,20"
																	 style="fill:#f7dd30;"/>
														</svg>
														<span class="view">VIEW</span>
													</div>
												</figcaption>
											</figure>
										</a>
									</div>
									<div class="swiper-slide">
										<a href="">
											<figure class="box-content">
												<div class="img box-bg">
													<img src="./images/newyork_m.png" alt="">
												</div>
												<figcaption>
													<p class="award-name">NEWYORK 2017 BEST OF SHOW</p>
<!--													<p class="award-summ">2017 BEST OF SHOW</p>-->
													<p class="award-title">MEET GRAHAM</p>
													<div class="link">
														<svg class="progress-current">
															<circle class="prg-circle" cx="15" cy="15" r="14" fill="none" />
															<polygon points="11,10 21,15 11,20"
																	 style="fill:#f7dd30;"/>
														</svg>
														<span class="view">VIEW</span>
													</div>
												</figcaption>
											</figure>
										</a>
									</div>
									<div class="swiper-slide">
										<a href="">
											<figure class="box-content">
												<div class="img box-bg">
													<img src="./images/clio_m.png" alt="">
												</div>
												<figcaption>
													<p class="award-name">CLIO 2017 Grand</p>
<!--													<p class="award-summ">2017 Grand</p>-->
													<p class="award-title">fearless girl</p>
													<div class="link">
														<svg class="progress-current">
															<circle class="prg-circle" cx="15" cy="15" r="14" fill="none" />
															<polygon points="11,10 21,15 11,20"
																	 style="fill:#f7dd30;"/>
														</svg>
														<span class="view">VIEW</span>
													</div>
												</figcaption>
											</figure>
										</a>
									</div>
								</div>
								<div class="number-pagination">
									<span class="current">1</span>
									<span class="total">3</span>
								</div>
								<div id="awards-banner-pagination" class="awards-banner-pagination"></div>
							</div>
							<div class="cate-wrap">
								<div class="main-cate">
									<div class="sort">
										<select name="lc-order-awards" id="lc-order-awards" class="lc-order-awards" onchange="change_award(this.value)">
											<option class="award_name _2" value="2" selected>NEWYORK</option>
											<option class="award_name _3" value="3">CANNES</option>
											<option class="award_name _1" value="1">CLIO</option>
										</select>
									</div>
									<div class="sort">
										<select name="lc-order-ptype" id="lc-order-ptype" class="lc-order-ptype" onchange="change_prize(this.value)">
<?
    $award_query	= "SELECT * FROM awards_info WHERE 1 AND awards_name='NYF'";
    $award_result 	= mysqli_query($my_db, $award_query);
	$award_count	= mysqli_num_rows($award_result);
    while ($award_data = mysqli_fetch_array($award_result))
    {    
		if ($award_data["awards_prize"] == "")
		{
?>		
											<option value="<?=$award_data["idx"]?>">ALL</option>
<?
		}else{
?>									
											<option value="<?=$award_data["idx"]?>"><?=$award_data["awards_prize"]?></option>
<?
		}
	}
?>											
										</select>
									</div>
								</div>
								<div class="sub-cate">
									<div class="sort">
										<select name="lc-order-date" id="lc-order-date" class="lc-order-date" onchange="change_year(this.value)">
											<option value="2017" selected>2017</option>
											<option value="2016">2016</option>
										</select>
									</div>
								</div>
							</div>
							<div class="list-container">
								<div class="video-list">
<?									
    $award_query	= "SELECT * FROM awards_list_info WHERE 1 AND awards_name='2' AND awards_winner_year='2017' GROUP BY video_idx";

	$award_result 	= mysqli_query($my_db, $award_query);

    while ($award_data = mysqli_fetch_array($award_result))
    {    
		$video_query	= "SELECT * FROM video_info2 WHERE 1 AND video_idx='".$award_data["video_idx"]."'";
		$video_result 	= mysqli_query($my_db, $video_query);
		$video_data		= mysqli_fetch_array($video_result);

		// 유튜브 영상 코드 자르기
        $yt_code_arr1   = explode("v=", $video_data["video_link"]);
        $yt_code_arr2   = explode("&",$yt_code_arr1[1]);
        $yt_thumb       = "https://img.youtube.com/vi/".$yt_code_arr2[0]."/hqdefault.jpg";

        // $title_count    = mb_strlen($video_data["video_title"],'utf-8');

        // if ($title_count > 45)
        //     $video_title    = substr($video_data["video_title"],0,45)."...";
        // else
		// 	$video_title    = $video_data["video_title"];

		$video_title    = $video_data["video_title"];
?>			
									<div class="video">
										<a href="video_detail.php?idx=<?=$video_data["video_idx"]?>">
											<figure>
												<div class="thumbnail box-bg" style="background: url(<?=$yt_thumb?>) center no-repeat; background-size: cover; padding-bottom: 52.92%;"></div>
												<figcaption>
													<span class="brand">[<?=$video_data["video_brand"]?>]</span>
													<span class="title"><?=$video_title?></span>
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
			<? 	include_once "cursor.php"; ?>
		</div>
		<script>
			$doc = $(document);
			
			$doc.ready(function() {
				var awardsBannerSwiper = new Swiper ('.awards-banner', {
					// Optional parameters
					direction: 'horizontal',
					effect: 'fade',
					speed: 650,
					loop: true,
					autoplay: {
						delay: 4000	
					},
					pagination: {
						el: '.awards-banner-pagination',
						type: 'progressbar'
					},
//					disableOnInteraction: false,
					on: {
						init: function() {
							$('.awards-banner').addClass('loaded');
						},
						slideChange: function() {
							$('.number-pagination .current').text(this.realIndex+1);
						},
						slideChangeTransitionStart: function() {
							$('.awards-banner').removeClass('loaded');
						},
						slideChangeTransitionEnd: function() {
							$('.awards-banner').addClass('loaded');
						}
					}
				});
			});

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

			function change_award(val)
			{
				var award_idx	= val;
				var award_date = $("#lc-order-date").val();

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_award.php",
					data:{
						"award"					: award_idx,
						"award_date"			: award_date
					},
					success: function(response){
						res_arr	= response.split("||");
						console.log(res_arr[2]);
						// current_page = current_page + 1;
						// if (current_page >= total_page)
						// 	$(".read-more").hide();
						// else
						// 	$(".read-more").show()
						if(res_arr[2] < 1)
							$(".result-empty").removeClass('hide');
						else
							$(".result-empty").addClass('hide');;
						
						$(".video-list").html(res_arr[0]);
						$(".lc-order-ptype").html(res_arr[1]);
						$(".video-list > .video.loaded").each(function(index) {
							(function(that, i) { 
								var t = setTimeout(function() { 
									$(that).removeClass('loaded');
								}, 500 * i);
							})(this, index);

						});
					}
				});
			}

			function change_prize(val)
			{
				var prize_idx	= val;
				var award_date 	= $("#lc-order-date").val();

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_prize.php",
					data:{
						"prize"					: prize_idx,
						"award_date"			: award_date
					},
					success: function(response){
						res_arr	= response.split("||");
						// current_page = current_page + 1;
						// if (current_page >= total_page)
						// 	$(".read-more").hide();
						// else
						// 	$(".read-more").show();
						if(res_arr[1] < 1)
							$(".result-empty").removeClass('hide');
						else
							$(".result-empty").addClass('hide');
						
						$(".video-list").html(response);
						$(".video-list > .video.loaded").each(function(index) {
							(function(that, i) { 
								var t = setTimeout(function() { 
									$(that).removeClass('loaded');
								}, 500 * i);
							})(this, index);

						});
					}
				});
			}

			function change_year(val)
			{
				var award_date 	= val;
				var prize_idx 	= $("#lc-order-ptype").val();

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_year.php",
					data:{
						"prize_idx"				: prize_idx,
						"award_date"			: award_date
					},
					success: function(response){
						res_arr	= response.split("||");
						if(res_arr[1] < 1)
							$(".result-empty").removeClass('hide');
						else
							$(".result-empty").addClass('hide');
						
						$(".video-list").html(response);
						$(".video-list > .video.loaded").each(function(index) {
							(function(that, i) { 
								var t = setTimeout(function() { 
									$(that).removeClass('loaded');
								}, 500 * i);
							})(this, index);

						});
					}
				});
			}
		</script>
	</body>

</html>