				<div class="global-search-layer">
					<div class="bg-dark">
						<div class="inner">
							<button type="button" class="layer-close"></button>
							<div class="search-wrapper">
								<div class="search-bar">
									<input type="text" placeholder="검색" id="search_keyword">
								</div>
								<div class="wrap sortings">
									<div class="sort-list">
										<div class="sort">
											<label for="order-date">연도</label>
											<select name="order-date" id="order-date">
												<option disabled selected>전체</option>
<?
    $s_year = 2018;
    while( $s_year > 2010 )
    {
?>        
                                                <option value="<?=$s_year?>"><?=$s_year?></option>
<?
        $s_year--;
    }
?>
											</select>
										</div>
										<div class="sort">
											<label for="order-nation">국가</label>
											<select name="order-nation" id="order-nation">
												<option disabled selected>전체</option>
                                                <option value="domestic">국내</option>
                                                <option value="foreign">해외</option>
											</select>
										</div>
										<div class="sort">
											<label for="order-industry">산업군</label>
											<select name="order-industry" id="order-industry">
												<option disabled selected>전체</option>
<?
    $category1_query	= "SELECT * FROM category_info WHERE category_level='1' AND category_useYN='Y'";
    $category1_result 	= mysqli_query($my_db, $category1_query);
    while ($category1_data = mysqli_fetch_array($category1_result))
    {
?>
                                                <option value="<?=$category1_data["idx"]?>"><?=$category1_data["category_name"]?></option>
<?
    }    
?>
											</select>
										</div>
										<div class="sort">
											<label for="order-genre">장르</label>
											<select name="order-genre" id="order-genre">
												<option disabled selected>전체</option>
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
										</div>
										<div class="sort">
											<label for="order-awards">광고제</label>
											<select name="order-awards" id="order-awards">
												<option disabled selected>전체</option>
                                                <option value="1">CLIO</option>
                                                <option value="3">CANNE</option>
                                                <option value="2">NYF</option>
											</select>
										</div>
										<div class="sort">
											<label for="order-sortby">분류</label>
											<select name="order-sortby" id="order-sortby">
												<option disabled selected>전체</option>
                                                <option value="new">최신순</option>
                                                <option value="best">인기순</option>
											</select>
										</div>
									</div>
									<div class="actions">
										<button type="button" class="button-apply" id="search-layer-submit">
											APPLY
										</button>
										<button type="button" class="button-refresh" id="search-layer-refresh">새로고침</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
