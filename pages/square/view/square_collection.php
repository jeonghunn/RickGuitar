<?php require_once 'pages/header.php'; ?>

<style>



    /*데스크탑*/
    @media screen and (min-width: 1367px) {

    }

    /*랩탑*/
    @media screen and (min-width: 1025px) and (max-width: 1366px) {

    }

    /*아이패드 가로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {

    }

    /*아이패드 세로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: portrait) {

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
    <div id="grid">
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>
        <div class="griddiv">
            <div class="squarecard_grid">Big 2</div>
        </div>


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