<?php




importHeader(null);

?>


<!-- html -->
    <div class="container" style="text-align: center;">


    <!--    <div class="squarecardw" onclick="location.href='write'; " contenteditable="true">새로운 카드 만들기</div>-->

    <button type="button" class="btn btn-dark btn-lg"
            style=" border-radius: 50%; width: 64px; height: 64px; text-align: center; font-size:24px"
            onclick="openUpdateModal(1)">+
    </button>
    <br><br><br>


        <div class="card-columns">

<div id="cardend"></div>

        </div>


        <!-- Update Modal -->
        <div class="modal fade" id="UpdateModal" tabindex="100" role="dialog" aria-labelledby="UpdateModal"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">상품 정보 입력</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input id="model" class="form-control form-control-lg" type="text" placeholder="모델명">
                        <input id="builder" class="form-control form-control-lg" type="text" placeholder="제조사">
                        <input id="price" class="form-control" type="text" placeholder="Price">
                        <input id="serialNumber" class="form-control" type="text" placeholder="Serial Number">
                        <select id="type"  class="form-control">
                            <option>종류</option>
                            <option>ACOUSTIC</option>
                            <option>ELECTRIC</option>
                        </select>
                        <select id="numStrings"  class="form-control">
                            <option>줄 갯수</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option><option>6</option>
                            <option>7</option>
                            <option>8</option>


                        </select>
                        <select id="backWood"  class="form-control">
                            <option>BackWood</option>
                            <option>Mahogany</option>
                            <option>Maple</option>
                            <option>Cocobolo</option>
                            <option>Cedar</option>
                            <option>Adirondack</option>
                            <option>Alder</option>
                            <option>Sitka</option>


                        </select>
                        <select id="topWood"  class="form-control">
                            <option>TopWood</option>
                            <option>Mahogany</option>
                            <option>Maple</option>
                            <option>Cocobolo</option>
                            <option>Cedar</option>
                            <option>Adirondack</option>
                            <option>Alder</option>
                            <option>Sitka</option>
                        </select>

                        </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                tabindex="-1"><?php S('close') ?></button>
                        <button type="button" class="btn btn-primary"
                                onclick="updateItemAct()">Submit</button>
                    </div>
                </div>
            </div>
        </div>


        <script><?php require_once "pages/modules/rick/controller/rick.js.php";
?>

            search();
        </script>