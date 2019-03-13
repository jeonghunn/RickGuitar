<?php
require_once 'pages/square/square.loader.php';
require_once 'pages/header.php'; ?>

<!--ColorPicker Style-->
<style>
    .colorpicker-2x.colorpicker-with-alpha {
        width: 272px;
    }

    .colorpicker-2x .colorpicker-saturation {
        width: 200px;
        height: 200px;
    }

    .colorpicker-2x .colorpicker-hue,
    .colorpicker-2x .colorpicker-alpha {
        width: 30px;
        height: 200px;
    }

    .colorpicker-2x .colorpicker-alpha,
    .colorpicker-2x .colorpicker-preview {
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
    }

    .colorpicker-2x .colorpicker-preview,
    .colorpicker-2x .colorpicker-preview div {
        height: 30px;
        font-size: 16px;
        line-height: 160%;
    }

    .colorpicker-saturation .colorpicker-guide {
        height: 10px;
        width: 10px;
        border-radius: 10px;
        margin: -5px 0 0 -5px;
    }


    .pcr-button {


    }
</style>

<!-- html -->
<div class="container">

    <h1 style="text-align: center;color: <?php getTitleColor() ?>;"
        class="animated fadeOut delay-2s"><?php S('write_intro') ?></h1>

    <br></br>
    <center>
            <div class="outer">
                <div class="tablerow">
                    <div class="squarecard" id="contents_1" contentEditable="true" onclick="activeCard(1)"></div>
                    <input type="hidden" class="square_background" id="background_1" name="background_1" value="">
                </div>
            </div>


        <div id="edit_1">
        <br>
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"
             style=" display: inline-block; line-height:2.8em">
            <div class="btn-group btn-group" role="group" aria-label="First group">
                <!--                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-camera-slr"-->
                <!--                                                                                  title="icon name"-->
                <!--                                                                                  aria-hidden="true"></span></button>-->
                <!--                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-file"></span></button>-->
                <select name="font_name" id="font_name" class="custom-select custom-select-md">
                    <?php $SQUARE_CLASS->PrintFontSelectOptions(); ?>
                </select>


            </div>
            <div class="btn-group btn-group" role="group" aria-label="First group">

                <select name="font_size" id="font_size" class="custom-select custom-select-md">
                    <?php $SQUARE_CLASS->PrintFontSizeOptions(); ?>
                </select>


            </div>
            <div class="btn-group btn-group" role="group" aria-label="Second group">


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
                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction('JustifyRight')">
                    <span class="oi oi-justify-right"></span>
                </button>
            </div>

            <div class="btn-group btn-group" role="group" aria-label="4 group">
                <!--                <button type="button" class="btn btn btn-outline-secondary"><span class="oi oi-image"></span>-->
                <!--                </button>-->
                <button type="button" class="btn btn btn-outline-secondary" data-toggle="modal"
                        data-target="#ColorPickerModal"><span
                            class="oi oi-image"></span>
                </button>


                <button type="button" class="btn btn btn-outline-secondary">
                    <div class="color-picker"></div>
                </button>



            </div>



        </div>


            <!--     Size, Font       -->


        </div>

        <br>
            <div id="squarecard"></div>
        <br> <br>
        <button type="button" class="btn btn-outline-dark btn-lg" onclick="addCard()"
                style=" border-radius: 50%; width: 64px; height: 64px; text-align: center; font-size:24px"
        >+
        </button>
        <br>
        <p id="status_message"></p><br>
        <div class="dropdown">
            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="write_status_button">
                <?php S('write_public') ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                <a class="dropdown-item" onclick="setStatus('unregistered')"><?php S('write_private_des') ?></a>
                <a class="dropdown-item" onclick="setStatus('0')"><?php S('write_public') ?></a>
            </div>
        </div>


        <br>


        <button type="button" class="btn btn-dark btn-lg" onclick="writeAct()">
            <?php S('write_post') ?>
            </button>


    </center>
    <br><br><br>
    </div> <!-- /container -->


