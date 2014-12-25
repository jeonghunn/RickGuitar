<!DOCTYPE html>
<html ng-app>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Favorite</title>

    <!-- Bootstrap core CSS -->
       <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">

        <!-- Material Design for Bootstrap -->
    <link href="css/material-wfont.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">

        <!-- Dropdown.js -->
    <link href="//cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">


 <!-- Page style -->
    <style>
      * {
        box-sizing: border-box;
      }
      .header-panel {
        background-color: #fd9800;
        height: 144px;
        position: relative;
        z-index: 3;
      }
      .header-panel div {
        position: relative;
        height: 100%;
      }
      .header-panel h1 {
        color: #FFF;
        font-size: 20px;
        font-weight: 400;
        position: absolute;
        bottom: 10px;
        padding-left: 35px;
      }

      .menu {
        overflow: auto;
        padding: 0;
      }
      .menu, .menu * {
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      .menu ul {
        padding: 0;
        margin: 7px 0;
      }
      .menu ul li {
        list-style: none;
        padding: 20px 0 20px 50px;
        font-size: 15px;
        font-weight: normal;
        cursor: pointer;
      }
      .menu ul li.active {
        background-color: #FF8224;
        position: relative;
      }
      .menu ul li a {
        color: rgb(51, 51, 51);
        text-decoration: none;
      }

      .pages {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 4;
        padding: 0;
        overflow: auto;
      }
      .pages > div {
        padding: 0 5px;
        padding-top: 64px;
      }

      .pages .header {
        color: rgb(82, 101, 162);
        font-size: 24px;
        font-weight: normal;
        margin-top: 5px;
        margin-bottom: 60px;
        letter-spacing: 1.20000004768372px;
      }

      .page {
        transform: translateY(1080px);
        transition: transform 0 linear;
        display: none;
        opacity: 0;
        font-size: 16px;
      }

      .page.active {
        transform: translateY(0px);
        transition: all 0.3s ease-out;
        display: block;
        opacity: 1;
      }

      #opensource {
        color: rgba(0, 0, 0, 0.62);
        position: fixed;
        margin-top: 50px;
        margin-left: 50px;
        z-index: 100;
      }

      #source-modal h4 {
        color: black;
      }

      /* FIXME: why do I need these overrides? */
      .navbar input::-webkit-input-placeholder {
        color: rgba(255,255,255,.84) !important
      }
      .navbar input::-moz-placeholder {
        color: rgba(255,255,255,.84) !important
      }
      .navbar input:-ms-input-placeholder {
        color: rgba(255,255,255,.84) !important
      }

    </style>
        <!-- JS -->
             <script src="js/angular.min.js"></script>
      <script type="text/javascript" src="js/jquery.js"></script>

    <script src="js/class.js"></script>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body ng-app="favorite_application">

    <!-- Fixed navbar -->
    <div class="navbar navbar-material-orange navbar-fixed-top" role="navigation">
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
            <li><a href="#about">About</a></li>
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
             echo '<a href="?p='.A($user_srl).'">'.A($user_name).'</a>';
           }else{
             echo '<a href="index.php">'.T('sign_in').'</a>';
           }
             echo '</li>';
           ?>
    
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


 <div class="container">



      <div ng-bind-html="cfdump">
       <h2>{{cfdump}}</h2>
    </div>

