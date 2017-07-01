<link rel="image_src" href="pages/images/birthday_image.jpg"/>


<!-- html -->
    <div class="container">

        <h1 style="font-size: 63px;text-align: center;color: <?php getTitleColor() ?>;">네모안에 생각을 담아보세요.</h1>
<br><br>
        <center><h3 stlye="font-size: 21px;">글 작성하기</h3>
<br>
            <div class="squarecard" id="squarecard">

              <textarea class="form-control" rows="12" placeholder="내용" id="contents" style="width:70%"></textarea>
              <br>
          </div>
            <br><br>
            <button type="button" class="btn btn-default btn-lg" onclick="addCard()">
                카드 추가하기
            </button>
            <button type="button" class="btn btn-default btn-lg" onclick="writeAct()">
                작성 완료
            </button>

</center><br><br><br>
    </div> <!-- /container -->


<script>


    function addCard() {
//        var newDiv = document.createElement("div");
//        var newContent = document.createElement("textarea");
//        newContent.className = "form-control";
//        newContent.rows = "12";
//        newContent.placeholder = "내용";
//        newContent.id = "contents";
//        newContent.style = "width:70%";
//        newDiv.className = "squarecard";
//
//        newDiv.appendChild(newContent); //add the text node to the newly created div.
//
//        // add the newly created element and its content int

        var currentDiv = document.getElementById("firstcard");
        $(' <div class="squarecard"> <textarea class="form-control" rows="12" placeholder="내용" id="contents" style="width:70%"></textarea> <br> </div><br>').insertBefore('#squarecard');


    }


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
            "birthday_contents": content
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



    function setbuttonstatus(status) {

        if (status) {
            $('button').prop('disabled', false);
        } else {
            $('button').prop('disabled', true);
        }

    }


</script>