<!-- ColorPicker Modal -->
<div class="modal fade" id="ColorPickerModal" tabindex="-1" role="dialog" aria-labelledby="ColorPickerModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php S('write_choose_color') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cp1" data-color="#6D2781">
                    <input type="text" id="selected_color" class="form-control" style="width:auto"/> <br>

                </div>
                <script>
                    $(function () {
                        $('#cp1')
                            .colorpicker({
                                format: 'auto',
                                inline: true,
                                container: true,
                                extensions: [
                                    {
                                        name: 'swatches',
                                        options: {
                                            colors: {
                                                'tetrad1': '#000',
                                                'tetrad2': '#000',
                                                'tetrad3': '#000',
                                                'tetrad4': '#000'
                                            },
                                            namesAsValues: false
                                        }
                                    }
                                ]
                            })
                            .on('colorpickerChange colorpickerCreate', function (e) {
                                var colors = e.color.generate('tetrad');

                                colors.forEach(function (color, i) {
                                    var colorStr = color.string(),
                                        swatch = e.colorpicker.picker
                                            .find('.colorpicker-swatch[data-name="tetrad' + (i + 1) + '"]');

                                    swatch
                                        .attr('data-value', colorStr)
                                        .attr('title', colorStr)
                                        .find('> i')
                                        .css('background-color', colorStr);
                                });
                            });
                    });


                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        tabindex="-1"><?php S('close') ?></button>
                <button type="button" class="btn btn-primary"
                        onclick="setCardBackgroundColor(active_card ,document.getElementById('selected_color').value)"><?php S('select') ?></button>
            </div>
        </div>
    </div>
</div>

