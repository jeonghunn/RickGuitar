<?php


$square_data = json_decode($square_result['data'], true);


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

    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">

                <p><span style="font-size: 32px;"><span
                                style="font-size: 40px;"><?php P($birthday_name) ?></span> 님은 <br><span
                                style="font-size: 40px;"><?php P($birthday_year) ?></span>년 <span
                                style="font-size: 40px;"><?php P($birthday_month) ?></span>월 <span
                                style="font-size: 40px;"><?php P($birthday_day) ?></span>일에<br> 태어났고,</span>
                </p>

            </div>
        </div>
    </div>

    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">
            <span style="font-size: 32px;"><p><span style="font-size: 32px;">﻿지금까지</span></p>
<span style="font-size: 32px;"><span style="font-size: 40px;"><?php echo remain($bt) ?></span>일</span><br>
지났습니다.</p>

</span>

            </div>
        </div>
    </div>

    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">

                <span style="font-size: 32px;">﻿이번 생일이 <br> <span style="font-size: 40px;"><?php echo $birthdaynum ?></span>번째 <br>생일이며</span><br/>
            </div>
        </div>
    </div>

    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">

                <span style="font-size: 32px;">﻿만으로 <br> <span style="font-size: 40px;"><?php echo $realage ?></span>살 <br>입니다.</span><br/>
            </div>
        </div>
    </div>

    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">

            <span style="font-size: 32px;">﻿인생을 시간으로 본다면<br> 지금 시간은<br> <span
                        style="font-size: 40px;"><?php echo $lifehour ?></span>시 <span
                        style="font-size: 40px;"><?php echo $lifemin ?></span>분이 됩니다.</span><br/>
            </div>
        </div>
    </div>


    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">
            <span style="font-size: 32px;">﻿지금까지 생일이 <br><span
                        style="font-size: 40px;"><?php echo $birthdaylasthour ?></span>시간 <span
                        style="font-size: 40px;"><?php echo $birthdaylastmin ?></span>분 지났으며,</span>
            </div>
        </div>
    </div>


    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">
            <span style="font-size: 32px;">﻿생일이 끝나기까지 <br><span
                        style="font-size: 40px;"><?php echo $birthdaylefthour ?></span>시간 <span
                        style="font-size: 40px;"><?php echo $birthdayleftmin ?></span>분 남았습니다.</span>
            </div>
        </div>
    </div>

    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">
            <span style="font-size: 32px;"><span
                        style="font-size: 40px;"><?php echo $nextyear ?></span>년 다음 생일은 <br><span
                        style="font-size: 40px;"><?php echo -remain($nbday) ?></span>일 후가 됩니다.</span><br/>
            </div>
        </div>
    </div>

    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">
            <br><h4><?php P($birthday_month) ?>월 <?php P($birthday_day) ?>일에는 무슨 일들이 일어났을까요?</h4>
            <hr>
            <?php


            if ($birthday_wiki != "") {

                for ($i = 0; $i < count($birthday_wiki_array); $i++) {

                    echo $birthday_wiki_array[$i] . "<br />";

                }


            } else {



                $wikicon = file_get_contents('http://ko.m.wikipedia.org/wiki/' . $birthday_month . '월_' . $birthday_day . '일');

                $DOM = new DOMDocument;
                $DOM->loadHTML(mb_convert_encoding($wikicon, 'HTML-ENTITIES', 'UTF-8'));

//get all H1
                $items = $DOM->getElementsByTagName('ul');


                $itr = $items->item(1);


                if ($itr->hasChildNodes()) {
                    $childs = $itr->childNodes;
                    foreach ($childs as $i) {
                        echo $i->nodeValue . "<br />";
                    }
                }
            }


            ?>

            </div>
        </div>
    </div>

    <div class="outer">
        <div class="tablerow">
            <div class="squarecard">
            <span style="font-size: 40px;"><?php P($birthday_contents) ?></span><br/>
            </div>
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

