



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

interact('.resize-drag')
    .draggable({
        onmove: dragMoveListener,
        inertia: true,
        restrict: {
            restriction: "parent",
            endOnly: true,
            elementRect: {top: 0, left: 0, bottom: 1, right: 1}
        }
    })
    .resizable({
        edges: {left: true, right: true, bottom: true, top: true},
        onmove: resizeMoveListener
    })


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


function setCardBackgroundColor(cardnum, color) {
    cloadCardBacgroundModal();
    document.getElementById("contents_" + cardnum).style = "background-color : " + color;
    document.getElementById("background_" + cardnum).value = color;

}

function openColorPicker(index) {
    if (picker[index].isOpen()) {
        picker[index].hide();
    } else {

        picker[index].show();
    }
}

function cloadCardBacgroundModal() {
    $('#CardBackgroundModal').modal('hide');
}


function setCardStyle(num, style, background) {

    if (background.startsWith("#")) {
        document.getElementById("contents_" + num).style = "background-color : " + background;
        document.getElementById("background_" + num).value = background;
    } else {
        document.getElementById("contents_" + num).style = "background-image : url('" + background + "'); background-size: 100% 100%;";
        document.getElementById("background_" + num).value = background;

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
        ' <button type="button" class="btn btn btn-outline-secondary"\n' +
        '                        onclick="openColorPicker(' + cardcount + ')"><span\n' +
        '                            class="oi oi-droplet"></span>\n' +
        '                </button>' +
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
        '  <button type="button" class="btn btn btn-outline-secondary" data-toggle="modal"\n' +
        '                        data-target="#FileUploaderModal"><span class="oi oi-data-transfer-upload"></span></button>' +
        '              <button type="button" class="btn btn btn-outline-secondary" data-toggle="modal"  data-target="#CardBackgroundModal"><span class="oi oi-image"></span></button>' +

        '            </div>\n' +
        '            <div class="btn-group btn-group" role="group" aria-label="4 group">\n' +


        '            <div class="btn-group btn-group" role="group" aria-label="5 group"> <button type="button" class="btn btn btn-outline-secondary" onclick="removeCard(' + cardcount + ')"><span class="oi oi-x"></span></button>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '<div class="color-picker" id="color_picker_' + cardcount + '"></div>' +
        '\n' +
        '</div></div>'
    $(cardadd + editor).insertBefore('#squarecard');
    setEditor();
    newPicker(cardcount);
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


function newPicker(index) {

    picker[index] = new Pickr({
        el: document.getElementById("color_picker_" + index),
        useAsButton: false,
        default: '#42445A',
        position: 'middle',

        swatches: [
            'rgba(244, 67, 54, 1)',
            'rgba(233, 30, 99, 0.95)',
            'rgba(156, 39, 176, 0.9)',
            'rgba(103, 58, 183, 0.85)',
            'rgba(63, 81, 181, 0.8)',
            'rgba(33, 150, 243, 0.75)',
            'rgba(3, 169, 244, 0.7)',
            'rgba(0, 188, 212, 0.7)',
            'rgba(0, 150, 136, 0.75)',
            'rgba(76, 175, 80, 0.8)',
            'rgba(139, 195, 74, 0.85)',
            'rgba(205, 220, 57, 0.9)',
            'rgba(255, 235, 59, 0.95)',
            'rgba(255, 193, 7, 1)'
        ],

        components: {

            preview: true,
            opacity: true,
            hue: true,

            interaction: {
                hex: true,
                rgba: true,
                hsva: true,
                input: true,
                clear: true,
                save: true
            }
        }
    });

    picker[index].on('change', (args) => {
        document.execCommand('forecolor', false, args.toHEX());
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


function addAttachToCard(attach, size, name) {

    //Normal Mode
    if (file_uploader_mode == "0") {

        if (name.includes(".jpg") || name.includes(".jpeg") || name.includes(".png")) {
            var x = document.createElement('img');
            x.src = attach;
            x.className = "resize-drag";
            document.getElementById('contents_' + active_card).focus();
            insertNodeOverSelection(x, document.getElementById('contents_' + active_card));

        } else {
            $('#contents_' + active_card).append('<div class="card"><div class="card-body"><h5 class="card-title">' + name + '</h5><p>' + size + '</p><a href="' + attach + '" class="card-link">Download</a></div></div>');


            document.getElementById('contents_' + active_card).focus();

        }
    }

    if (file_uploader_mode == "card_background") {
        setCardStyle(active_card, null, attach);
        //  document.getElementById('contents_' + active_card)
        document.getElementById('contents_' + active_card).focus();
    }


    $('#FileUploaderModal').modal('hide');

}
function insertNodeOverSelection(node, containerNode) {
    var sel, range, html, str;


    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            if (isOrContainsNode(containerNode, range.commonAncestorContainer)) {
                range.deleteContents();
                range.insertNode(node);
            } else {
                containerNode.appendChild(node);
            }
        }
    } else if (document.selection && document.selection.createRange) {
        range = document.selection.createRange();
        if (isOrContainsNode(containerNode, range.parentElement())) {
            html = (node.nodeType == 3) ? node.data : node.outerHTML;
            range.pasteHTML(html);
        } else {
            containerNode.appendChild(node);
        }
    }
}

function isOrContainsNode(ancestor, descendant) {
    var node = descendant;
    while (node) {
        if (node === ancestor) {
            return true;
        }
        node = node.parentNode;
    }
    return false;
}

function openFileUploader(from) {
    file_uploader_mode = from;
    $('#CardBackgroundModal').modal('hide');
    $('#FileUploaderModal').modal('show');
}


function resizeMoveListener(event) {
    var target = event.target,
        x = (parseFloat(target.dataset.x) || 0),
        y = (parseFloat(target.dataset.y) || 0);

    // update the element's style
    target.style.width = event.rect.width + 'px';
    target.style.height = event.rect.height + 'px';

    // translate when resizing from top or left edges
    x += event.deltaRect.left;
    y += event.deltaRect.top;
    updateTranslate(target, x, y);
}

function dragMoveListener(event) {
    var target = event.target,
        // keep the dragged position in the data-x/data-y attributes
        x = (parseFloat(target.dataset.x) || 0) + event.dx,
        y = (parseFloat(target.dataset.y) || 0) + event.dy;
    updateTranslate(target, x, y);
}

function updateTranslate(target, x, y) {
    // translate the element
    target.style.webkitTransform =
        target.style.transform =
            'translate(' + x + 'px, ' + y + 'px)';

    // update the position attributes
    target.dataset.x = x;
    target.dataset.y = y;
}

function dataTransfer() {

    //cleanup
    var $out = document.querySelector(".out-container-wrap");
    while ($out.hasChildNodes()) {
        $out.removeChild($out.lastChild);
    }

    //get source
    var source = document.querySelector('.container-wrap')

    //get data
    var data = getSource(source);

    //add data to target
    setSource($out, data);

}

/**
 * Get data from source div
 */
function getSource(source) {
    var images = source.querySelectorAll('img');
    var text = source.querySelector('div').textContent;

    //build the js object and return it.
    var data = {};
    data.text = text;

    data.image = [];

    for (var i = 0; i < images.length; i++) {
        var img = {}
        img.url = images[i].src
        img.x = images[i].dataset.x;
        img.y = images[i].dataset.y;
        img.h = images[i].height;
        img.w = images[i].width;

        data.image.push(img)
    }
    return data;
}

function setSource(target, data) {

    //set the images.
    for (var i = 0; i < data.image.length; i++) {

        var d = data.image[i];

        //build a new image
        var $img = document.createElement('img');
        $img.src = d.url;
        $img.setAttribute('class', 'resize-drag');
        $img.width = d.w;
        $img.height = d.h;
        $img.dataset.x = d.x;
        $img.dataset.y = d.y;


        var rect = target.getBoundingClientRect();
        $img.style.left = parseInt(rect.left);
        $img.style.top = parseInt(rect.top);
        //transform: translate(82px, 52px)
        $img.style.webkitTransform = $img.style.transform = 'translate(' + $img.dataset.x + 'px,' + $img.dataset.y + 'px)';
        //$img.style.setProperty('-webkit-transform', 'translate('+$img.dataset.x+'px,'+$img.dataset.y+'px)');
        target.appendChild($img);
    }

    //make a fresh div with text content
    var $outContent = document.createElement('div')
    $outContent.setAttribute('class', 'out-container-content');
    $outContent.setAttribute('contenteditable', 'true');
    $outContent.textContent = data.text;

    target.appendChild($outContent);
}

