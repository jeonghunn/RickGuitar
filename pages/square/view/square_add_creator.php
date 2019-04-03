<?php require_once 'pages/header.php'; ?>

<style>


    /*데스크탑*/
    @media screen and (min-width: 1367px) {

        #cardpaper {
            width: 70%;
        }

    }

    /*랩탑*/
    @media screen and (min-width: 1025px) and (max-width: 1366px) {

        #cardpaper {
            width: 70%;
        }

    }

    /*아이패드 가로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {

    }

    /*아이패드 세로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: portrait) {

    }

    /*모바일*/
    @media screen and (min-width: 351px) and (max-width: 767px) {

    }

    /*작은 모바일*/
    @media screen and (max-width: 350px) {

    }
</style>


<!-- html -->

<div class="container">

    <!--      <h1 style="font-size: 36px; center;">HaruCore</h1>-->
    <br><br>
    <div class="jumbotron">
        <h1 class="display-4">생성기 만들기</h1>
        <p class="lead">생성기 만들기는 <a href="birthday">나만의 생일 축하 페이지</a> 만들기 처럼 사용자들이 특정 컨텐츠를 쉽게 만들어 볼 수 있도록 도구를 제공하는 생성기를
            만들게 도와주는 페이지입니다.</p>
        <hr class="my-4">
        <p>아이디어만 있으면 간단한 절차를 통해 다른사람들이 사용해 볼 수 있는 생성기를 제작해볼 수 있습니다!</p>
        <a class="btn btn-dark btn-lg" href="#" role="button">시작하기</a>
    </div>

</div>