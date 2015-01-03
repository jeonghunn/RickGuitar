<!DOCTYPE html>
<html ng-app="FavoriteApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="icon.png">

    <title>Favorite</title>

    <!-- Bootstrap core CSS -->
    <link href="pages/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="pages/css/navbar-fixed-top.css" rel="stylesheet">

        <!-- JS -->
             <script src="pages/js/angular.min.js"></script>
      <script type="text/javascript" src="pages/js/jquery.js"></script>

    <script src="pages/js/class.js"></script>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body ng-controller="FavoriteCtr">

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Favorite</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"><? echo T('home')?></a></li>
            <li><a href="#about">{{titler}}</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
           <? echo '<li class="active" >';
           if($user_srl != null){
         //    echo '<a href="'.A($user_srl).'">'.A($user_name).'</a>';
           }else{
        //     echo '<a href="login">'.T('sign_in').'</a>';
           }
             echo '</li>';
           ?>
    
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


 <div class="container">


