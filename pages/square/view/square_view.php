<?php
require_once 'pages/square/square.loader.php';


$square_data = json_decode($square_result['data'], true);
$square_cards = json_decode($square_result['square_cards'], true);

$html_title = $SQUARE_CLASS->getHTMLTitle($square_result['title']);

importHeader($html_title);

if ($square_result['type'] == "birthday") echo "<link rel=\"image_src\" href=\"pages/images/birthday_image.jpg\"/>";

?>

<!--Style-->

<style>


    /*데스크탑*/
    @media screen and (min-width: 1367px) {
        .kakao {
            display: none;
        }
    }

    /*랩탑*/
    @media screen and (min-width: 1025px) and (max-width: 1366px) {
        .kakao {
            display: none;
        }
    }

    /*아이패드 가로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {

    }

    /*아이패드 세로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: portrait) {

    }

    /*모바일*/
    @media screen and (min-width: 351px) and (max-width: 767px) {

    }

    /*작은 모바일*/
    @media screen and (max-width: 350px) {

    }
</style>



<!-- html -->
<div class="container" align="center">

    <?php if ($square_result['date'] > getTimeStamp() - 5) { ?>
        <h4>성공적으로 생성되었습니다.</h4>
        <p>주소를 복사해 친구들과 공유할 수 있습니다.</p>

        <br>
        <button type="button" class="btn btn-outline-dark btn-lg" onclick="copyToClipboard(window.location.href)">
            이 페이지 주소 복사
        </button>
        <button type="button" class="btn btn-outline-dark btn-lg"
                onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(document.URL)+'&t='+encodeURIComponent(document.title), 'facebook-share-dialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
            페이스북으로 공유
        </button>
        <button type="button" class="btn btn-outline-dark btn-lg kakao" id="kakao-link-btn" onclick="sendLink()">
            카카오톡으로 공유
        </button>
    <?php } ?>


    <?php for ($i = 0; $i < count($square_cards); $i++) { ?>
        <div class="outer">
            <div class="tablerow">
                <div <?php echo $SQUARE_CLASS->getStyle($square_cards[$i]['style'], $square_cards[$i]['align']); ?>><span
                            style="font-size: 24px;"><?php echo $SQUARE_CLASS->ConvertForRead($HTML_PURIFIER, $square_cards[$i]['content']); ?></span>
                </div>
            </div>
        </div>
    <?php } ?>



    <br><br>
    <button type="button" class="btn btn-dark btn-lg"
            onclick="location.href='<?php echo $square_result['type'] == 'square' ? 'write' : $square_result['type']; ?>'">
        나도 이런거 만들어보기
    </button>
    <br><br>
    <button type="button" class="btn btn-outline-dark btn-lg" onclick="copyToClipboard(window.location.href)">
        이 페이지 주소 복사
    </button>
    <button type="button" class="btn btn-outline-primary btn-lg"
            onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(document.URL)+'&t='+encodeURIComponent(document.title), 'facebook-share-dialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
        페이스북으로 공유
    </button>
    <button type="button" class="btn btn-outline-warning btn-lg kakao" id="kakao-link-btn"
            onclick="sendKakaoLink()">
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

    //KAKAOLINK
    Kakao.init('4c0bd2702cc62066b3e51409f6da1d0c');   // 사용할 앱의 JavaScript 키를 설정해 주세요.

    function sendKakaoLink() {
        Kakao.Link.createDefaultButton({
            container: '#kakao-link-btn',
            objectType: 'feed',
            imageUrl: '<?php echo "https://" . getCorePUrl() . "pages/images/birthday_image.jpg" ?>',
            content: {
                title: '<?php echo $html_title ?>',
                link: {
                    mobileWebUrl: document.URL,
                    webUrl: document.URL
                }
            },

            buttons: [
                {
                    title: 'Square에서 보기',
                    link: {
                        mobileWebUrl: document.URL,
                        webUrl: document.URL
                    }
                }
            ]
        });

    }

</script>

