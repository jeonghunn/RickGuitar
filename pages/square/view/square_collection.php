<?php

require_once 'pages/square/square.loader.php';

$collection_result = json_decode(PostAct(getAPISUrl(), array(array('a', 'square_collection'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', getUserAuth()), array('name', $act_parameter), array('start_num', 0), array('number', 24))), true);

importHeader(null);


?>

<style>



    /*데스크탑*/
    @media screen and (min-width: 1367px) {
        .squarecard_grid {
            width: 250px;
        }
    }

    /*랩탑*/
    @media screen and (min-width: 1025px) and (max-width: 1366px) {
        .squarecard_grid {
            width: 250px;
        }
    }

    /*아이패드 가로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
        .squarecard_grid {
            width: 250px;
        }
    }

    /*아이패드 세로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: portrait) {
        .squarecard_grid {
            width: 250px;
        }
    }

    /*모바일*/
    @media screen and (min-width: 351px) and (max-width: 767px) {
        .squarecard_grid {
            width: 100%;
        }

        .griddiv {
            width: 100%;
        }
    }

    /*작은 모바일*/
    @media screen and (max-width: 350px) {

    }
</style>


<!--style-->
<link rel="stylesheet" href="pages/css/main.css">


<!-- html -->

<div class="container">

    <!--      <h1 style="font-size: 36px; center;">HaruCore</h1>-->
    <br><br>



        <h2>새로운 업데이트</h2>
        <br>

    <?php for ($i = 0;
    $i < count($collection_result);
    $i++) {

    echo count($collection_result); ?>

    <div id="grid">
        <div class="griddiv">
            <div class="squarecard_grid"><?php echo $SQUARE_CLASS->ConvertForRead($HTML_PURIFIER, $collection_result[$i]['title']); ?></div>
        </div>


        <?php } ?>




    </div>


        <br><br>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>


    </div>

<script>
    var some = new eg.InfiniteGrid("#grid").on("layoutComplete", function (e) {
        // ...
    });
</script>