


<?php  if($error_code == 404)   header('HTTP/1.0 404 Not Found'); ?>
<!-- html -->
    <div class="container">

    <h1 style="font-size: 63px;text-align: center;color: #fd9800;"><?php S('error_'.$error_code.'_error')?></h1>
<br><br>
      <center><h3 stlye="font-size: 21px;"><? S('error_'.$error_code.'_error_des')?></h3>
<div style="margin-top: 5%; margin-left: 30%; margin-right:30%;">
<img src="pages/images/<?php echo $error_code; ?>_error.png" width="70%"></img>
  </div>
</center>
    </div> <!-- /container -->


<?php  die(); ?>