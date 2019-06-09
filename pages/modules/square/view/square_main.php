<?php


$main_result = json_decode(PostAct(getAPISUrl(), array(array('a', 'square_main'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', getUserAuth()))), true);
$top_items = $main_result['top'];
$new_items = $main_result['new'];

importHeader(null);

?>

<!--style-->
<link rel="stylesheet" href="pages/asset/css/main.css">

<!-- html -->
    <div class="container" style="text-align: center;">


    <!--    <div class="squarecardw" onclick="location.href='write'; " contenteditable="true">새로운 카드 만들기</div>-->

    <button type="button" class="btn btn-dark btn-lg"
            style=" border-radius: 50%; width: 64px; height: 64px; text-align: center; font-size:24px"
            onclick="location.href='write'; ">+
    </button>
    <br><br><br>


    <div class="row">

        <?php

        for ($i = 0;
             $i < count($top_items);
             $i++) {
            ?>


            <div class="col-sm-6 col-md-4">

                <div class="squarecard_mainbig "
                     onclick="location.href='<?php echo $top_items[$i]["square_key"]; ?>'"><?php P($top_items[$i]['title']); ?></div>


            </div>


        <?php } ?>





    </div>
    <br>

<?php if (count($new_items) > 0) { ?>
    <div id="group">

    <div class="row">
        <div class="col-sm-6 col-md-6">
            <h2>새로운 업데이트</h2>
        </div>

        <div class="col-sm-6 col-md-6">
            <small class="d-block text-right mt-3">
                <a href="new">더 보기</a>
            </small>
        </div>

    </div>
    <br>

    <div class="row">
        <?php

        for ($i = 0;
             $i < count($new_items);
             $i++) {
            ?>


            <div class="col-sm-6 col-md-3">

                <div class="squarecard_mainbig "
                     onclick="location.href='<?php echo $new_items[$i]["square_key"]; ?>'"><?php P($new_items[$i]['title']); ?></div>


            </div>


        <?php } ?>


    </div>

<?php } ?>