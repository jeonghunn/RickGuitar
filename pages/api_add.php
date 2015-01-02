
<!-- GET REQUEST -->
<?php

$api_name = POST('api_name');
$api_description = POST('api_description');

if($api_name != null && $api_description != null){
   // alert_error_print(T('error'), T('API_blank_error'));
}

?>



<!-- Set Style -->
<style type="text/css">
  .formbox{
  	margin-top: 5%;  width: 100%
  }

  @media (min-width: 768px) {
.formbox{
	width: 70%
}
  }

</style>

<!-- html -->
    <div class="container">

    <h1 style="color: #fd9800;"><? S('API_add_api')?></h1>
<br>
     <h3 stlye="font-size: 21px;"><? S('API_add_api_des')?></h3>
<form class="formbox" method="post" id="APIform" name="APIform" action="api_add">
<input type="text" class="form-control" name="api_name" placeholder="<? S('API_api_name')?> required"><br>
<textarea class="form-control" rows="5" name="api_description" style="resize: none;" placeholder="<? S('API_description')?> required"></textarea>

  <div style="margin-top: 4%; ">
 <button type="submit" class="btn btn-success btn-lg"><? S('API_submit')?></button><br>
</div>


  </form>


    </div> <!-- /container -->



    <!-- JavaScript -->

