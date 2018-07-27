			<div class="header-container">
				<header>
					<div class="inner">
						<div class="submit-link">
							<a href="javascript:void(0)" data-popup="#send-submit">
								<div class="icon">
									<img src="./images/submit_icon.png" alt="">
								</div>
								<div class="text">
									<span>Submit Your VVV</span>
									<span>새로운 영상을 업로드 해보세요</span>
								</div>
							</a>
						</div>
						<h1>
							<a href="index.php" class="logo" data-mouse-type="ripple">
								<img src="./images/vvv_logo.png" alt="" class="retina">
							</a>
						</h1>
						<div class="actions">
							<div class="user-status">
<?
	if (!$_SESSION['ss_vvv_email'])
	{
?>                                
                                <a href="login.php">LOGIN</a>
<?
    }else{
?>        
                                <a href="logout.php">LOGOUT</a>
<?
    }
?>                        
							</div>
							<div class="search-wrap magnet-wrap">
								<button type="button" class="magnet-parent button-search" data-mouse-type="text" data-text="search">
									<span class="magnet-child"></span>
								</button>
							</div>
						</div>
					</div>
				</header>
			</div>
		<div class="popup send-submit" id="send-submit">
			<button type="button" class="popup-close" data-popup="@close"></button>
			<div class="inner">
				<div class="title">
					<i></i><span>Submit Your VVV</span>
				</div>
				<div class="notice">
					<img src="./images/submit_notice.png" alt="">
				</div>
				<div class="contents">
					<div class="input-group">
						<div class="guide">브랜드</div>
						<div class="input brand">
							<div class="input-line"></div>
							<input type="text" id="" placeholder="광고 브랜드를 입력해주세요">
							<div class="input-line right"></div>
						</div>
						<div class="guide">국가</div>
						<div class="input nation">
							<div class="input-line"></div>
							<!-- <input type="text" id=""> -->
							<select name="submit_nation" id="submit_nation">
								<option value="domestic">국 내</option>
								<option value="foreign">해 외</option>
							</select>
							<div class="input-line right"></div>
						</div>
					</div>
					<div class="input-group">
						<div class="guide">타이틀</div>
						<div class="input">
							<div class="input-line"></div>
							<input type="text" id="" placeholder="광고 타이틀을 입력해주세요">
							<div class="input-line right"></div>
						</div>
					</div>
					<div class="input-group">
						<div class="guide">대행사</div>
						<div class="input">
							<div class="input-line"></div>
							<input type="text" id="" placeholder="광고 대행사를 입력해주세요">
							<div class="input-line right"></div>
						</div>
					</div>
					<div class="input-group">
						<div class="guide">프로덕션</div>
						<div class="input">
							<div class="input-line"></div>
							<input type="text" id="" placeholder="광고 프로덕션을 입력해주세요">
							<div class="input-line right"></div>
						</div>
					</div>
					<div class="input-group">
						<div class="guide">산업군</div>
						<div class="input category">
							<div class="input-line"></div>
							<select name="submit_nation" id="submit_category">
								<option value="" disabled selected>선택</option>
<?
	$category1_query	= "SELECT * FROM category_info WHERE category_level='1' AND category_useYN='Y'";
	$category1_result 	= mysqli_query($my_db, $category1_query);
	while ($category1_data = mysqli_fetch_array($category1_result)) {
?>
								<option value="<?=$category1_data["idx"]?>"><?=$category1_data["category_name"]?></option>
<?
	}
?>
							</select>
							<div class="input-line right"></div>
						</div>
						<div class="guide">장르</div>
						<div class="input genre">
							<div class="input-line"></div>
							<select name="submit_nation" id="submit_genre">
								<option value="" disabled selected>선택</option>
<?
	$genre_query	= "SELECT * FROM genre_info WHERE genre_showYN='Y'";
	$genre_result 	= mysqli_query($my_db, $genre_query);
	while ($genre_data = mysqli_fetch_array($genre_result))
	{
?>
								<option value="<?=$genre_data["idx"]?>"><?=$genre_data["genre_name"]?></option>
<?
	}    
?>
							</select>
							<div class="input-line right"></div>
						</div>
					</div>
					<div class="input-group">
						<div class="guide">유튜브 URL</div>
						<div class="input link">
							<div class="input-line"></div>
							<input type="text" id="" placeholder="광고 프로덕션을 입력해주세요">
							<div class="input-line right"></div>
						</div>
						<div class="guide">게재일자</div>
						<div class="input year">
							<div class="input-line"></div>
							<select name="submit_year_regdate" id="submit_year_regdate">
<?
	$s_year = date("Y");
	while( $s_year > 2010 )
	{
?>        
							<option value="<?=$s_year?>"><?=$s_year?></option>
<?
		$s_year--;
	}
?>
							</select>
							<div class="input-line right"></div>
						</div>
						<div class="input month">
							<div class="input-line"></div>
							<select name="submit_month_regdate" id="submit_month_regdate">
<?
//	$s_month = 1;
	for($i = 1; $i < 13; $i++)
	{
		if($i < 10) 
			$s_month = '0'.$i;
		else
			$s_month = $i;
?>        
								<option value="<?=$s_month?>"><?=$s_month?></option>
<?
	}
?>
							</select>
							<div class="input-line right"></div>
						</div>
					</div>
					<div class="input-group">
						<div class="guide">태그</div>
						<div class="input tag">
							<div class="input-line"></div>
							<input type="text" id="" placeholder="광고 타이틀을 입력해주세요">
							<div class="input-line right"></div>
						</div>
					</div>
					<div class="input-group">
						<div class="button">
							<button>제출하기</button>
						</div>
					</div>
				</div>
			</div>
		</div>
