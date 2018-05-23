<?php
include_once "./include/autoload.php";

	switch ($_REQUEST['exec'])
	{
		// 카카오 회원 가입 및 로그인 처리
		case "member_kakao_login" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $mb_email					= $_REQUEST["mb_email"];
			$mb_login_way				= $_REQUEST["login_way"];
			$mb_kakao_email_verified	= $_REQUEST["mb_email_verified"];
			$mb_kakao_way_id			= $_REQUEST["mb_way_id"];
			$mb_kakao_profile_img		= $_REQUEST["mb_profile_img"];
			$mb_kakao_name				= $_REQUEST["mb_name"];
			$mb_kakao_thumbnail_img		= $_REQUEST["mb_thumbnail_img"];

			if ($mb_kakao_email_verified == "true")
				$mb_kakao_email_verified = "Y";
			else
				$mb_kakao_email_verified = "N";

			$login_query		= "SELECT * FROM member_info WHERE mb_email='".$mb_email."' AND mb_kakao_way_id='".$mb_kakao_way_id."'";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data			= mysqli_fetch_array($login_result);

            if ($login_data['mb_email'])
			{
				$query		= "UPDATE member_info SET mb_login_date='".date("Y-m-d H:i:s")."' WHERE mb_email='".$login_data['mb_email']."'";
                $result		= mysqli_query($my_db, $query);
                $uid        = $login_data["idx"];
			}else{
				$query    = "INSERT INTO member_info(mb_login_way, mb_name, mb_email, mb_kakao_email_verified, mb_kakao_way_id, mb_kakao_profile_img, mb_kakao_thumbnail_img, mb_join_date, mb_login_date, mb_join_ipaddr) values('".$mb_login_way."','".$mb_kakao_name."','".$mb_email."','".$mb_kakao_email_verified."','".$mb_kakao_way_id."','".$mb_kakao_profile_img."','".$mb_kakao_thumbnail_img."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$result   = mysqli_query($my_db, $query);
                $uid      = mysql_insert_id($result);
			}

			// 회원 이메일, 이름, 로그인 경로 세션 생성
			$_SESSION['ss_vvv_email']		= $mb_email;
			$_SESSION['ss_vvv_idx']		    = $uid;
			$_SESSION['ss_vvv_name']		= $mb_kakao_name;
			$_SESSION['ss_vvv_way']			= $mb_login_way;

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		// 페이스북 회원 가입 및 로그인 처리
		case "member_facebook_login" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $mb_email					= $_REQUEST["mb_email"];
			$mb_login_way				= $_REQUEST["login_way"];
			$mb_facebook_name			= $_REQUEST["mb_name"];
			$mb_facebook_gender			= $_REQUEST["gender"];
			$mb_facebook_birthday		= $_REQUEST["birthday"];
			$mb_facebook_way_id			= $_REQUEST["id"];

			$login_query		= "SELECT * FROM member_info WHERE mb_email='".$mb_email."' AND mb_facebook_way_id='".$mb_facebook_way_id."'";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data			= mysqli_fetch_array($login_result);

			if ($login_data['mb_email'])
			{
				$query		= "UPDATE member_info SET mb_login_date='".date("Y-m-d H:i:s")."' WHERE mb_email='".$login_data['mb_email']."'";
				$result		= mysqli_query($my_db, $query);
                $uid        = $login_data["idx"];
			}else{
				$query    = "INSERT INTO member_info(mb_login_way, mb_name, mb_email, mb_facebook_gender, mb_facebook_birthday, mb_facebook_way_id   , mb_join_date, mb_login_date, mb_join_ipaddr) values('".$mb_login_way."','".$mb_facebook_name."','".$mb_email."','".$mb_facebook_gender."','".$mb_facebook_birthday."','".$mb_facebook_way_id."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$result   = mysqli_query($my_db, $query);
                $uid      = mysql_insert_id($result);
			}

			// 회원 이메일, 이름 세션 생성
			$_SESSION['ss_vvv_email']		= $mb_email;
			$_SESSION['ss_vvv_idx']		    = $uid;
			$_SESSION['ss_vvv_name']		= $mb_facebook_name;
			$_SESSION['ss_vvv_way']			= $mb_login_way;

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "like_video" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $v_idx			= $_REQUEST["v_idx"];

            if ($_SESSION['ss_vvv_idx'])
            {
                $like_query		= "SELECT * FROM like_info WHERE mb_idx='".$_SESSION['ss_vvv_idx']."' AND v_idx='".$v_idx."' AND like_flag='Y'";
                $like_result	= mysqli_query($my_db, $like_query);
                $like_count		= mysqli_num_rows($like_result);
                $like_data		= mysqli_fetch_array($like_result);
    
                if ($like_count == 0)
                {
                    $query		= "INSERT INTO like_info(v_idx, mb_email, mb_idx, like_flag, like_regdate) values('".$v_idx."','".$_SESSION['ss_vvv_email']."','".$_SESSION['ss_vvv_idx']."','Y','".date("Y-m-d H:i:s")."')";
                    $result		= mysqli_query($my_db, $query);
    
                    $query2		= "UPDATE video_info2 SET like_count=like_count+1 WHERE video_idx='".$v_idx."'";
                    $result2	= mysqli_query($my_db, $query2);
                    $flag	= "Y";
                }else{
                    $query		= "UPDATE like_info SET like_flag='N' WHERE v_idx='".$v_idx."' AND mb_idx='".$_SESSION['ss_vvv_idx']."'";
                    $result		= mysqli_query($my_db, $query);
    
                    $query2		= "UPDATE video_info2 SET like_count=like_count-1 WHERE video_idx='".$v_idx."'";
                    $result2	= mysqli_query($my_db, $query2);
                    $flag	= "N";
                }
            }else{
                $flag   = "L";
            }

			echo $flag;
		break;

		case "view_video" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $v_idx			= $_REQUEST["v_idx"];

			$query		= "INSERT INTO view_info(v_idx, mb_idx, mb_email, view_regdate) values('".$v_idx."','".$_SESSION['ss_vvv_idx']."','".$_SESSION['ss_vvv_email']."','".date("Y-m-d H:i:s")."')";
			$result		= mysqli_query($my_db, $query);

            $query2		= "UPDATE video_info2 SET play_count=play_count+1 WHERE video_idx='".$v_idx."'";
			$result2	= mysqli_query($my_db, $query2);

            if ($result2)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "insert_comment" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $v_idx			= $_REQUEST["idx"];
            $comment_text	= $_REQUEST["comment_text"];

            if ($_SESSION['ss_vvv_idx'])
            {
                $query		= "INSERT INTO comment_info(v_idx, mb_email, mb_idx, mb_name, comment_text, comment_regdate) values('".$v_idx."','".$_SESSION['ss_vvv_email']."','".$_SESSION['ss_vvv_idx']."','".$_SESSION['ss_vvv_name']."','".$comment_text."','".date("Y-m-d H:i:s")."')";
                $result		= mysqli_query($my_db, $query);
    
                $query2		= "UPDATE video_info2 SET comment_count=comment_count+1 WHERE video_idx='".$v_idx."'";
                $result2	= mysqli_query($my_db, $query2);
    
                if ($result)
                    $flag	= "Y";
                else
                    $flag	= "N";
            }else{
                $flag   = "L";
            }

			echo $flag;
		break;

		case "insert_share_info" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $sns_media		= $_REQUEST['sns_media'];
			$sns_flag		= $_REQUEST['sns_flag'];

			$query 		= "INSERT INTO ".$_gl['share_info_table']."(sns_media, sns_gubun, sns_ipaddr, sns_email, inner_media, sns_regdate) values('".$sns_media."','".$gubun."','".$_SERVER['REMOTE_ADDR']."','".$_SESSION['ss_vvv_email']."','".$_SESSION['ss_media']."','".date("Y-m-d H:i:s")."')";
			$result 	= mysqli_query($my_db, $query);

			if($result) {
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;

		case "report_comment" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $c_idx		= $_REQUEST["c_idx"];

			$query 		= "INSERT INTO ".$_gl['report_info_table']."(c_idx, reporter_email, reporter_ipaddr, report_regdate) values('".$c_idx."','".$_SESSION['ss_vvv_email']."','".$_SERVER['REMOTE_ADDR']."','".date("Y-m-d H:i:s")."')";
			$result 	= mysqli_query($my_db, $query);

			if($result) {
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;
		
		case "delete_comment" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $c_idx		= $_REQUEST["c_idx"];

			$query 		= "UPDATE ".$_gl['comment_info_table']." SET showYN='N' WHERE idx='".$c_idx."'";
			$result 	= mysqli_query($my_db, $query);

			if($result) {
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;
		
		case "request_translate" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $v_idx		= $_REQUEST["v_idx"];

            if ($_SESSION['ss_vvv_idx'])
            {
                $query 		= "INSERT INTO translate_info(v_idx, requester_email, requester_ipaddr, request_regdate) values('".$v_idx."','".$_SESSION['ss_vvv_email']."','".$_SERVER['REMOTE_ADDR']."','".date("Y-m-d H:i:s")."')";
                $result 	= mysqli_query($my_db, $query);

                if($result) {
                    $flag = "Y";
                }else{
                    $flag = "N";
                }
            }else{
                $flag = "L";
            }

			echo $flag;
		break;
		
		case "insert_video" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $video_country		= $_REQUEST["video_country"];
			$video_title		= addslashes($_REQUEST["video_title"]);
			$video_company		= addslashes($_REQUEST["video_company"]);
			$video_category		= $_REQUEST["video_category"];
			$video_agency		= addslashes($_REQUEST["video_agency"]);
			$video_production	= addslashes($_REQUEST["video_production"]);
			$video_date			= $_REQUEST["video_date"];
			$video_link			= $_REQUEST["video_link"];
			$video_desc			= addslashes($_REQUEST["video_desc"]);
			$showYN				= $_REQUEST["showYN"];

			$query 		= "INSERT INTO ".$_gl['video_info_table']."(video_company, video_agency, video_production, video_country, video_category, video_link, video_title, video_desc, showYN, video_date, video_regdate) values('".$video_company."','".$video_agency."','".$video_production."','".$video_country."','".$video_category."','".$video_link."','".$video_title."','".$video_desc."','".$showYN."','".$video_date."','".date("Y-m-d H:i:s")."')";
			$result 	= mysqli_query($my_db, $query);

			if($result) {
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;

        case "follow_member" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $follow_idx		= $_REQUEST["follow_idx"];

            if ($_SESSION['ss_vvv_idx'])
            {
                $dupli_query    = "SELECT * FROM follow_info WHERE follow_idx='".$follow_idx."' AND follower_idx='".$_SESSION['ss_vvv_idx']."' AND follow_YN='Y'";
                $dupli_result 	= mysqli_query($my_db, $dupli_query);
                $dupli_count    = mysqli_num_rows($dupli_result);

                if ($dupli_count > 0)
                {
                    // 팔로워 테이블 정보 UPDATE
                    $query 		= "UPDATE follow_info SET follow_YN='N' WHERE follow_idx='".$follow_idx."' AND follower_idx='".$_SESSION['ss_vvv_idx']."' AND follow_YN='Y'";
                    $result 	= mysqli_query($my_db, $query);    

                    // 회원 테이블(follow) 정보 UPDATE
                    $member_query 	= "UPDATE member_info SET mb_follower_count = mb_follower_count - 1 WHERE idx='".$follow_idx."'";
                    $member_result 	= mysqli_query($my_db, $member_query);    
                    
                    // 회원 테이블(follower) 정보 UPDATE
                    $member_query 	= "UPDATE member_info SET mb_following_count = mb_following_count - 1 WHERE idx='".$_SESSION['ss_vvv_idx']."'";
                    $member_result 	= mysqli_query($my_db, $member_query);    

                    if($result) {
                        $flag = "D";
                    }else{
                        $flag = "N";
                    }
                }else{
                    $query 		= "INSERT INTO follow_info(follow_idx, follower_idx, follow_regdate) values('".$follow_idx."','".$_SESSION['ss_vvv_idx']."','".date("Y-m-d H:i:s")."')";
                    $result 	= mysqli_query($my_db, $query);    

                    // 회원 테이블(follow) 정보 UPDATE
                    $member_query 	= "UPDATE member_info SET mb_follower_count = mb_follower_count + 1 WHERE idx='".$follow_idx."'";
                    $member_result 	= mysqli_query($my_db, $member_query);    
                    
                    // 회원 테이블(follower) 정보 UPDATE
                    $member_query 	= "UPDATE member_info SET mb_following_count = mb_following_count + 1 WHERE idx='".$_SESSION['ss_vvv_idx']."'";
                    $member_result 	= mysqli_query($my_db, $member_query);    

                    if($result) {
                        $flag = "Y";
                    }else{
                        $flag = "N";
                    }
                }

            }else{
                $flag = "L";
            }

			echo $flag;
        break;
        
        case "create_collection" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $collection_name		= $_REQUEST["collection_name"];
            $collection_desc		= $_REQUEST["collection_desc"];
            $collection_secret		= $_REQUEST["collection_secret"];

            if ($collection_secret == "true")
                $collection_secret = "Y";
            else
                $collection_secret = "N";        

            $name_query     = "SELECT * FROM collection_info WHERE collection_mb_idx='".$_SESSION['ss_vvv_idx']."' AND collection_name='".$collection_name."' AND collection_showYN='Y'";
            $name_result    = mysqli_query($my_db, $name_query);
            $name_count     = mysqli_num_rows($name_result);

            if ($name_count > 0)
            {
                $flag   = "D";
            }else{
                $query 		= "INSERT INTO collection_info(collection_name, collection_desc, collection_mb_idx, collection_secret, collection_regdate) values('".$collection_name."','".$collection_desc."','".$_SESSION['ss_vvv_idx']."','".$collection_secret."','".date("Y-m-d H:i:s")."')";
                $result 	= mysqli_query($my_db, $query);    

                if($result) {
                    $flag = "Y";
                }else{
                    $flag = "N";
                }
            }
			echo $flag;
        break;
        
        case "delete_collection" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $collection_idx 		= $_REQUEST["collection_idx"];

            $delete_query     = "UPDATE collection_info SET collection_showYN='N' WHERE idx='".$collection_idx."'";
            $delete_result    = mysqli_query($my_db, $delete_query);

            if($delete_result) {
                $flag = "Y";
            }else{
                $flag = "N";
            }

            echo $flag;
		break;

        case "add_video" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $c_idx 		        = $_REQUEST["c_idx"];
            $m_idx 		        = $_REQUEST["m_idx"];
            $video_items 		= $_REQUEST["video_items"];

            $insert_query     = "INSERT INTO collection_item_info(c_idx, m_idx, video_items, regdate) values('".$c_idx."','".$m_idx."','".$video_items."','".date("Y-m-d H:i:s")."')";
            $insert_result    = mysqli_query($my_db, $insert_query);

            if($insert_result) {
                $flag = "Y";
            }else{
                $flag = "N";
            }

            echo $flag;
		break;
	}