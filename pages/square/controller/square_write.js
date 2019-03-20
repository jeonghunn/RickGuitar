window.onload = function () {

    setEditor();
    newPicker(1); //picker for firstcard.
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
