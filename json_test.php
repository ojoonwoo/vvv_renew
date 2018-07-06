<?php
    function scrape_insta($username) 
    {
        $insta_source   = file_get_contents('http://instagram.com/'.$username);
        $shards         = explode('window._sharedData = ', $insta_source);
        $insta_json     = explode(';</script>', $shards[1]); 
        $insta_array    = json_decode($insta_json[0], TRUE);
        return $insta_array;
    }

    $my_account         = 'sehee.an1'; 
    $results_array      = scrape_insta($my_account);

    // 프로필 이름
    $insta_info["insta_name"]               = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["username"];
    // 팔로워 숫자
    $insta_info["insta_follower"]           = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_followed_by"]["count"];
    // 팔로잉 숫자
    $insta_info["insta_following"]          = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_follow"]["count"];
    // 프로필 풀네임
    $insta_info["insta_following"]          = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["full_name"];
    // 인스타 고유 id
    $insta_info["insta_id"]                 = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["id"];
    // 인스타 프로필 이미지
    $insta_info["insta_profile_url"]        = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["profile_pic_url"];
    // 인스타 프로필 HD 이미지
    $insta_info["insta_profile_hd_url"]     = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["profile_pic_url_hd"];
    // 최신 10개 타임라인
    $i = 0;
    while ($i < 11) {
        // 타임라인 이미지 small (640 x 640)
        $insta_info["insta_timeline"][$i]["small_img_url"]      = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["display_resources"][0]["src"];
        // 타임라인 이미지 middle (750 x 750)
        $insta_info["insta_timeline"][$i]["middle_img_url"]     = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["display_resources"][1]["src"];
        // 타임라인 이미지 large (1080 x 1080)
        $insta_info["insta_timeline"][$i]["large_img_url"]      = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["display_resources"][2]["src"];
        // 타임라인 텍스트
        $insta_info["insta_timeline"][$i]["text"]               = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["edge_media_to_caption"]["edges"][0]["node"]["text"];
        // 타임라인 코멘트 갯수
        $insta_info["insta_timeline"][$i]["comment_count"]      = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["edge_media_to_comment"]["count"];
        // 타임라인 좋아요 갯수
        $insta_info["insta_timeline"][$i]["like_count"]         = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["edge_liked_by"]["count"];
        // 타임라인 썸네일 (150 x 150)
        $insta_info["insta_timeline"][$i]["small_thumb1_url"]   = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["thumbnail_resources"][0]["src"];
        // 타임라인 썸네일 (240 x 240)
        $insta_info["insta_timeline"][$i]["small_thumb2_url"]   = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["thumbnail_resources"][1]["src"];
        // 타임라인 썸네일 (320 x 320)
        $insta_info["insta_timeline"][$i]["small_thumb3_url"]   = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["thumbnail_resources"][2]["src"];
        // 타임라인 썸네일 (480 x 480)
        $insta_info["insta_timeline"][$i]["small_thumb4_url"]   = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["thumbnail_resources"][3]["src"];
        // 타임라인 썸네일 (640 x 640)
        $insta_info["insta_timeline"][$i]["small_thumb5_url"]   = $results_array["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"][$i]["node"]["thumbnail_resources"][4]["src"];

        $i++;
    }

    echo "<pre>";
    print_r($insta_info);
    echo "</pre>";
