


<script>
   alert("Hdddi");
$(window).scroll(function(){ 
        if  ($(window).scrollTop() == $(document).height() - $(window).height()){ 
           lastPostFunc(); 
        } 
});

function lastPostFunc() 
{ 
   // $('div#lastPostsLoader').html('<img src="bigLoader.gif">'); 
   $('div#lastPostsLoader').html('<p>Loading...</p>'); 
    $.post("scroll.asp?action=getLastPosts&lastID=" + $(".wrdLatest:last").attr("id"),    


    function(data){ 
        if (data != "") { 
        $(".wrdLatest:last").after(data);            
        } 
        $('div#lastPostsLoader').empty(); 
    }); 
}; 
</script>

   
    <div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">


        <div class="jumbotron" style="background-image: url(files/profile/<? P($page_srl) ?>.jpg); background-size: 100%; background-position:center center;">
        <h2 style="text-shadow: 2px 2px 4px #000; color: rgb(237, 237, 237);"><? P($page_name) ?></h2>
        <!--    <p style="text-shadow: 2px 2px 4px #000; color: rgb(237, 237, 237);" class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p> -->
      <!--   <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
      </div>


<hr>


<ul class="media-list">
      

<li class="media">
<?php 
$DocList = document_getList($user_srl, $page_srl, 0, 30);

 $total= mysql_num_rows ( $DocList );
  for($i=0 ; $i < $total; $i++){
               mysql_data_seek($DocList, $i);           //포인터 이동
             $result=mysql_fetch_array($DocList);        //레코드를 배열로 저장
     echo '<a class="pull-left" href="?p='.$result['user_srl'].'">';
     echo '<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="files/profile/thumbnail/'.$result['user_srl'].'.jpg" style="width: 64px; height: 64px;"></a>';
     echo '<div class="media-body">';
      echo '<h4 class="media-heading">'.$result['name'].'</h4>';
      echo '<p>'.$result['content'].'</p></div><hr>';
}         

?>

</li>
      </ul>


  </div>
  <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
</div>


