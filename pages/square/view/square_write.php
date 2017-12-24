<?php require_once 'pages/header.php'; ?>

<!-- html -->
    <div class="container">

        <h1 style="text-align: center;color: <?php getTitleColor() ?>;">네모 안에 생각을 담아보세요.</h1>
<br><br>
        <center>
            <div class="outer">
                <div class="tablerow">
                    <div class="squarecard">

                        <textarea class="cardtextarea" placeholder="내용을 입력해주세요." id="contents_1"
                                  style=" display:inline-block;   vertical-align:middle; text-align: center;"></textarea>
                        <label class="radio-inline">
                            <input type="radio" name="align_radio_1" id="inlineRadio_left_1" value="left"> 왼쪽 정렬
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="align_radio_1" id="alignradio_center_1" value="center-center"
                                   checked>
                            가운데
                            정렬
                        </label>

                        <br>
                    </div>
                </div>
            </div>
            <br>
            <div id="squarecard"></div>
            <br><br>
            <button type="button" class="btn btn-default btn-lg" onclick="addCard()">
                카드 추가하기
            </button>
            <button type="button" class="btn btn-default btn-lg" onclick="writeAct()">
                작성 완료
            </button>

</center><br><br><br>
    </div> <!-- /container -->


<script src="pages/square/controller/square_class.js"></script>

