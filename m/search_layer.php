				<div class="global-search-layer">
					<div class="inner">
						<button type="button" class="search-layer-close"></button>
						<div class="search-wrapper">
							<div class="search-bar">
								<input type="text" placeholder="검색" id="search_keyword" value="<?=$search_keyword?>">
							</div>
							<div class="wrap sortings">
								<div class="sort-list">
									<div class="sort">
										<label for="order-date">연도</label>
										<select name="order-date" id="order-date">
											<option value="" selected>전체</option>
<?
$s_year = 2018;
while( $s_year > 2010 )
{
?>        
											<option value="<?=$s_year?>" <?if($search_year == $s_year){?>selected<?}?>><?=$s_year?></option>
<?
	$s_year--;
}
?>
										</select>
									</div>
									<div class="sort">
										<label for="order-nation">국가</label>
										<select name="order-nation" id="order-nation">
											<option value="" selected>전체</option>
											<option value="domestic" <?if($search_nation == "domestic"){?>selected<?}?>>국내</option>
											<option value="foreign" <?if($search_nation == "foreign"){?>selected<?}?>>해외</option>
										</select>
									</div>
									<div class="sort">
										<label for="order-industry">산업군</label>
										<select name="order-industry" id="order-industry">
											<option value="" selected>전체</option>
<?
$category1_query	= "SELECT * FROM category_info WHERE category_level='1' AND category_useYN='Y'";
$category1_result 	= mysqli_query($my_db, $category1_query);
while ($category1_data = mysqli_fetch_array($category1_result))
{
?>
											<option value="<?=$category1_data["idx"]?>" <?if($search_category == $category1_data["idx"]){?>selected<?}?>><?=$category1_data["category_name"]?></option>
<?
}    
?>
										</select>
									</div>
									<div class="sort">
										<label for="order-genre">장르</label>
										<select name="order-genre" id="order-genre">
											<option value="" selected>전체</option>
<?
$genre_query	= "SELECT * FROM genre_info WHERE genre_showYN='Y'";
$genre_result 	= mysqli_query($my_db, $genre_query);
while ($genre_data = mysqli_fetch_array($genre_result))
{
?>
											<option value="<?=$genre_data["idx"]?>" <?if($search_genre == $genre_data["idx"]){?>selected<?}?>><?=$genre_data["genre_name"]?></option>
<?
}    
?>
										</select>
									</div>
									<div class="sort">
										<label for="order-awards">광고제</label>
										<select name="order-awards" id="order-awards">
											<option value="" selected>전체</option>
											<option value="1" <?if($search_prize == "1"){?>selected<?}?>>CLIO</option>
											<option value="3" <?if($search_prize == "3"){?>selected<?}?>>CANNE</option>
											<option value="2" <?if($search_prize == "2"){?>selected<?}?>>NYF</option>
										</select>
									</div>
									<div class="sort">
										<label for="order-sortby">분류</label>
										<select name="order-sortby" id="order-sortby">
											<option value="" selected>전체</option>
											<option value="new" <?if($search_sort == "new"){?>selected<?}?>>최신순</option>
											<option value="best" <?if($search_sort == "best"){?>selected<?}?>>인기순</option>
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
					<div class="bg-dark search-layer-close"></div>
				</div>