<!--Editor-->
<script src="pages/js/medium-editor.js"></script>
<script src="pages/js/ColorPicker/pickr.min.js"></script>
<script src="pages/js/ColorPicker/getColorPicker.js"></script>

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
                var editables_background = document.querySelectorAll('.square_background');
                localStorage.setItem('temp_card_count', editables.length);
                document.getElementById("status_message").innerHTML = "<?php S('write_temp_saved') ?> " + new Date().toLocaleString();
                for (var i = 0; i < editables.length; i++) {
                    localStorage.setItem(editables[i].getAttribute('id'), editables[i].innerHTML);
                    localStorage.setItem(editables_background[i].getAttribute('id'), editables_background[i].value);

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

        // var spanString = $('<span/>', {
        //     'text': document.getSelection()
        // }).css('font-size', $(this).val() + 'px').prop('outerHTML');
        //
        // document.execCommand('insertHTML', false, spanString);
        document.execCommand('FontSize', false, $(this).val());
        // alert(document.queryCommandValue("FontSize"));
        // alert('Selected value: ' + $(this).val());
    });

    $("#font_name").change(function () {

        // var spanString = $('<span/>', {
        //     'text': document.getSelection()
        // }).css('font-family', $(this).val()).css('font-size', $("#font_size").val() + 'px').prop('outerHTML');
        //
        // document.execCommand('insertHTML', false, spanString);
        document.execCommand('FontName', false, $(this).val());
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
            //   alert(document.querySelectorAll());
            //alert(document.queryCommandValue("FontColor"));
            // selection.toString() !== '' && alert('"' + selection. + '" was selected at ' + e.pageX + '/' + e.pageY);
            document.getElementById("font_size").value = document.queryCommandValue("FontSize");
            document.getElementById("font_name").value = document.queryCommandValue("FontName").replace(/"([^"]+(?="))"/g, '$1');
            //  alert(document.queryCommandValue("FontName"));

        });
    });


    function getTemp() {

        if (localStorage.getItem('temp_card_count') != 0 && localStorage.getItem('temp_card_count') != null) {
            if (confirm("<?php S('write_temp_open_ask') ?>")) {
                //add card first
                var CardCount = localStorage.getItem('temp_card_count');
                for (var i = 1; i <= CardCount; i++) {
                    if (i != 1) addCard();
                    document.getElementById("contents_" + i).innerHTML = localStorage.getItem("contents_" + i);
                    setCardStyle(i, null, localStorage.getItem("background_" + i));
                }


            } else {
                localStorage.clear();
            }

        }
    }

    function setCardBackgroundColor(cardnum, color) {
        closeColorPickerModal();
        document.getElementById("contents_" + cardnum).style = "background-color : " + color;
        document.getElementById("background_" + cardnum).value = color;

    }

    function closeColorPickerModal() {
        $('#ColorPickerModal').modal('hide');
    }

    function setCardStyle(num, style, background) {

        if (background.startsWith("#")) {
            document.getElementById("contents_" + num).style = "background-color : " + background;
            document.getElementById("background_" + num).value = background;
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
        if (document.getElementById(editorid) != null && num != 0) document.getElementById(editorid).style = 'display:none;';
    }

    function showEditor(num) {
        var editorid = "edit_" + num;
        if (num != 0) document.getElementById(editorid).style = '';
    }


    function addCard() {

        cardcount = cardcount + 1;
        var cardadd = '<div class="outer" id="card_' + cardcount + '"> <div class="tablerow"><div class="squarecard  animated fadeInUp" id="contents_' + cardcount + '" onclick="activeCard(' + cardcount + ')" contentEditable="true"></div>   <input type="hidden" class="square_background" id="background_' + cardcount + '" name="background_' + cardcount + '" value=""/></div><div><br>';
        var editor = '<div id="edit_' + cardcount + '">\n' +
            '        <br>\n' +
            '        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"\n' +
            '             style=" display: inline-block; line-height:2.8em">\n' +
            '            <div class="btn-group btn-group" role="group" aria-label="First group">   <select name="font_name_' + cardcount + '" id="font_name_' + cardcount + '" class="custom-select custom-select-md"><?php $SQUARE_CLASS->PrintFontSelectOptions(); ?> </select> \n' +
            '            </div>\n' +
            '            <div class="btn-group btn-group" role="group" aria-label="First group">   <select name="font_size_' + cardcount + '" id="font_size_' + cardcount + '" class="custom-select custom-select-md"><?php $SQUARE_CLASS->PrintFontSizeOptions(); ?> </select>\n' +
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
            '                <button type="button" class="btn btn btn-outline-secondary" onclick="setEditorAction(\'JustifyRight\')"><span class="oi oi-justify-right"></span>\n' +
            '                </button>\n' +
            '            </div>\n' +
            '\n' +
            '            <div class="btn-group btn-group" role="group" aria-label="4 group">\n' +
            '              <button type="button" class="btn btn btn-outline-secondary" data-toggle="modal"  data-target="#ColorPickerModal"><span class="oi oi-image"></span></button>' +

            '            </div>\n' +
            '            <div class="btn-group btn-group" role="group" aria-label="4 group">\n' +


            '            <div class="btn-group btn-group" role="group" aria-label="5 group"> <button type="button" class="btn btn btn-outline-secondary" onclick="removeCard(' + cardcount + ')"><span class="oi oi-x"></span></button>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '\n' +
            '</div></div>'
        $(cardadd + editor).insertBefore('#squarecard');
        setEditor();
        hideEditor(active_card);
        active_card = cardcount;


        $("#font_name_" + cardcount).change(function () {

            document.execCommand('FontName', false, $(this).val());
            // alert(document.queryCommandValue("FontSize"));
            // alert('Selected value: ' + $(this).val());
        });


        //Editor font control onchange
        $("#font_size_" + cardcount).change(function () {

            // var spanString = $('<span/>', {
            //     'text': document.getSelection()
            // }).css('font-size', $(this).val() + 'px').prop('outerHTML');
            //
            // document.execCommand('insertHTML', false, spanString);
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
                //   alert(document.querySelectorAll());
                //alert(document.queryCommandValue("FontColor"));
                // selection.toString() !== '' && alert('"' + selection. + '" was selected at ' + e.pageX + '/' + e.pageY);
                document.getElementById("font_size_" + cardcount).value = document.queryCommandValue("FontSize");
                document.getElementById("font_name_" + cardcount).value = document.queryCommandValue("FontName").replace(/"([^"]+(?="))"/g, '$1');
                //  alert(document.queryCommandValue("FontName"));

            });
        });


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

    function removeCard(num) {
        document.getElementById("card_" + num).remove();
    }



    function writeAct() {
        setProcessing(true);

        var square_cards_array = [];


        for (var i = 1; i <= cardcount; i++) {
            if (document.getElementById("contents_" + i) == null) continue;
            var cardvalue = ConvertForWrite(document.getElementById("contents_" + i).innerHTML);
            //   var alignbool = document.getElementsByName("align_radio_" + i)[0].checked;
            var align_value = "center-center";
            var background = document.getElementById("background_" + i).value;

            square_cards_array.push({align: align_value, content: cardvalue, background: background});

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

