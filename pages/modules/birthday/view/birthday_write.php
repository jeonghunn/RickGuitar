<?php
require_once 'pages/birthday/birthday.loader.php';
$html_title = T('birthday');
importHeader(null); ?>
<link rel="image_src" href="pages/images/birthday_image.jpg"/>


<!-- html -->
<div class="container">
    <h1 style="text-align: center;color: <?php getTitleColor() ?>;">참신하게 생일을 축하해보세요.</h1>
    <br><br>
    <center><h3 stlye="font-size: 21px;">그 누구도 예상하지 못한 생일축하방법</h3>
        <br>
        <div class="squarecard">
            <br>
            <p>축하해줄 사람의 이름, 생일 그리고 할 말을 작성해주세요.</p>
            <hr>

            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="이름" id="name" aria-describedby="sizing-addon1">

            </div>
            <br>
            <select name="year" id="year">
                <?php for ($a = date("Y"); $a >= 1940; $a--) {

                    echo "<option value=\"$a\">$a</option>";
                } ?>


            </select>
            <select name="month" id="month">
                <?php for ($m = 1; $m <= 12; $m++) {
                    $selected = ($m == $BIRTHDAY_CLASS->getMonth()) ? "selected" : "";

                    echo "<option value=\"$m\" $selected >$m</option>";
                } ?>
            </select>
            <select name="day" id="day">
                <?php for ($d = 1; $d <= 31; $d++) {
                    $selected = ($d == $BIRTHDAY_CLASS->getDay()) ? "selected" : "";

                    echo "<option value=\"$d\" $selected >$d</option>";
                } ?>
            </select>
            <br><br>

            <textarea class="form-control" rows="3" placeholder="할 말" id="contents" style="width:70%"></textarea>
            <br><br><br><br>
            <button type="button" class="btn btn-dark btn-lg" onclick="writeAct()">
                생일 페이지 만들기
            </button>
            <br><br><br>
        </div>

    </center>
    <br><br><br>
</div> <!-- /container -->


<script>


    function writeAct() {
        setbuttonstatus(false);
        var birthday_name = document.getElementById("name").value;
        var birthday_year = document.getElementById("year").value;
        var birthday_month = document.getElementById("month").value;
        var birthday_day = document.getElementById("day").value;
        var content = document.getElementById("contents").value;


        if (birthday_name == '') {
            alert('이름을 입력해주세요.');
            setbuttonstatus(true);
            return false;
        }

        var data = JSON.stringify({
                "birthday_name": birthday_name,
                "birthday_year": birthday_year,
                "birthday_month": birthday_month,
                "birthday_day": birthday_day,
                "birthday_contents": ConvertForWrite(content)
            })
        ;


        $.ajax({
            type: "POST",
            url: "<?php echo getAPIUrlS() ?>",
            data: {
                "a": "square_write",
                "apiv": "<?php echo getAPIVersion()?>",
                "api_key": "<?php echo getAPIKey()?>",
                "auth": "<?php echo getUserAuth()?>",
                "title": birthday_name + "님의 생일",
                "type": "birthday",
                "data": data
            },
            success: function (data) {
                setbuttonstatus(true);

                if (data.indexOf('success') >= 0) {

                    var Result = JSON.parse(data);

                    location.href = Result['square_key'];


                } else {
                    alert('죄송합니다. 뭔가 문제가 있는거 같아요. 잠시 후에 다시 시도해주세요 ㅠㅠ 문의 : jeonghunn1@gmail.com');


                }
            },

            error: function (jqXHR) {
                setbuttonstatus(true);
                alert('죄송합니다. 뭔가 문제가 있는거 같아요. 잠시 후에 다시 시도해주세요 ㅠㅠ 문의 : jeonghunn1@gmail.com');
            }


        });
    }

    function ConvertForWrite(content) {
        return replaceAll(content, "\n", "{[br]}");
    }


    function replaceAll(str, searchStr, replaceStr) {
        return str.split(searchStr).join(replaceStr);
    }

    function setbuttonstatus(status) {

        if (status) {
            $('button').prop('disabled', false);
        } else {
            $('button').prop('disabled', true);
        }

    }


</script>

