


<!-- html -->
    <div class="container">

        <h1 style="font-size: 63px;text-align: center;color: <?php getTitleColor() ?>;">네모 안에 생각을 담아보세요.</h1>
<br><br>
        <center><h3 stlye="font-size: 21px;">지금 써보기</h3>
<br>
            <div class="outer">
                <div class="tablerow">
                    <div class="squarecard">

                        <textarea class="form-control" rows="12" placeholder="내용" id="contents" style="width:70%"></textarea>
                        <br>
                    </div>
                </div>
            </div>
            <br><br>
            <div id="squarecard"></div>
            <button type="button" class="btn btn-default btn-lg" onclick="addCard()">
                카드 추가하기
            </button>
            <button type="button" class="btn btn-default btn-lg" onclick="writeAct()">
                작성 완료
            </button>

</center><br><br><br>
    </div> <!-- /container -->


<script>

    var cardcount = 1;


    function addCard() {

        cardcount = cardcount + 1;
        $('        <div class="outer"> <div class="tablerow"><div class="squarecard"> <textarea class="form-control" rows="12" placeholder="내용" id="contents" style="width:70%"></textarea> <br> </div></div></div><br>').insertBefore('#squarecard');


    }


    function writeAct() {
        setbuttonstatus(false);



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

