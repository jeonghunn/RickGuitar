<?php require_once 'pages/header.php';

$creator_name = REQUEST();

?>

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
        <h1 class="display-4"></h1>
        <p class="lead">어떤 형태의 카드를 만들 지 템플릿을 만들어주세요.</p>
        <hr class="my-4">
        <p>사용자마다 다른 값이 나올수 있는 부분은 변수 처리해야합니다. [[gender]] 와 같이 입력하면 추후에 [[gender]] 부분은 다른 값으로 대체하게 됩니다.</p>
        <a class="btn btn-dark btn-lg" href="write?mode=template" role="button">카드 템플릿 만들기</a>
    </div>

</div>