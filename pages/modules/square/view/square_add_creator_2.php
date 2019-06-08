<?php require_once 'pages/header.php';

$square_key = REQUEST('key');

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
        <h1 class="display-4">Step 2 : 기본정보 입력</h1>
        <p class="lead">생성할 생성기의 기본 정보를 입력해 주세요.</p>
    </div>
    <form action="add_creator_3" method="post" id="creatorform">

    <div class="row">
        <div class="col-sm-6">
            <div class="card align-self-center">

                <div class="card-body">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="creator_name">생성기 이름</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                               aria-describedby="creator_name" name="creator_name" id="creator_name_input">
                    </div>
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">템플릿 KEY</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                               aria-describedby="inputGroup-sizing-default" name="template_square_key"
                               id="template_square_key_input"
                               value="<?php echo $square_key ?>">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">색상 HEX 코드</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                               aria-describedby="inputGroup-sizing-default" name="template_square_key" id="color_input">
                    </div>
                    <div class="form-group">
                        <label for="creator_des_textarea">생성기에 대한 설명</label>
                        <textarea class="form-control" id="creator_des_textarea" rows="3"></textarea>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6 align-content-end">


            <p>- 템플릿 KEY는 템플릿으로 사용할 페이지의 KEY 값을 의미합니다. 입력되어 있으면 변경할 필요 없습니다.</p>
            <p>- 색상 HEX 코드는 생성기의 주요한 색으로 사용할 컬러 코드(예 : #000000)를 이용할 수 있습니다. 필수 입력 사항은 아닙니다.</p>
            <button type="button" class="btn btn-dark btn-lg" onclick="postAct()">다음</button>
        </div>
    </div>


    </form>



</div>


<script>

    function postAct() {

        var creatorform = document.getElementById("creatorform");
        var name = document.getElementById("creator_name_input").value;
        var template_square_key = document.getElementById("template_square_key_input").value;
        var color = document.getElementById("color_input").value;
        var description = document.getElementById("creator_des_textarea").value;

        if (name == "" || template_square_key == "" || description == "") {
            alert("이름, 템플릿 키, 설명 항목을 입력해야 합니다.");
            return false;
        } else {
            creatorform.submit();
        }


    }

</script>