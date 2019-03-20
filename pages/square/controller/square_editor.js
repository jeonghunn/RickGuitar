var editor = null;


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