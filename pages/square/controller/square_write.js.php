


window.onload = function () {

    setEditor();
    newPicker(1); //picker for firstcard.
    getTemp();


    document.getElementById("contents_1").focus();

    $(function () {

        $('.draggable, .droppable').sortable({
            connectWith: '.container'
        });

    });

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
            "keep_square": document.getElementById("keep_square").checked ? 1 : 0,
            "type": "square",
            "square_cards": square_cards
        },
        success: function (data) {
            setProcessing(false);
            if (data.indexOf('success') >= 0) {

                localStorage.clear();//delete temp
                submitted = true; //success submit
                var Result = JSON.parse(data);

                //Template mode
                if ('<?php echo $mode ?>'.includes('template')) {
                    location.href = 'add_creator_2?key=' + Result['square_key'];
                } else {
                    //Normal Mode
                    location.href = Result['square_key'];
                }


            } else {
                alert('<?php S('error_unknown_error') ?>'
                )
                ;


            }
        },

        error: function (jqXHR) {
            setProcessing(false);
            alert('<?php S('error_unknown_error') ?>'
            )
            ;
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


