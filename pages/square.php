<?php


$square_data = json_decode($square_result['data'], true);
$square_cards = json_decode($square_result['square_cards'], true);


?>


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


    <?php for ($i = 0; $i < count($square_cards); $i++) { ?>
        <div class="outer">
            <div class="tablerow">
                <div class="squarecard"><span
                            style="font-size: 32px;"><?php echo ConvertForRead($square_cards[$i]['content']); ?></span>
                </div>
            </div>
        </div>
    <?php } ?>



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
            label: '<?php echo $square_cards[0]['content'] ?>', // 공유할 메세지의 제목을 설정
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

