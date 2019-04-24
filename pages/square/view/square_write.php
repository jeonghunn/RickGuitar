<?php
require_once 'pages/square/square.loader.php';
require_once 'pages/header.php';

$mode = REQUEST('mode');
$intro_title = T('write_intro');

if ($mode == "template") {
    $intro_title = T('write_intro_title_template');
}

?>

<!--ColorPicker Style-->
<link rel="stylesheet" href="pages/css/jquery.fileupload.css">
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



</style>

<!-- html -->
<div class="container">

    <h1 style="text-align: center;color: <?php getTitleColor() ?>;"
        class="animated fadeOut delay-2s"><?php echo $intro_title ?></h1>

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
                <button type="button" class="btn btn btn-outline-secondary"
                        onclick="openColorPicker(1)"><span
                            class="oi oi-droplet"></span>
                </button>

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
                        data-target="#FileUploaderModal"><span
                            class="oi oi-data-transfer-upload"></span>
                </button>

                <button type="button" class="btn btn btn-outline-secondary" data-toggle="modal"
                        data-target="#CardBackgroundModal"><span
                            class="oi oi-image"></span>
                </button>


            </div>

        </div>


        </div>
        <div class="color-picker" id="color_picker_1"></div>
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
            <button type="button" class="btn btn btn-outline-secondary" data-toggle="collapse"
                    data-target="#advanced_setting" aria-expanded="false"
                    aria-controls="advanced_setting"><?php S('write_advanced_setting') ?></button>
            <div id="advanced_setting" class="collapse">
                <br>
                <label for="keep_square"><input type='checkbox' id='keep_square' name='keep_square'
                                                value='1'/> <?php S('write_keep_square') ?></label>

            </div>
        </div>


        <br>


        <button type="button" class="btn btn-dark btn-lg" onclick="writeAct()">
            <?php S('write_post') ?>
            </button>


    </center>
    <br><br><br>
    </div> <!-- /container -->


<!-- Card Background ColorPicker Modal -->
<div class="modal fade" id="CardBackgroundModal" tabindex="100" role="dialog" aria-labelledby="CardBackgroundModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php S('write_card_background') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="jumbotron">
                    <h3><?php S('write_card_background_picture') ?></h3>
                    <button class="btn btn-dark" onclick="openFileUploader('card_background')"
                            role="button"><?php S('write_upload_image') ?>
                    </button>
                </div>

                <div class="jumbotron">
                    <h3><?php S('write_card_background_color') ?></h3>

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

                                if (document.activeElement != document.getElementById("selected_color")) {
                                    alert('df');
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

                                }
                            });



                    });


                </script>
            </div>

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

<!-- File Uploader Modal -->
<div class="modal fade" id="FileUploaderModal" tabindex="-1" role="dialog" aria-labelledby="FileUploaderModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php S('write_file_uploader') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="fileupload" action="<?php echo getAPIUrlS() . "?a=attach_upload"; ?>" method="POST"
                      enctype="multtemplate-uploadipart/form-data">
                    <!-- Redirect browsers with JavaScript disabled to the origin page -->

                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                    <div class="row fileupload-buttonbar">
                        <div style="padding-left: 4%">
                            <!-- The fileinput-button span is used to style the file input field as button -->
                            <span class="btn btn-dark fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="uploadedfile[]" multiple>
                </span>
                            <button type="submit" class="btn btn-dark start">
                                <span>Start upload</span>
                            </button>
                            <button type="reset" class="btn btn-outline-dark cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>Cancel upload</span>
                            </button>
                            <button type="button" class="btn btn-outline-dark delete">
                                <span>Delete</span>
                            </button>
                            <input type="checkbox" class="toggle">
                            <!-- The global file processing state -->
                            <span class="fileupload-process"></span>
                        </div>
                        <!-- The global progress state -->
                        <div class="col-lg-5 fileupload-progress fade">
                            <!-- The global progress bar -->
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                 aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                            <!-- The extended global progress state -->
                            <div class="progress-extended">&nbsp;</div>
                        </div>
                    </div>
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped">
                        <tbody class="files"></tbody>
                    </table>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        tabindex="-1"><?php S('close') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- The template to display files available for upload -->

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload animated fadeIn">
        <td>
            <span class="preview"></span>
        </td>
        <td>
             <p class="name" style="word-break:break-all;">{%=file.name%}</p>
            <strong class="error"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress"></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-dark btn-sm start" disabled>Start</button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-outline-dark btn-sm cancel">Cancel</button>
            {% } %}
        </td>
    </tr>
{% } %}

</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download animated fadeIn">
    <td>
    <input type="checkbox" name="delete" value="1" class="toggle">
    </td>
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>

            <p class="name" style="word-break:break-all;">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            </p>
            {% if (file.error) { %}
                <div><span class="error">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <button class="btn btn-outline-dark btn-sm delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>Delete</button>
           <button type="button" class="btn btn-dark btn-sm select" onclick="addAttachToCard('{%=file.url%}', '{%=o.formatFileSize(file.size)%}', '{%=file.name%}' )"><?php S('select') ?></button>

        </td>
    </tr>
{% } %}

</script>
<!--Editor-->
<script src="pages/js/medium-editor.js"></script>
<script src="pages/js/ColorPicker/pickr.min.js"></script>
<script src="pages/js/ColorPicker/getColorPicker.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="pages/js/jquery.iframe-transport.js"></script>
<script src="pages/js/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="pages/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="pages/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="pages/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="pages/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="pages/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="pages/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="pages/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="pages/js/jquery.fileupload-ui.js"></script>


<script>

    var cardcount = 1;
    var active_card = 1;
    var status = '0';
    var isProcessing = false;
    var submitted = false;
    var editor = null;
    var picker = new Array();
    var file_uploader_mode = "0";

    <?php require_once 'pages/square/controller/square_write.js.php'; ?>
    <?php require_once 'pages/square/controller/square_editor.js.php'; ?>
    <?php require_once 'pages/square/controller/square_uploader.js.php'; ?>


</script>


