<?php require_once 'pages/header.php'; ?>

<!-- html -->
<div class="container">

        <h1 style="text-align: center;color: <?php getTitleColor() ?>;">네모 안에 생각을 담아보세요.</h1>
<br><br>
    <center>
            <div class="outer">
                <div class="tablerow">
                    <div class="squarecard" id="contents_1">

                        <textarea class="cardtextarea" placeholder="내용을 입력해주세요."
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


            <!--            버튼 툴바-->
        <div>
            <br>

            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"
                 style=" display: inline-block;">
                <div class="btn-group btn-group-lg" role="group" aria-label="First group">
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-align-left"
                                                                        aria-hidden="true"></span></button>
                    <button type="button" class="btn btn-default">2</button>
                    <button type="button" class="btn btn-default">3</button>
                    <button type="button" class="btn btn-default">4</button>
                </div>
                <div class="btn-group btn-group-lg" role="group" aria-label="Second group">
                    <button type="button" class="btn btn-default">5</button>
                    <button type="button" class="btn btn-default">6</button>
                    <button type="button" class="btn btn-default">7</button>
                </div>
                <div class="btn-group btn-group-lg" role="group" aria-label="Third group">
                    <button type="button" class="btn btn-default">8</button>
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

    </center>
    <br><br><br>
    </div> <!-- /container -->


<script>

    var cardcount = 1;


    function addCard() {

        cardcount = cardcount + 1;
        $('<div class="outer"> <div class="tablerow"><div class="squarecard"><textarea class="cardtextarea" placeholder="내용을 입력해주세요."  id="contents_' + cardcount + '" ></textarea> <label class="radio-inline"><input type="radio" name="align_radio_' + cardcount + '"  value="left"> 왼쪽 정렬</label> <label class="radio-inline"><input type="radio" name="align_radio_' + cardcount + '"  value="center-center" checked>가운데 정렬</label> <br> </div></div></div><br>').insertBefore('#squarecard');


    }


    function writeAct() {
        setbuttonstatus(false);

        var square_cards_array = [];


        for (var i = 1; i <= cardcount; i++) {
            var cardvalue = ConvertForWrite(document.getElementById("contents_" + i).value);
            var alignbool = document.getElementsByName("align_radio_" + i)[0].checked;
            var align_value = alignbool ? "left" : "center-center";


            square_cards_array.push({align: align_value, content: cardvalue});

        }


        if (document.getElementById("contents_1").value == '') {
            alert('내용을 입력해주세요.');


            setbuttonstatus(true);
            return false;
        }

        var square_cards = JSON.stringify(square_cards_array);


        $.ajax({
            type: "POST",
            url: "<?php echo getAPIUrlS() ?>",
            data: {
                "a": "square_write",
                "apiv": "<?php echo getAPIVersion()?>",
                "api_key": "<?php echo getAPIKey()?>",
                "auth": "<?php echo getUserAuth()?>",
                "type": "square",
                "square_cards": square_cards
            },
            success: function (data) {
                setbuttonstatus(true);
                if (data.indexOf('success') >= 0) {

                    var Result = JSON.parse(data);

                    location.href = Result['square_key'];


                } else {
                    alert('<?php S('error_unknown_error') ?>');


                }
            },

            error: function (jqXHR) {
                setbuttonstatus(true);
                alert('<?php S('error_unknown_error') ?>');
            }


        });


    }


    function ConvertForWrite(content) {
        return replaceAll(content, "\n", "{[br]}");
    }


    function replaceAll(str, searchStr, replaceStr) {
        return str.split(searchStr).join(replaceStr);
    }


    function setbuttonstatus(status) {

        if (status) {
            $('button').prop('disabled', false);
        } else {
            $('button').prop('disabled', true);
        }

    }


</script>

