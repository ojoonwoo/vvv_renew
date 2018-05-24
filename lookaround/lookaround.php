<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta property="fb:app_id" content="208492239553723" />
<meta property="og:title" content="생명을 살리는 스티커 LOOK AROUND CAMPAIGN" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://minivertising.kr/lookaround.php" />
<meta property="og:image" content="http://minivertising.kr/images/sns_share.jpg" />
<meta property="og:description" content="본 캠페인은 여름철 차량에 방치되어 다치는 어린이들이 더 이상 없도록
우리 모두가 주위에 관심을 갖게 하기 위한 작은 시작이자 움직임입니다." />
<link href="./css/jw.css" rel="stylesheet">
<script type="text/javascript" src="./js/jquery-2.2.1.min.js"></script>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<title>LOOK AROUND</title>
</head>
<body>
<script>
  Kakao.init('ead8e9ecebc7099baedc31de21fbe60b');
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '208492239553723',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

  <div id="wrap">
    <div id="header">
      <div class="top_area clearfix" id="fixNav">
        <span class="logo"><a href="http://minivertising.kr/"><img src="./images/logo.png" width="110" height="18"></a></span>
        <span class="menu_btn"><a href="javascript:void(0);"><img src="./images/menu.png" width="28" height="18"></a></span>
      </div>
        <ul class="menu" style="display:none;">
          <li><a href="javascript:void(0);" onclick="link_target('1');"><img src="./images/menu-01.png" width="183" height="11"></a></li>
          <li><a href="javascript:void(0);" onclick="link_target('2');"><img src="./images/menu-02.png" width="183" height="11"></a></li>
          <li><a href="javascript:void(0);" onclick="link_target('3');"><img src="./images/menu-03.png" width="183" height="11"></a></li>
          <li><a href="javascript:void(0);" onclick="link_target('4');"><img src="./images/menu-04.png" width="183" height="11"></a></li>
          <li><a href="http://minivertising.kr/contact/" target="_blank"><img src="./images/menu-05.png" width="183" height="11"></a></li>
          <li class="share_block">
            <span><a href="javascript:void(0);" onclick="sns_share('fb');"><img src="./images/sns_fb.png" width="30" height="30"></a></span>
            <span><a href="javascript:void(0);" onclick="sns_share('kt');"><img src="./images/sns_ka.png" width="30" height="30"></a></span>
            <span><a href="javascript:void(0);" onclick="sns_share('ks');"><img src="./images/sns_ks.png" width="30" height="30"></a></span>
          </li>
        </ul>
    </div>
    <div id="content">
      <div class="cnt_img">
        <div class="block_img"><img src="./images/img_01.png"></div>
        <div class="block_img target1"><img src="./images/img_02.png"></div>
        <div class="block_img target2"><img src="./images/img_03.png"></div>
        <div class="block_img target3"><img src="./images/img_04.png"></div>
        <div class="block_img target4"><img src="./images/img_05.png"></div>
        <div class="block_img"><img src="./images/img_notice.jpg"></div>
      </div>
      <div class="req_btn">
        <a href="https://goo.gl/forms/JiYjZ9j0vpAtvOCm1" target="_blank" onclick="alert('무작위 추첨으로 배송됨을 알려드립니다.');"><img src="./images/btn.png"></a>
      </div>
      <div class="share_block bottom">
        <a href="javascript:void(0);" onclick="sns_share('fb');"><img src="./images/sns_fb.png" width="39" height="39"></a>
        <a href="javascript:void(0);" onclick="sns_share('kt');"><img src="./images/sns_ka.png" width="39" height="39"></a>
        <a href="javascript:void(0);" onclick="sns_share('ks');"><img src="./images/sns_ks.png" width="39" height="39"></a>
      </div>
    </div>
    <div id="footer">
      <div class="contact">
        <img class="foot_img" src="./images/footer.png">
      </div>
    </div>
  </div>
<script type="text/javascript">
  var tgCnt = 0;
  $(window).scroll(function() {
    var scrollH;
    scrollH = $(document).scrollTop();
    if(scrollH > 0) {
      $('#header').addClass('fixed');
    }else{
      $('#header').removeClass('fixed');
    }
  })
  $(document).ready(function() {
    $(".menu_btn").click(function(){
      $(".menu").slideToggle(500);
    })
    $('#content').click(function(e) {
      if($('.menu').css('display') == 'block') {
        if(!$('.menu', '.menu_btn').has(e.target).length) {
          $('.menu').slideUp(500);
        }
      }
    })
  });

  function link_target(seq) {
    tgCnt++;
    var offset;
    $(".menu").slideToggle(500, function() {
      if(tgCnt == 1) {
        offset = $(".target"+seq).offset().top-110;
      }else {
        offset = $(".target"+seq).offset().top-57;
      }
      // if(seq == '3') {
      //   $('.contact').animate({paddingTop:"55px"}, 1000);
      // }else if(seq == '4') {
      //   $('.contact').animate({paddingTop:"70px"}, 1000);
      // }else {
      //   $('.contact').attr('style', 'padding-top:0px');
      //   $('.contact').attr('style', 'padding-bottom:0px');
      // }
      $("html, body").animate({scrollTop:offset}, 1000);
    });
  }

  function sns_share(media)
  {
    if (media == "fb")
    {
      var newWindow = window.open('https://www.facebook.com/dialog/share?app_id=208492239553723&display=popup&href=' + encodeURIComponent('http://minivertising.kr/lookaround.php'),'sharer','toolbar=0,status=0,width=600,height=325');
    }else if (media == "kt"){
      // 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
          Kakao.Link.sendTalkLink({
            //container: '#kakao-link-btn',
            label: '생명을 살리는 스티커\n\rLOOK AROUND CAMPAIGN\n\r\n\r본 캠페인은 여름철 차량에 방치되어 다치는 어린이들이 더 이상 없도록 우리 모두가 주위에 관심을 갖게 하기 위한 작은 시작이자 움직임입니다.',
            image: {
            src: 'http://minivertising.kr/images/sns_share.jpg',
            width: '1200',
            height: '630'
            },
            webButton: {
            text: '링크 열기',
            url: 'http://minivertising.kr/lookaround.php' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
          }
        })

    }else{
      Kakao.Story.share({
        url: 'http://minivertising.kr/lookaround.php',
        text: '생명을 살리는 스티커\n\rLOOK AROUND CAMPAIGN'
      });
    }
  }
</script>
</body>
</html>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82314847-1', 'auto');
  ga('send', 'pageview');
</script>