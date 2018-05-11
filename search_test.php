<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();

    include_once "./head.php";
?>
<body>
    <input type="text" id="search_keyword" style="border:1px solid #000">
    <button type="button">검 색</button><br>
    연도 
    <select id="search_year">
        <option value="">전체</option>
<?
    $s_year = 2000;
    while( $s_year < 2019 )
    {
?>        
        <option value="<?=$s_year?>"><?=$s_year?></option>
<?
        $s_year++;
    }
?>
    </select><br>
    국가
    <select id="search_nation">
        <option value="">전체</option>
        <option value="domestic">국내</option>
        <option value="foreign">해외</option>
    </select><br>
    산업군
    <select id="search_category1">
        <option value="">전체</option>
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
    </select><br>
    장르
    <select id="search_genre">
        <option value="">전체</option>
        <?
    $category1_query	= "SELECT * FROM genre_info WHERE genre_showYN='Y'";
    $category1_result 	= mysqli_query($my_db, $category1_query);
    while ($category1_data = mysqli_fetch_array($category1_result))
    {
?>
        <option value="<?=$category1_data["idx"]?>"><?=$category1_data["genre_name"]?></option>
<?
    }    
?>        
    </select><br>
    광고제
    <select id="search_prize">
        <option value="">전체</option>
        <option value="CLIO">CLIO</option>
        <option value="CAN">CANNE</option>
        <option value="NYF">NYF</option>
    </select><br>
    분류
    <select id="search_sort">
        <option value="new">최신순</option>
        <option value="best">인기순</option>
    </select><br>
    <button type="button" onclick="searchReq()">요 청</button>
    <button type="button" onclick="resetSearch()">새로고침</button>
    <script>
    function searchReq()
    {
        var search_keyword      = $("#search_keyword").val();
        var search_year         = $("#search_year").val();
        var search_nation       = $("#search_nation").val();
        var search_category1    = $("#search_category1").val();
        var search_genre        = $("#search_genre").val();
        var search_prize        = $("#search_prize").val();
        var search_sort         = $("#search_sort").val();

        location.href = "search_page.php?keyword=" + search_keyword + "&year=" + search_year + "&nation=" + search_nation + "&category=" + search_category1 + "&genre=" + search_genre + "&prize=" + search_prize + "&sort=" + search_sort;
    }

    function resetSearch()
    {
        $("#search_keyword").val("");
        $("#search_year").val("");
        $("#search_nation").val("");
        $("#search_category1").val("");
        $("#search_genre").val("");
        $("#search_prize").val("");
        $("#search_sort").val("new");        
    }
    </script>
</body>

</html>