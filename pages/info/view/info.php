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



</div>