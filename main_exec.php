<?php
include_once "./include/autoload.php";

switch ($_REQUEST['exec'])
{
    case "insert_member_info" :
        $mnv_f          = new mnv_function();
        $my_db          = $mnv_f->Connect_MySQL();
        $gubun          = $mnv_f->MobileCheck();

        $mb_name     = trim($_REQUEST["mb_name"]);
        $mb_phone    = trim($_REQUEST["mb_phone"]);
        $mb_addr1    = $_REQUEST["mb_addr1"];
        $mb_addr2    = trim($_REQUEST["mb_addr2"]);
        $mb_week     = $_REQUEST["mb_week"];
        $mb_addr     = $mb_addr1 . " " . $mb_addr2;        

        $query		= "INSERT INTO member_info(mb_ipaddr, mb_name, mb_phone, mb_addr, mb_week, mb_gubun, mb_media, mb_regdate) values('".$_SERVER['REMOTE_ADDR']."','".$mb_name."','".$mb_phone."','".$mb_addr."','".$mb_week."','".$gubun."','".$_SESSION['ss_media']."',now())";
        $result		= mysqli_query($my_db, $query);

        if ($result)
            $flag = "Y";
        else
            $flag = "N";

		echo $flag;
    break;
    
    case "game_click_info" :
        $mnv_f          = new mnv_function();
        $my_db          = $mnv_f->Connect_MySQL();
        $gubun          = $mnv_f->MobileCheck();

        $query		= "INSERT INTO game_info(game_ipaddr, game_gubun, game_media, game_regdate) values('".$_SERVER['REMOTE_ADDR']."','".$gubun."','".$_SESSION['ss_media']."',now())";
        $result		= mysqli_query($my_db, $query);

    break;

    case "insert_share_info" :
        $mnv_f          = new mnv_function();
        $my_db          = $mnv_f->Connect_MySQL();
        $gubun          = $mnv_f->MobileCheck();
        $sns_media		= $_REQUEST['sns_media'];

        $query 		= "INSERT INTO share_info(sns_media, sns_gubun, sns_ipaddr, inner_media, sns_regdate) values('".$sns_media."','".$gubun."','".$_SERVER['REMOTE_ADDR']."','".$_SESSION['ss_media']."','".date("Y-m-d H:i:s")."')";
        $result 	= mysqli_query($my_db, $query);

    break;


}