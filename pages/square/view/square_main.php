<?php


$collection_result = json_decode(PostAct(getAPISUrl(), array(array('a', 'square_main'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', getUserAuth()))), true);


importHeader(null);

?>

<!--style-->
<link rel="stylesheet" href="pages/css/main.css">

<!-- html -->
<div class="container">


    <div class="squarecardw" onclick="location.href='write'; " contenteditable="true">새로운 카드 만들기</div>
    <br>


    <div class="row">
        <div class="col-sm-6 col-md-4">

            <div class="squarecard_mainbig">Big 1</div>


        </div>

        <div class="col-sm-6 col-md-4">


            <div class="squarecard_mainbig">Big 2</div>

        </div>


        <div class="col-sm-6 col-md-4">

            <div class="squarecard_mainbig">Big 3</div>


        </div>


    </div>
    <br>
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
        <div class="col-sm-6 col-md-3">

            <div class="squarecard_mainbig">Big 1</div>


        </div>

        <div class="col-sm-6 col-md-3">


            <div class="squarecard_mainbig">Big 2</div>

        </div>

        <div class="col-sm-6 col-md-3">


            <div class="squarecard_mainbig">Big 2</div>

        </div>


        <div class="col-sm-6 col-md-3">


            <div class="squarecard_mainbig">Big 2</div>

        </div>


    </div>
        <br>
        <div class="row">
            <div class="col-sm-6 col-md-3">

                <div class="squarecard_mainbig">Big 1</div>


            </div>

            <div class="col-sm-6 col-md-3">


                <div class="squarecard_mainbig">Big 2</div>

            </div>

            <div class="col-sm-6 col-md-3">


                <div class="squarecard_mainbig">Big 2</div>

            </div>


            <div class="col-sm-6 col-md-3">


                <div class="squarecard_mainbig">Big 2</div>

            </div>


        </div>

