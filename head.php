<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
<?
	if ($detail_data["idx"])
	{
?>	
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?=$detail_data["video_brand"]?>">
	<meta property="og:url" content="http://www.valuable-viral-video.com/video_detail.php?idx=<?=$video_idx?>" />
	<meta property="og:image" content="<?=$yt_thumb?>" />
	<meta property="og:description" content="<?=htmlspecialchars($detail_data["video_title"], ENT_QUOTES, 'utf-8')?>">
<?
	}else{
?>	
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Valuable Viral Video">
	<meta property="og:url" content="http://www.valuable-viral-video.com/" />
	<meta property="og:image" content="http://www.valuable-viral-video.com/images/main_image.png" />
	<meta property="og:description" content="Valuable Viral Video | 가치있는 바이럴 영상만 모여있습니다. 당신에게 영감을 주는 영상은 컬렉션으로 저장하고 공유할 수 있습니다.">
<?
	}
?>	
	<title>Valuable Viral Video - 가치있는 바이럴 영상</title>
	<link rel="stylesheet" href="./css/reset.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.6/css/swiper.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.6/css/swiper.min.css">
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/style.css">
	<link type="image/icon" rel="shortcut icon" href="http://www.valuable-viral-video.com/images/vvvlogo_favicon.ico" />
<!--	<script src="https://unpkg.com/vue"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.6/js/swiper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.0/TweenMax.min.js"></script>
	<script src="./js/main.js"></script>
</head>
