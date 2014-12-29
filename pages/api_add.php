
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
<form class="formbox" method="post" id="APIform" name="APIform" action="">
<input type="text" class="form-control" placeholder="<? S('API_api_name')?>"><br>
<textarea class="form-control" rows="5" style="resize: none;" placeholder="<? S('API_description')?>"></textarea>
  </form>

  <div style="margin-top: 4%; ">
 <button type="submit" class="btn btn-success btn-lg"><? S('API_submit')?></button><br>
</div>
    </div> <!-- /container -->



    <!-- JavaScript -->

