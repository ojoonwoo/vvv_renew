<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();
    // $mobileYN      = $mnv_f->MobileCheck();

    include_once "./nation_code.php";
    
    include_once "./head.php";
?>
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<body>
    <h1>영상 정보 등록 페이지</h1>
    <table class="table table-bordered" style="width:80%">
        <tr>
            <td>* 국가명</td>
            <td>
                <select id="video_country" class="form-control">
                    <option value="">선택하세요</option>
<?
    foreach($_gl["COUNTRY"]["KR"] as $key => $val)
    {
?>	
                    <option value="<?=$key?>"><?=$val?></option>
<?
    }
?>				
                </select>
            </td>
        </tr>
        <tr>
            <td>* 영상제목</td>
            <td><input type="text" id="video_title" class="form-control" style="border:1px solid #ccc" placeholder="영상 제목을 입력해 주세요"></td>
        </tr>
        <tr>
            <td>* 브랜드명</td>
            <td><input type="text" id="video_brand" class="form-control" style="border:1px solid #ccc" placeholder="브랜드명을 입력해 주세요"></td>
        </tr>
        <tr>
            <td>* 1차 산업군</td>
            <td>
                <select id="video_category1" class="form-control" onchange="change_category1(this.value)">
                    <option value="">선택하세요</option>
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
            </td>
        </tr>
        <tr>
            <td>* 2차 산업군</td>
            <td>
                <select id="video_category2" class="form-control">
                    <option value="">선택하세요</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>장르</td>
            <td>
                <select id="video_genre" class="form-control" onchange="change_category1(this.value)">
                    <option value="">선택하세요</option>
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
            </td>
        </tr>
        <tr>
            <td>* 영상 URL</td>
            <td><input type="text" id="video_link" class="form-control" style="border:1px solid #ccc" placeholder="영상 링크를 입력해 주세요(형식은 https://www.youtube.com/watch?v=hHJBm2kjuXQ 이런 형태로 넣어주세요. 짧은 URL은 api 사용이 되지 않습니다.)"></td>
        </tr>
        <tr>
            <td>영상 설명</td>
            <td>
                <textarea name="" id="video_desc" class="form-control" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td>* Released Date</td>
            <td><input type="text" id="video_date" class="form-control" style="border:1px solid #ccc" placeholder="영상 등록일을 예제와 같은 형식으로 입력해 주세요. ex)2017-11"></td>
        </tr>
        <tr>
            <td>노출 여부 선택</td>
            <td>
                <select id="showYN" class="form-control">
                    <option value="Y">노출</option>
                    <option value="N">비노출</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="button" class="btn btn-success" onclick="input_video();">입력</button>
            </td>
        </tr>
    </table>    
    <? 	include_once "cursor.php"; ?>
    
    <script>
    function change_category1(cate1)
    {
        $.ajax({
			type   : "POST",
			async  : false,
			url    : "./ajax_input_cate.php",
			data:{
				"video_category1"	    : cate1
			},
			success: function(response){
                $("#video_category2").html(response);
			}
		});
    }

    function input_video()
    {
        var video_country 		= $("#video_country").val();
        var video_title 		= $("#video_title").val();
        var video_brand 		= $("#video_brand").val();
        var video_category1 	= $("#video_category1").val();
        var video_category2 	= $("#video_category2").val();
        var video_genre 		= $("#video_genre").val();
        var video_link 	        = $("#video_link").val();
        var video_desc 			= $("#video_desc").val();
        var video_date 			= $("#video_date").val();
        var showYN 				= $("#showYN").val();

        if (video_country == "")
        {
            alert("국가명을 선택해 주세요.");
            return false;
        }

        if (video_title == "")
        {
            alert("영상 제목을 입력해 주세요.");
            return false;
        }

        if (video_brand == "")
        {
            alert("브랜드명을 입력해 주세요.");
            return false;
        }

        if (video_category1 == "")
        {
            alert("브랜드 산업군을 선택해 주세요.");
            return false;
        }
        
        if (video_genre == "")
        {
            alert("장르를 선택해 주세요.");
            return false;
        }

        if (video_date == "")
        {
            alert("영상 등록일을 입력해 주세요.");
            return false;
        }

        if (video_link == "")
        {
            alert("영상링크를 입력해 주세요.");
            return false;
        }

        $.ajax({
            type   : "POST",
            async  : false,
            url    : "./main_exec.php",
            data:{
                "exec"				  : "insert_video",
                "video_country"		  : video_country,
                "video_title"		  : video_title,
                "video_brand"		  : video_brand,
                "video_category1"	  : video_category1,
                "video_category2"	  : video_category2,
                "video_genre"		  : video_genre,
                "video_link"		  : video_link,
                "video_desc"          : video_desc,
                "video_date"		  : video_date,
                "showYN"			  : showYN
            },
            success: function(response){
                console.log(response);
                if (response.match("Y") == "Y")
                {
                    alert("영상이 등록 되었습니다.");
                    location.reload();
                }else{
                    alert("다시 등록해 주세요.");
                    location.reload();
                }
            }
        });			
    }
    </script>
</body>

</html>