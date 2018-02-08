<?php require_once 'pages/header.php'; ?>

<!-- html -->
<div class="container">

        <h1 style="text-align: center;color: <?php getTitleColor() ?>;">네모 안에 생각을 담아보세요.</h1>

    <br></br>
    <center>
            <div class="outer">
                <div class="tablerow">
                    <div class="squarecard" id="contents_1" contentEditable="true" onclick="alert(0)"></div>
                </div>
            </div>

        <!--                        <textarea class="cardtextarea" placeholder="내용을 입력해주세요."-->
        <!--                                  style=" display:inline-block;   vertical-align:middle; text-align: center;"></textarea>-->


        <!--                        <label class="radio-inline">-->
        <!--                            <input type="radio" name="align_radio_1" id="inlineRadio_left_1" value="left"> 왼쪽 정렬-->
        <!--                        </label>-->
        <!--                        <label class="radio-inline">-->
        <!--                            <input type="radio" name="align_radio_1" id="alignradio_center_1" value="center-center"-->
        <!--                                   checked>-->
        <!--                            가운데-->
        <!--                            정렬-->
        <!--                        </label>-->
            <!--            버튼 툴바-->
        <!--        <div>-->
        <!--            <br>-->
        <!---->

        <div id="edit">
        <br>
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"
             style=" display: inline-block;">
            <div class="btn-group btn-group" role="group" aria-label="First group">
                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-camera-slr"
                                                                                  title="icon name"
                                                                                  aria-hidden="true"></span></button>
                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-file"></span></button>
            </div>
            <div class="btn-group btn-group" role="group" aria-label="Second group">
                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-text"></span></button>
                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-bold"></span></button>
                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-italic"></span></button>
            </div>
            <div class="btn-group btn-group" role="group" aria-label="Third group">
                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-justify-left"></span>
                </button>
                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-justify-center"></span>
                </button>
            </div>
        </div>

</div>

        <br>
            <div id="squarecard"></div>
        <br> <br>

        <p id="status_message"></p><br>
        <div class="dropdown">
            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="write_status_button">
                <?php S('write_public') ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" onclick="setStatus('0')"><?php S('write_public') ?></a>
                <a class="dropdown-item" onclick="setStatus('unregistered')"><?php S('write_private_des') ?></a>
            </div>
        </div>


        <br>
        <button type="button" class="btn btn-outline-dark btn-lg" onclick="addCard()">
            <?php S('write_add_card') ?>
        </button>

        <button type="button" class="btn btn-dark btn-lg" onclick="writeAct()">
            <?php S('write_post') ?>
            </button>


    </center>
    <br><br><br>
    </div> <!-- /container -->

<script src="pages/js/medium-editor.js"></script>



<script>


    var editor = null;
    var cardcount = 1;
    var activeCard = 0;
    var status = '0';
    var isProcessing = false;
    var submitted = false;

    window.onload = function () {

        setEditor();
        getTemp();



        document.getElementById("contents_1").focus();
    };

    //temp save
    setInterval(function () {
            if (checkWrote()) {
                var editables = document.querySelectorAll('.squarecard');
                localStorage.setItem('temp_card_count', editables.length);
            document.getElementById("status_message").innerHTML = "임시 저장되었습니다. " + new Date().toLocaleString();
                for (var i = 0; i < editables.length; i++) {
                    localStorage.setItem(editables[i].getAttribute('id'), editables[i].innerHTML);

                }

            } else {
                document.getElementById("status_message").innerHTML = "";
                localStorage.clear();
            }


        }
    ,
        5000
    );

    window.onbeforeunload = function () {

        if (checkPreventClose()) {
            return true;
        }

    }


    function getTemp() {

        if (localStorage.getItem('temp_card_count') != 0 && localStorage.getItem('temp_card_count') != null) {
            if (confirm("작성중이던 글이 있습니다. 불러오시겠습니까?")) {
                //add card first
                var CardCount = localStorage.getItem('temp_card_count');
                for (var i = 1; i <= CardCount; i++) {
                    if (i != 1) addCard();
                    document.getElementById("contents_" + i).innerHTML = localStorage.getItem("contents_" + i);
                }


            } else {
                localStorage.clear();
            }

        }
    }

    function addCard() {

        cardcount = cardcount + 1;
        var cardadd = '<div class="outer"> <div class="tablerow"><div class="squarecard  animated fadeInUp" id="contents_' + cardcount + '" contentEditable="true"></div></div><div><br>';
        $(cardadd).insertBefore('#squarecard');
        setEditor();

    }

    function setEditor() {
        editor = new MediumEditor('.squarecard', {
            toolbar: {
                buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'image', 'justifyLeft', 'justifyCenter', 'h1'],
            },
            buttonLabels: 'fontawesome',
            anchor: {
                targetCheckbox: true
            }
        });
    }


    function writeAct() {
        setProcessing(true);

        var square_cards_array = [];


        for (var i = 1; i <= cardcount; i++) {
            var cardvalue = ConvertForWrite(document.getElementById("contents_" + i).innerHTML);
            //   var alignbool = document.getElementsByName("align_radio_" + i)[0].checked;
            var align_value = "center-center";


            square_cards_array.push({align: align_value, content: cardvalue});

        }


        if (!checkWrote()) {
            alert('내용을 입력해주세요.');


            setProcessing(false);
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
                "status": status,
                "type": "square",
                "square_cards": square_cards
            },
            success: function (data) {
                setProcessing(false);
                if (data.indexOf('success') >= 0) {

                    localStorage.clear();//delete temp
                    submitted = true; //success submit
                    var Result = JSON.parse(data);

                    location.href = Result['square_key'];


                } else {
                    alert('<?php S('error_unknown_error') ?>');


                }
            },

            error: function (jqXHR) {
                setProcessing(false);
                alert('<?php S('error_unknown_error') ?>');
            }


        });


    }

    function checkPreventClose() {
        console.log(((checkWrote()) && (!submitted)));
        return ((checkWrote()) && (!submitted));
    }

    function checkWrote() {
        return document.getElementById("contents_1").innerHTML != '';
    }

    function setStatus(s) {
        status = s;
        if (status == '0') document.getElementById("dropdownMenuButton").innerHTML = "<?php S('write_public') ?>";
        if (status == 'unregistered') document.getElementById("dropdownMenuButton").innerHTML = "<?php S('write_private') ?>";
    }

    function ConvertForWrite(content) {
        content = replaceAll(content, "<", "{[");
        content = replaceAll(content, ">", "]}");
        return content;
    }

    function activeCardEditor(card_n) {


    }
    function replaceAll(str, searchStr, replaceStr) {
        return str.split(searchStr).join(replaceStr);
    }

    function setProcessing(status) {
        isProcessing = status;
        setbuttonstatus(!status);
    }


    function setbuttonstatus(status) {

        if (status) {
            $('button').prop('disabled', false);
        } else {
            $('button').prop('disabled', true);
        }

    }


</script>

