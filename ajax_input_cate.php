<?
    include_once "./include/autoload.php";

    $mnv_f = new mnv_function();
    $my_db         = $mnv_f->Connect_MySQL();

    $cate1          = $_REQUEST["video_category1"];

    $category2_query	= "SELECT * FROM category_info WHERE category_idx='".$cate1."' AND category_level='2' AND category_useYN='Y'";
    $category2_result 	= mysqli_query($my_db, $category2_query);
    while ($category2_data = mysqli_fetch_array($category2_result))
    {
?>
                    <option value="<?=$category2_data["idx"]?>"><?=$category2_data["category_name"]?></option>
<?
    }    
?>
