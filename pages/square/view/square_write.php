<?php require_once 'pages/header.php'; ?>

<!-- html -->
<div class="container">

        <h1 style="text-align: center;color: <?php getTitleColor() ?>;">네모 안에 생각을 담아보세요.</h1>

    <br></br>
    <center>
            <div class="outer">
                <div class="tablerow">
                    <div class="squarecard" id="contents_1" contentEditable="true" onclick="activeCard(1)"></div>
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

        <div id="edit_1">
        <br>
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"
             style=" display: inline-block;">
            <div class="btn-group btn-group" role="group" aria-label="First group">
                <!--                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-camera-slr"-->
                <!--                                                                                  title="icon name"-->
                <!--                                                                                  aria-hidden="true"></span></button>-->
                <!--                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-file"></span></button>-->
            </div>
            <div class="btn-group btn-group" role="group" aria-label="Second group">
                <button type="button" class="btn btn btn-outline-secondary" data-toggle="collapse" href="#fontcontrol"
                "><span class="oi oi-text"></span></button>
                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction('bold')"><span
                            class="oi oi-bold"></span></button>
                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction('italic')"><span
                            class="oi oi-italic"></span></button>
            </div>
            <div class="btn-group btn-group" role="group" aria-label="Third group">
                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction('JustifyLeft')">
                    <span class="oi oi-justify-left"></span>
                </button>
                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction('JustifyCenter')">
                    <span class="oi oi-justify-center"></span>
                </button>
            </div>

            <div class="btn-group btn-group" role="group" aria-label="4 group">
                <!--                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-image"></span>-->
                <!--                </button>-->
                <!--                <button type="button" class="btn btn btn-outline-secondary"><span-->
                <!--                            class="oi oi-caret-bottom"></span></span>-->
                </button>
            </div>
        </div>

            <!--     Size, Font       -->
            <div class="collapse" id="fontcontrol">
                <br>

                크기 <select name="font_size" id="font_size" onselect="alert(0)">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>


                </select>
                글씨체 <select name="font_name" id="font_name">
                    <option value="Roboto, Noto, sans-serif">기본</option>
                    <option value="sans-serif">고딕체</option>
                    <option value="Nanum Square">나눔스퀘어</option>


                </select>
                색상 <select name="font" id="font">
                    <option value="9">빨강</option>
                    <option value="9">주황</option>
                    <option value="9">노랑</option>


                </select>

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
    var active_card = 1;
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


    //Editor font control onchange
    $("#font_size").change(function () {

        document.execCommand('FontSize', false, $(this).val());
        // alert(document.queryCommandValue("FontSize"));
        // alert('Selected value: ' + $(this).val());
    });


    //Mouse Selection update
    $(function () {
        $(document.body).bind('mouseup', function (e) {
            var selection;

            if (window.getSelection) {
                selection = window.getSelection();
            } else if (document.selection) {
                selection = document.selection.createRange();
            }

            //   if(selection.head)
            //  alert(document.queryCommandValue("FontSize"));
            //alert(document.queryCommandValue("FontColor"));
            // selection.toString() !== '' && alert('"' + selection. + '" was selected at ' + e.pageX + '/' + e.pageY);
            document.getElementById("font_size").value = document.queryCommandValue("FontSize");
            document.getElementById("font_name").value = document.queryCommandValue("FontName");

        });
    });


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

    function activeCard(cardnum) {


        if (active_card != cardnum) {
            //old card editor disable
            hideEditor(active_card);
//activeCardChange
            active_card = cardnum;
            //showcard
            showEditor(active_card);

        }

    }


    function setEditorAction(action) {
        document.execCommand(action);
    }



    function hideEditor(num) {
        var editorid = "edit_" + num;
        if (num != 0) document.getElementById(editorid).style = 'display:none;';
    }

    function showEditor(num) {
        var editorid = "edit_" + num;
        if (num != 0) document.getElementById(editorid).style = '';
    }

    function addCard() {

        cardcount = cardcount + 1;
        var cardadd = '<div class="outer"> <div class="tablerow"><div class="squarecard  animated fadeInUp" id="contents_' + cardcount + '" onclick="activeCard(' + cardcount + ')" contentEditable="true"></div></div><div><br>';
        var editor = '<div id="edit_' + cardcount + '">\n' +
            '        <br>\n' +
            '        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"\n' +
            '             style=" display: inline-block;">\n' +
            '            <div class="btn-group btn-group" role="group" aria-label="First group">\n' +
            // '                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-camera-slr"\n' +
            // '                                                                                  title="icon name"\n' +
            // '                                                                                  aria-hidden="true"></span></button>\n' +
            // '                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-file"></span></button>\n' +
            '            </div>\n' +
            '            <div class="btn-group btn-group" role="group" aria-label="Second group">\n' +
            // '                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-text"></span></button>\n' +
            '                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction(\'bold\')"><span class="oi oi-bold"></span></button>\n' +
            '                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction(\'italic\')"><span class="oi oi-italic"></span></button>\n' +
            '            </div>\n' +
            '            <div class="btn-group btn-group" role="group" aria-label="Third group">\n' +
            '                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction(\'JustifyLeft\')"><span class="oi oi-justify-left"></span>\n' +
            '                </button>\n' +
            '                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction(\'JustifyCenter\')"><span class="oi oi-justify-center"></span>\n' +
            '                </button>\n' +
            '            </div>\n' +
            '\n' +
            '            <div class="btn-group btn-group" role="group" aria-label="4 group">\n' +
            // '                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-image"></span>\n' +
            // '                </button>\n' +
            // '                <button type="button" class="btn btn btn-outline-secondary"><span\n' +
            // '                            class="oi oi-caret-bottom"></span></span>\n' +
            // '                </button>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '\n' +
            '</div>'
        $(cardadd + editor).insertBefore('#squarecard');
        setEditor();
        hideEditor(active_card);
        active_card = cardcount;

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

