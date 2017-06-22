<?php


$square_data = json_decode($square_result['data'], true);

$birthday_name = $square_data['birthday_name'];
$birthday_year = $square_data['birthday_year'];
$birthday_month = $square_data['birthday_month'];
$birthday_day = $square_data['birthday_day'];
$birthday_contents = $square_result['content'];


?>
<link rel="image_src" href="pages/images/birthday_image.jpg"/>

<!-- html -->
<div class="container" align="center">


    <?php if ($square_result['date'] > getTimeStamp() - 5) { ?>
        <h4>성공적으로 생성되었습니다.</h4>
        <p>주소를 복사해 친구들과 공유할 수 있습니다.</p>

        <br>
        <button type="button" class="btn btn-default btn-lg" onclick="copyToClipboard(window.location.href)">
            이 페이지 주소 복사
        </button>
        <button type="button" class="btn btn-default btn-lg"
                onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(document.URL)+'&t='+encodeURIComponent(document.title), 'facebook-share-dialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
            페이스북으로 공유
        </button>
        <button type="button" class="btn btn-default btn-lg" id="kakao-link-btn" onclick="sendLink()">
            카카오톡으로 공유
        </button>
    <?php } ?>

    <div class="squarecard">
        <div class="centered">
            <br><br><br><br><br><br>
            <p><span style="font-size: 32px;"><span style="font-size: 40px;"><?php echo $birthday_name ?></span> 님은 <br><span
                            style="font-size: 40px;"><?php echo $birthday_year ?></span>년 <span
                            style="font-size: 40px;"><?php echo $birthday_month ?></span>월 <span
                            style="font-size: 40px;"><?php echo $birthday_day ?></span>일에<br> 태어났고,</span>
            </p>

        </div>
    </div>

    <div class="squarecard">
        <div class="centered">
            <br><br><br><br><br><br>
            <span style="font-size: 32px;"><p><span style="font-size: 32px;">﻿지금까지</span></p>
<span style="font-size: 32px;"><span style="font-size: 40px;">6823</span>일</span><br>
지났습니다.</p>

</span>

        </div>
    </div>

    <div class="squarecard">
        <div class="centered">
            <br><br><br><br><br><br>
            <span style="font-size: 32px;">﻿이번 생일이 <br> <span style="font-size: 40px;">20</span>번째 <br>생일이며</span><br/>

        </div>
    </div>

    <div class="squarecard">
        <div class="centered">
            <br><br><br><br><br><br>
            <span style="font-size: 32px;">﻿만으로 <br> <span style="font-size: 40px;">18</span>살 <br>입니다.</span><br/>

        </div>
    </div>

    <div class="squarecard">
        <div class="centered">
            <br><br><br><br><br><br>
            <span style="font-size: 32px;">﻿인생을 시간으로 본다면<br> 지금 시간은<br> <span style="font-size: 40px;">5</span>시 <span
                        style="font-size: 40px;">24</span>분이 됩니다.</span><br/>

        </div>
    </div>


    <div class="squarecard">
        <div class="centered">
            <br><br><br><br><br><br>
            <span style="font-size: 32px;">﻿지금까지 생일이 <br><span style="font-size: 40px;">2794</span>시간 <span
                        style="font-size: 40px;">2</span>분 지났으며,</span>

        </div>
    </div>


    <div class="squarecard">
        <div class="centered">
            <br><br><br><br><br><br>
            <span style="font-size: 32px;">﻿생일이 끝나기까지 <br><span style="font-size: 40px;">3</span>시간 <span
                        style="font-size: 40px;">2</span>분 남았습니다.</span>

        </div>
    </div>

    <div class="squarecard">
        <div class="centered">
            <br><br><br><br><br><br>
            <span style="font-size: 32px;"><span style="font-size: 40px;">﻿2018</span>년 다음 생일은 <br><span
                        style="font-size: 40px;">481</span>일 후가 됩니다.</span><br/>

        </div>
    </div>

    <div class="squarecard">
        <div class="centered">
            <br><h4>5월 4일에는 무슨 일들이 일어났을까요?</h4>
            <hr>
            <h3 style="text-align: -webkit-center; font-weight: normal;"><span style="font-size: 12px;">1919년 - 5·4 운동: 중국 천안문 광장에서 반일운동이 시작되다.</span><br/><br/><span
                        style="font-size: 12px;">1970년 - 베트남 전쟁: 켄트 주립대학교 발포 사건으로 4명이 사망하고 9명이 부상당하다.</span><br/><br/><span
                        style="font-size: 12px;">1979년 - 영국 총선거에서 보수당이 압승, 마거릿 대처가 첫 여자 수상이 되다.</span><br/><br/><span
                        style="font-size: 12px;">1982년 - 장영자·이철희 부부가 어음 사기 사건으로 구속되다.</span><br/><br/><span
                        style="font-size: 12px;">2008년 - 2008년 보령 바닷물 범람 사고가 발생했다.</span><br/><br/><span
                        style="font-size: 12px;">2014년 - 미국 캘리포니아 주 솔라노 카운티에서 열린 2014 트래비스 에어 엑스포 (2014 Travis Air Expo) 에어쇼 도중에 PT-17복엽기가 추락해 조종사 에디 안드레이니(Eddie Andreini)가 사망하다.</span>
            </h3>


        </div>
    </div>

    <div class="squarecard">
        <div class="centered">
            <br><br><br><br><br><br><br>
            <span style="font-size: 40px;">생일 축하해!!!</span><br/>

        </div>
    </div>


    <br><br>
    <button type="button" class="btn btn-default btn-lg" onclick="location.href='home'">
        나도 이런거 만들어보기
    </button>
    <br><br>
    <button type="button" class="btn btn-default btn-lg" onclick="copyToClipboard(window.location.href)">
        이 페이지 주소 복사
    </button>
    <button type="button" class="btn btn-default btn-lg"
            onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(document.URL)+'&t='+encodeURIComponent(document.title), 'facebook-share-dialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
        페이스북으로 공유
    </button>
    <button type="button" class="btn btn-default btn-lg" id="kakao-link-btn" onclick="sendLink()">
        카카오톡으로 공유
    </button>

</div> <!-- /container -->


<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>

    function copyToClipboard(text) {
        window.prompt("택스트창에 있는 주소 복사 :", text);
    }


    var firstImg = $(".imageblock:first-of-type link");
    var contents = "";
    if (firstImg.attr("src")) {
        var firstImgSrc = firstImg.attr("src");
        var firstImgRatio = parseInt(firstImg.css("height")) / parseInt(firstImg.css("width"));
        if (firstImgRatio <= 0.27) var firstImgRatio = 0.27;
    } else {
        var firstImgSrc = location.origin + "/favicon.ico";
        var firstImgRatio = 1
    }

    Kakao.init('4c0bd2702cc62066b3e51409f6da1d0c');   // 사용할 앱의 JavaScript 키를 설정해 주세요.

    function sendLink() {
        Kakao.Link.sendTalkLink({
            label: '<?php echo $birthday_name ?>님의 생일', // 공유할 메세지의 제목을 설정
            image: {
                src: firstImgSrc,
                width: '300',
                height: parseInt(300 * firstImgRatio)
            } // 이건 썸네일을 설정 하는 겁니다.
            ,
            webButton: {
                text: '보기',
                url: document.URL // 각각의 포스팅 본문의 링크를 거는 코드입니다.
            }
        });
    }


</script>

