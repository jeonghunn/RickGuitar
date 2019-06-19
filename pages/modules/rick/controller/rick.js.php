

var mode = 0;
var cardindex = 0;
var cardArray = [];
function addCard(serialNumber, price, builder, model, type, numStrings, backWood, topWood) {


    var cardadd = '<div class="card" style="width: 18rem;"><div class="card-body"><h5 class="card-title">' + model + '</h5> <p class="card-text">' + price + ' KRW</p> </div> <ul class="list-group list-group-flush"> <li class="list-group-item"><b>제품번호 </b>' + serialNumber + '</li> <li class="list-group-item"><b>제조사 </b>' + builder + '</li> <li class="list-group-item"><b>종류 </b>'  + type + '</li> <li class="list-group-item"><b>줄 갯수 </b>' + numStrings + '</li> <li class="list-group-item"><b>BackWood </b>' + backWood +'</li> <li class="list-group-item"><b>TopWood </b>' + topWood + '</li> </ul> <div class="card-body"> <button class="btn btn-link" onclick="deleteItem(\'' + serialNumber +'\');" class="card-link">삭제</button> <button class="btn btn-link" onclick="modify(\'' + cardindex +'\')">수정하기</button> </div></div>';

    $(cardadd).insertBefore('#cardend');

    cardindex = cardindex + 1;



}

function search(){
    $.ajax({
        type: "POST",
        url: "<?php echo getAPIUrlS() ?>",
        data: {
            "a": "guitar_search",
            "apiv": "<?php echo getAPIVersion()?>",
            "api_key": "<?php echo getAPIKey()?>",
            "auth": "<?php echo getUserAuth()?>"
        },
        success: function (data) {

            if (data.indexOf('[{') >= 0) {


                var Result = JSON.parse(data);
                cardArray = Result;
                $.each(Result,function(index, k){

                    addCard(k['serialNumber'], k['price'], k['builder'], k['model'], k['type'], k['numStrings'], k['backWood'], k['topWood']);
                });


            } else {
                alert('<?php S('error_unknown_error') ?>'
                )
                ;


            }
        },

        error: function (jqXHR) {
            setProcessing(false);
            alert('<?php S('error_unknown_error') ?>'
            )
            ;
        }


    });
}

function openUpdateModal(d) {
mode = d;



    $('#UpdateModal').modal('show');
}

function modify(index){

    document.getElementById("serialNumber").value = cardArray[index]['serialNumber'];
    document.getElementById("price").value = cardArray[index]['price'];
    document.getElementById("builder").value = cardArray[index]['builder'];
    document.getElementById("model").value = cardArray[index]['model'];
   var x =  document.getElementById("type");
    for(var i=0;i<x.length;i++) {
        if (x[i].text == cardArray[index]['type']) {
            x[i].selected = true;
            break;
        }
    }
 var  x =  document.getElementById("numStrings");

        for(var i=0;i<x.length;i++) {
            if (x[i].text == cardArray[index]['numStrings']) {
                x[i].selected = true;
                break;
            }
        }
 var  x=  document.getElementById("backWood");
            for(var i=0;i<x.length;i++) {
                if (x[i].text == cardArray[index]['backWood']) {
                    x[i].selected = true;
                    break;
                }
            }
   var x= document.getElementById("topWood");

                for(var i=0;i<x.length;i++) {
                    if (x[i].text == cardArray[index]['topWood']) {
                        x[i].selected = true;
                        break;
                    }
                }

    openUpdateModal(2);
}


function deleteItem(serialNumber){



    document.getElementById("serialNumber").value = serialNumber;
    mode = 3;
    updateItemAct();
}

function  updateItemAct(){
    var serialNumber = document.getElementById("serialNumber").value;
    var price = document.getElementById("price").value;
    var builder = document.getElementById("builder").value;
    var model = document.getElementById("model").value;
    var type = document.getElementById("type").value;
    var numStrings = document.getElementById("numStrings").value;
    var backWood = document.getElementById("backWood").value;
    var topWood = document.getElementById("topWood").value;

var action = "CoreVersion";
   if(mode == 1)  action = "guitar_add";
    if(mode == 2)  action = "guitar_update";
    if(mode == 3)  action = "guitar_delete";
    if(mode == 4)  action = "guitar_search";

    $.ajax({
        type: "POST",
        url: "<?php echo getAPIUrlS() ?>",
        data: {
            "a": action,
            "apiv": "<?php echo getAPIVersion()?>",
            "api_key": "<?php echo getAPIKey()?>",
            "auth": "<?php echo getUserAuth()?>",
            "serialNumber": serialNumber,
            "price": price,
            "builder": builder,
            "model": model,
            "type": type,
            "numStrings": numStrings,
            "backWood": backWood,
            "topWood": topWood


        },
        success: function (data) {


            if(mode ==4 ) {
                if (data.indexOf('[{') >= 0) {
                    $('.card').remove();

                    var Result = JSON.parse(data);
                    cardArray = Result;
                    $.each(Result,function(index, k){

                        addCard(k['serialNumber'], k['price'], k['builder'], k['model'], k['type'], k['numStrings'], k['backWood'], k['topWood']);
                    });


                } else {
                    alert('쏘리 에렌 당신을 위한 검색 결과는 없어요.'
                    )
                    ;


                }

            }else{
                if (data.indexOf('success') >= 0) {


                    location.href="index.php";

                } else


                    alert(data);
                alert('<?php S('error_unknown_error') ?> :' + JSON.parse(data)['message']);



            }



        },

        error: function (jqXHR) {

            alert('<?php S('error_unknown_error') ?>');
        }


    });
}

