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

			// $login_query		= "SELECT * FROM member_info WHERE mb_email='".$mb_email."' AND mb_kakao_way_id='".$mb_kakao_way_id."'";
			$login_query		= "SELECT * FROM member_info WHERE 1 AND mb_kakao_way_id='".$mb_kakao_way_id."'";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data			= mysqli_fetch_array($login_result);

            if ($login_data['idx'])
			{
				$query		= "UPDATE member_info SET mb_login_date='".date("Y-m-d H:i:s")."' WHERE idx='".$login_data['idx']."'";
                $result		= mysqli_query($my_db, $query);
                $uid        = $login_data["idx"];

                if ($result)
                    $flag	= "Y";
                else
                    $flag	= "N";
			}else{
				$query    = "INSERT INTO member_info(mb_login_way, mb_name, mb_email, mb_kakao_email_verified, mb_kakao_way_id, mb_kakao_profile_img, mb_kakao_thumbnail_img, mb_join_date, mb_login_date, mb_join_ipaddr) values('".$mb_login_way."','".$mb_kakao_name."','".$mb_email."','".$mb_kakao_email_verified."','".$mb_kakao_way_id."','".$mb_kakao_profile_img."','".$mb_kakao_thumbnail_img."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$result   = mysqli_query($my_db, $query);
                $uid      = mysqli_insert_id($my_db);

                if ($result)
                    $flag	= "J";
                else
                    $flag	= "N";
			}

			// 회원 이메일, 이름, 로그인 경로 세션 생성
			$_SESSION['ss_vvv_email']		= $mb_email;
			$_SESSION['ss_vvv_idx']		    = $uid;
			$_SESSION['ss_vvv_name']		= $mb_kakao_name;
			$_SESSION['ss_vvv_way']			= $mb_login_way;

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

			$login_query		= "SELECT * FROM member_info WHERE 1 AND mb_facebook_way_id='".$mb_facebook_way_id."'";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data			= mysqli_fetch_array($login_result);

			if ($login_data['idx'])
			{
				$query		= "UPDATE member_info SET mb_login_date='".date("Y-m-d H:i:s")."' WHERE idx='".$login_data['idx']."'";
				$result		= mysqli_query($my_db, $query);
                $uid        = $login_data["idx"];

                if ($result)
                    $flag	= "Y";
                else
                    $flag	= "N";
            }else{
				$query    = "INSERT INTO member_info(mb_login_way, mb_name, mb_email, mb_facebook_gender, mb_facebook_birthday, mb_facebook_way_id   , mb_join_date, mb_login_date, mb_join_ipaddr) values('".$mb_login_way."','".$mb_facebook_name."','".$mb_email."','".$mb_facebook_gender."','".$mb_facebook_birthday."','".$mb_facebook_way_id."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$result   = mysqli_query($my_db, $query);
                $uid      = mysqli_insert_id($my_db);

                if ($result)
                    $flag	= "J";
                else
                    $flag	= "N";
			}

            // 회원 이메일, 이름 세션 생성
			$_SESSION['ss_vvv_email']		= $mb_email;
			$_SESSION['ss_vvv_idx']		    = $uid;
			$_SESSION['ss_vvv_name']		= $mb_facebook_name;
			$_SESSION['ss_vvv_way']			= $mb_login_way;

			echo $flag;
        break;
        
        case "update_member" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $mb_email       = $_REQUEST["mb_email"];
            $mb_nickname    = $_REQUEST["mb_nickname"];
            $mb_emailYN     = $_REQUEST["mb_emailYN"];

            if ($mb_emailYN == "true")
                $mb_emailYN = "Y";
            else
                $mb_emailYN = "N";
            
            if ($mb_nickname == "")
            {
                $query		= "UPDATE member_info SET mb_email='".$mb_email."', mb_nickname='".$mb_nickname."', mb_emailYN='".$mb_emailYN."' WHERE idx='".$_SESSION['ss_vvv_idx']."'";
                $result		= mysqli_query($my_db, $query);    

                if ($result)
                    $flag	= "Y";
                else
                    $flag	= "N";
            }else{
                $dupli_query		= "SELECT * FROM member_info WHERE 1 AND mb_nickname='".$mb_nickname."'";
                $dupli_result		= mysqli_query($my_db, $dupli_query);
                $dupli_count		= mysqli_num_rows($dupli_result);

                if ($dupli_count > 0)
                {
                    $flag = "D";
                }else{
                    $query		= "UPDATE member_info SET mb_email='".$mb_email."', mb_nickname='".$mb_nickname."', mb_emailYN='".$mb_emailYN."' WHERE idx='".$_SESSION['ss_vvv_idx']."'";
                    $result		= mysqli_query($my_db, $query);    

                    if ($result)
                        $flag	= "Y";
                    else
                        $flag	= "N";
                }
            }

            echo $flag;
        break;

        case "edit_member" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $edit_nickname      = $_REQUEST["edit_nickname"];
            $edit_secret        = $_REQUEST["edit_secret"];
            $profile_url        = $_REQUEST["profile_url"];

            if ($edit_secret == "true")
                $edit_secret = "N";
            else
                $edit_secret = "Y";        
            
            if ($profile_url == "")
                $query		= "UPDATE member_info SET mb_nickname='".$edit_nickname."', mb_showYN='".$edit_secret."' WHERE idx='".$_SESSION['ss_vvv_idx']."'";
            else
                $query		= "UPDATE member_info SET mb_profile_url='".$profile_url."', mb_nickname='".$edit_nickname."', mb_showYN='".$edit_secret."' WHERE idx='".$_SESSION['ss_vvv_idx']."'";
            
            $result		= mysqli_query($my_db, $query);

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

        case "collect_video" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $v_idx			= $_REQUEST["v_idx"];
            $c_idx			= $_REQUEST["c_idx"];

            $item_query		= "SELECT * FROM collection_item_info WHERE c_idx='".$c_idx."' AND m_idx='".$_SESSION['ss_vvv_idx']."'";
            $item_result	= mysqli_query($my_db, $item_query);
            $item_count     = mysqli_num_rows($item_result);

            if ($item_count > 0)
            {
                $item_data     = mysqli_fetch_array($item_result);
                $item_arr      = explode(",", $item_data["video_items"]);
                $flag = "";
                foreach($item_arr as $key => $val)
                {
                    if ($val == $v_idx)
                    {
                        $flag = "D"; // 이미 해당 영상이 선택한 컬렉션에 담겨 있음.
                        break;
                    }
                }

                if ($flag == "")
                {
                    $video_item_txt      = $item_data["video_items"].",".$v_idx;                
                    $query		= "UPDATE collection_item_info SET video_items='".$video_item_txt."' WHERE c_idx='".$c_idx."' AND m_idx='".$_SESSION['ss_vvv_idx']."'";
                    $result	    = mysqli_query($my_db, $query);

                    $query2		= "UPDATE video_info2 SET collect_count=collect_count+1 WHERE video_idx='".$v_idx."'";
                    $result2	= mysqli_query($my_db, $query2);
                }

            }else{
                $video_item_txt = $v_idx;
                $query     = "INSERT INTO collection_item_info(c_idx, m_idx, video_items, regdate) values('".$c_idx."','".$_SESSION['ss_vvv_idx']."','".$video_item_txt."','".date("Y-m-d H:i:s")."')";
                $result    = mysqli_query($my_db, $query);

                $query2		= "UPDATE video_info2 SET collect_count=collect_count+1 WHERE video_idx='".$v_idx."'";
                $result2	= mysqli_query($my_db, $query2);
            }

            if ($flag == "")
            {
                if ($result)
                    $flag = "Y";
                else
                    $flag = "N";
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

		case "remove_comment" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $comment_idx	= $_REQUEST["idx"];

            $query		= "UPDATE comment_info SET showYN='N' WHERE idx='".$comment_idx."'";
            $result		= mysqli_query($my_db, $query);

            $query2		= "UPDATE video_info2 SET comment_count=comment_count-1 WHERE video_idx='".$v_idx."'";
            $result2		= mysqli_query($my_db, $query2);

            if ($result)
                $flag	= "Y";
            else
                $flag	= "N";

			echo $flag;
		break;

		case "insert_share_info" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $sns_media		= $_REQUEST['sns_media'];
			$sns_flag		= $_REQUEST['sns_flag'];

			$query 		= "INSERT INTO share_info(sns_media, sns_gubun, sns_ipaddr, sns_email, inner_media, sns_regdate) values('".$sns_media."','".$gubun."','".$_SERVER['REMOTE_ADDR']."','".$_SESSION['ss_vvv_email']."','".$_SESSION['ss_media']."','".date("Y-m-d H:i:s")."')";
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
        
        case "search_follow_member" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $follow_idx		= $_REQUEST["follow_idx"];
            $followYN		= $_REQUEST["followYN"];

            if ($_SESSION['ss_vvv_idx'])
            {
                if ($followYN == "Y")
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
                
                // $query 		= "INSERT INTO follow_info(follow_idx, follower_idx, follow_regdate) values('".$follow_idx."','".$_SESSION['ss_vvv_idx']."','".date("Y-m-d H:i:s")."')";
                // $result 	= mysqli_query($my_db, $query);    

                // // 회원 테이블(follow) 정보 UPDATE
                // $member_query 	= "UPDATE member_info SET mb_follower_count = mb_follower_count + 1 WHERE idx='".$follow_idx."'";
                // $member_result 	= mysqli_query($my_db, $member_query);    
                
                // // 회원 테이블(follower) 정보 UPDATE
                // $member_query 	= "UPDATE member_info SET mb_following_count = mb_following_count + 1 WHERE idx='".$_SESSION['ss_vvv_idx']."'";
                // $member_result 	= mysqli_query($my_db, $member_query);    

                // if($result) {
                //     $flag = "Y";
                // }else{
                //     $flag = "N";
                // }
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
                $collection_secret = "N";
            else
                $collection_secret = "Y";        

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
        
        case "create_detail_collection" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $collection_name		= $_REQUEST["collection_name"];
            $collection_desc		= $_REQUEST["collection_desc"];
            $collection_secret		= $_REQUEST["collection_secret"];

            if ($collection_secret == "true")
                $collection_secret = "N";
            else
                $collection_secret = "Y";        

            $name_query     = "SELECT * FROM collection_info WHERE collection_mb_idx='".$_SESSION['ss_vvv_idx']."' AND collection_name='".$collection_name."' AND collection_showYN='Y'";
            $name_result    = mysqli_query($my_db, $name_query);
            $name_count     = mysqli_num_rows($name_result);

            if ($name_count > 0)
            {
                $flag   = "D||0";
            }else{
                $query 		= "INSERT INTO collection_info(collection_name, collection_desc, collection_mb_idx, collection_secret, collection_regdate) values('".$collection_name."','".$collection_desc."','".$_SESSION['ss_vvv_idx']."','".$collection_secret."','".date("Y-m-d H:i:s")."')";
                $result 	= mysqli_query($my_db, $query);    
                $uid        = mysqli_insert_id($my_db);

                if($result) {
                    $flag = "Y||".$uid;
                }else{
                    $flag = "N||0";
                }
            }
			echo $flag;
        break;
        
        case "edit_collection" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $collection_name		= $_REQUEST["collection_name"];
            $collection_desc		= $_REQUEST["collection_desc"];
            $collection_secret		= $_REQUEST["collection_secret"];
            $c_idx          		= $_REQUEST["c_idx"];

            if ($collection_secret == "true")
                $collection_secret = "N";
            else
                $collection_secret = "Y";        

            // $name_query     = "SELECT * FROM collection_info WHERE collection_mb_idx='".$_SESSION['ss_vvv_idx']."' AND collection_name='".$collection_name."' AND collection_showYN='Y'";
            // $name_result    = mysqli_query($my_db, $name_query);
            // $name_count     = mysqli_num_rows($name_result);

            // if ($name_count > 0)
            // {
            //     $flag   = "D";
            // }else{
                $query 		= "UPDATE collection_info SET collection_name='".$collection_name."', collection_desc='".$collection_desc."', collection_secret='".$collection_secret."' WHERE idx='".$c_idx."'";
                $result 	= mysqli_query($my_db, $query);    

                if($result) {
                    $flag = "Y";
                }else{
                    $flag = "N";
                }
            // }
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

        case "like_collection" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $collection_idx 	= $_REQUEST["collection_idx"];
            $showYN             = $_REQUEST["showYN"];

            if ($_SESSION['ss_vvv_idx'])
            {
                if ($showYN == "Y")
                {
                    $query      = "UPDATE collection_like_info SET showYN='N' WHERE c_idx='".$collection_idx."' AND m_idx='".$_SESSION['ss_vvv_idx']."'";
                    $result     = mysqli_query($my_db, $query);    

                    $query2      = "UPDATE collection_info SET collection_like_count = collection_like_count + 1 WHERE idx='".$collection_idx."'";
                    $result2     = mysqli_query($my_db, $query2);    

                    $flag       = "N";
                }else{
                    $query          = "SELECT * FROM collection_like_info WHERE c_idx='".$collection_idx."' AND m_idx='".$_SESSION['ss_vvv_idx']."'";
                    $result         = mysqli_query($my_db, $query);    
                    $data_count     = mysqli_num_rows($result);

                    if ($data_count > 0)
                    {
                        $query      = "UPDATE collection_like_info SET showYN='Y' WHERE c_idx='".$collection_idx."' AND m_idx='".$_SESSION['ss_vvv_idx']."'";
                        $result     = mysqli_query($my_db, $query);    
                    }else{
                        $query      = "INSERT INTO collection_like_info(c_idx, m_idx, regdate) values('".$collection_idx."','".$_SESSION['ss_vvv_idx']."','".date("Y-m-d H:i:s")."')";
                        $result     = mysqli_query($my_db, $query);    
                    }

                    $query2      = "UPDATE collection_info SET collection_like_count = collection_like_count + 1 WHERE idx='".$collection_idx."'";
                    $result2     = mysqli_query($my_db, $query2);    

                    $flag       = "Y";
                }
    
            }else{
                $flag = "L";
            }

            echo $flag;
		break;

        case "delete_like_collection" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $collection_idx 	= $_REQUEST["collection_idx"];

            $query      = "UPDATE collection_like_info SET showYN='N' WHERE c_idx='".$collection_idx."' AND m_idx='".$_SESSION['ss_vvv_idx']."'";
            $result     = mysqli_query($my_db, $query);    

            $query2      = "UPDATE collection_info SET collection_like_count = collection_like_count - 1 WHERE idx='".$collection_idx."'";
            $result2     = mysqli_query($my_db, $query2);    

            if($result) {
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
            $add_video_arr      = explode(",",$video_items);

            // 컬렉션 아이템 정보 가져오기
            $collection_item_query		= "SELECT * FROM collection_item_info WHERE c_idx='".$c_idx."' AND m_idx='".$m_idx."'";
            $collection_item_result		= mysqli_query($my_db, $collection_item_query);
            $collection_item_data		= mysqli_fetch_array($collection_item_result);

            if ($collection_item_data)
            {
                $collection_item_arr	    = explode(",", $collection_item_data["video_items"]);
                $add_video_txt              = "";

                $i = 0;
                $comma_txt  = "";
                foreach ($add_video_arr as $key => $val)
                {
                    $dupli_flag = 0;
                    
                    if ($i > 0)
                        $comma_txt = ",";
                    foreach ($collection_item_arr as $c_key => $c_val)
                    {
                        if ($val == $c_val)
                        {
                            $dupli_flag = 1;
                        }
                    }

                    if ($dupli_flag == 0)
                        $add_video_txt .= $comma_txt.$val;

                    $query2		= "UPDATE video_info2 SET collect_count=collect_count+1 WHERE video_idx='".$val."'";
                    $result2	= mysqli_query($my_db, $query2);        
                    $i++;
                }

                $add_video_txt = $collection_item_data["video_items"].$add_video_txt;
                $query     = "UPDATE collection_item_info SET video_items='".$add_video_txt."', editdate='".date("Y-m-d H:i:s")."' WHERE c_idx='".$c_idx."' AND m_idx='".$m_idx."'";
                $result    = mysqli_query($my_db, $query);

            }else{
                $query     = "INSERT INTO collection_item_info(c_idx, m_idx, video_items, regdate) values('".$c_idx."','".$m_idx."','".$video_items."','".date("Y-m-d H:i:s")."')";
                $result    = mysqli_query($my_db, $query);

                foreach ($add_video_arr as $key => $val)
                {
                    $query2		= "UPDATE video_info2 SET collect_count=collect_count+1 WHERE video_idx='".$val."'";
                    $result2	= mysqli_query($my_db, $query2);        
                }
            }

            if($result) {
                $flag = "Y";
            }else{
                $flag = "N";
            }    

            echo $flag;
        break;
        
        case "delete_video" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();
            $gubun          = $mnv_f->MobileCheck();

            $c_idx 		        = $_REQUEST["c_idx"];
            $m_idx 		        = $_REQUEST["m_idx"];
            $video_items 		= $_REQUEST["video_items"];
            $del_video_arr      = explode(",",$video_items);

            // 컬렉션 아이템 정보 가져오기
            $collection_item_query		= "SELECT * FROM collection_item_info WHERE c_idx='".$c_idx."' AND m_idx='".$m_idx."'";
            $collection_item_result		= mysqli_query($my_db, $collection_item_query);
            $collection_item_data		= mysqli_fetch_array($collection_item_result);
         
            $collection_item_arr	    = explode(",", $collection_item_data["video_items"]);
            $del_video_txt              = "";

            //삭제실행
            $result = array_diff($collection_item_arr, $del_video_arr);

            foreach ($del_video_arr as $d_key => $d_val)
            {
                $query2		= "UPDATE video_info2 SET collect_count=collect_count-1 WHERE video_idx='".$d_val."'";
                $result2	= mysqli_query($my_db, $query2);        
            }

            //index 채우기
            $result_arr = array_values($result);

            $i = 0;
            foreach ($result_arr as $key => $val)
            {
                if ($i != 0)
                    $del_video_txt .= ",";

                $del_video_txt .= $val;

                $i++;
            }

            $query     = "UPDATE collection_item_info SET video_items='".$del_video_txt."', editdate='".date("Y-m-d H:i:s")."' WHERE c_idx='".$c_idx."' AND m_idx='".$m_idx."'";
            $result    = mysqli_query($my_db, $query);

            if($result) {
                $flag = "Y";
            }else{
                $flag = "N";
            }    

            echo $flag;
        break;

        case "insert_contact" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();

            $contact_name		= $_REQUEST["contact_name"];
            $contact_email		= $_REQUEST["contact_email"];
            $contact_comment	= $_REQUEST["contact_comment"];

            $query     = "INSERT INTO contact_info(contact_name, contact_email, contact_comment, contact_regdate) values('".$contact_name."','".$contact_email."','".$contact_comment."','".date("Y-m-d H:i:s")."')";
            $result    = mysqli_query($my_db, $query);

            if($result) {
                $flag = "Y";
            }else{
                $flag = "N";
            }    

            echo $flag;
        break;

        case "insert_video" :
            $mnv_f          = new mnv_function();
            $my_db          = $mnv_f->Connect_MySQL();

            $video_country		= $_REQUEST["video_country"];
            $video_title		= addslashes($_REQUEST["video_title"]);
            $video_brand		= addslashes($_REQUEST["video_brand"]);
            $video_category1	= $_REQUEST["video_category1"];
            $video_category2	= $_REQUEST["video_category2"];
            $video_genre		= $_REQUEST["video_genre"];
            $video_link			= $_REQUEST["video_link"];
            $video_tag			= $_REQUEST["video_tag"];
            $video_desc			= addslashes($_REQUEST["video_desc"]);
            $video_date			= $_REQUEST["video_date"];
            $showYN				= $_REQUEST["showYN"];

            $v_idx_query    = "SELECT * FROM video_info2 ORDER BY video_idx DESC LIMIT 1";
            $v_idx_result 	= mysqli_query($my_db, $v_idx_query);
            $v_idx_data     = mysqli_fetch_array($v_idx_result);
            
            $next_v_idx     = $v_idx_data["video_idx"] + 1;
            $query 		= "INSERT INTO video_info2(video_idx, video_brand, video_country, video_category1, video_category2, video_genre, video_link, video_tag, video_title, video_desc, showYN, video_date, video_regdate) values('".$next_v_idx."','".$video_brand."','".$video_country."','".$video_category1."','".$video_category2."','".$video_genre."','".$video_link."','".$video_tag."','".$video_title."','".$video_desc."','".$showYN."','".$video_date."','".date("Y-m-d H:i:s")."')";
            $result 	= mysqli_query($my_db, $query);

            if($result) {
                $flag = "Y";
            }else{
                $flag = "N";
            }

            echo $flag;
        break;

	}