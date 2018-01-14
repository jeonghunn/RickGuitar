<?php require_once 'pages/header.php'; ?>

<style>



    /*데스크탑*/
    @media screen and (min-width: 1367px){

        #cardpaper {
            width: 70%;
        }

    }

    /*랩탑*/
    @media screen and (min-width: 1025px) and (max-width: 1366px){

        #cardpaper {
            width: 70%;
        }


    }

    /*아이패드 가로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape){

    }

    /*아이패드 세로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: portrait){

    }

    /*모바일*/
    @media screen and (min-width: 351px) and (max-width: 767px){

    }

    /*작은 모바일*/
    @media screen and (max-width: 350px){

    }
</style>





<!-- html -->

<div class="container">

<!--      <h1 style="font-size: 36px; center;">HaruCore</h1>-->
<br><br>
    <h1 style="font-size: 48px;">
        Ver <?php echo PostAct(getAPIUrl(), array(array('api_key', getAPIKey()), array('a', 'CoreVersion'))); ?></h1>
    <br>

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <a href="http://tarks.net/fsquare" class="btn btn-default" role="button">Square Forum</a>
        </div>
        <div class="btn-group" role="group">
            <a href="http://tarks.net/develop/square" class="btn btn-default" role="button">Square Development
                Server</a>
        </div>
        <div class="btn-group" role="group">
            <a href="http://tarks.net/" class="btn btn-default" role="button">Tarks.net</a>
        </div>
    </div>

    <br><br>


    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="thumbnail">
                <!--       <img src="..." alt="..."> -->
                <div class="caption">
                    <h3>Square</h3>
                    <p><a href="http://square.tarks.net" class="btn btn-default" role="button">square.tarks.net</a></p>
                    <p><a href="fsquare_changelog" class="btn btn-default" role="button">Changelog</a></p>
                    <p><a href="fsquare_notice" class="btn btn-default" role="button">Notice</a></p>
                    <p><a href="fsquare_feedback" class="btn btn-default" role="button">FeedBack</a></p>


                </div>
                <img class="zbxe_widget_output" widget="content" skin="default" colorset="white" content_type="document"
                     module_srls="226360,226358" list_type="image_title_content" tab_type="none" markup_type="list"
                     list_count="1" page_count="1" option_view="title,regdate,content" show_browser_title="Y"
                     show_comment_count="Y" show_trackback_count="Y" show_category="Y" show_icon="Y"
                     order_target="regdate" order_type="desc" thumbnail_type="crop"/>

            </div>


        </div>

        <div class="col-sm-6 col-md-6">

            <div class="thumbnail">
                <!--       <img src="..." alt="..."> -->
                <div class="caption">
                    <h3>Square Development</h3>
                    <p><a href="http://tarks.net/develop/square" class="btn btn-default" role="button">tarks.net/develop/square</a>
                    </p>
                    <p><a href="fsquare_devchangelog" class="btn btn-default" role="button">Changelog</a></p>
                    <p><a href="fsquare_devnotice" class="btn btn-default" role="button">Notice</a></p>
                    <p><a href="fsquare_devfeedback" class="btn btn-default" role="button">FeedBack</a></p>
                </div>
            </div>


            <img class="zbxe_widget_output" widget="content" skin="default" colorset="white" content_type="document"
                 module_srls="226356,226286" list_type="image_title_content" tab_type="none" markup_type="list"
                 list_count="1" page_count="1" option_view="title,regdate,content" show_browser_title="Y"
                 show_comment_count="Y" show_trackback_count="Y" show_category="Y" show_icon="Y" order_target="regdate"
                 order_type="desc" thumbnail_type="crop"/>


        </div>


    </div>

</div>

</div>