<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="description" content="">

    <meta name="author" content="">
      <!-- See https://goo.gl/qRE0vM -->
      <meta name="theme-color" content="<?php getTitleColor() ?>">


    <link rel="shortcut icon" href="icon.png">

    <title><?php S('app_name')?></title>



      <!-- will be replaced with elements/elements.vulcanized.html -->


<!---->
<!--      <link rel="import" href="pages/bower_components/polymer/polymer.html">-->
<!--      <link rel="import" href="pages/bower_components/app-layout/app-drawer/app-drawer.html">-->
<!--      <link rel="import" href="pages/bower_components/app-layout/app-drawer-layout/app-drawer-layout.html">-->
<!--      <link rel="import" href="pages/bower_components/app-layout/app-header/app-header.html">-->
<!--      <link rel="import" href="pages/bower_components/app-layout/app-header-layout/app-header-layout.html">-->
<!--      <link rel="import" href="pages/bower_components/app-layout/app-scroll-effects/app-scroll-effects.html">-->
<!--      <link rel="import" href="pages/bower_components/app-layout/app-toolbar/app-toolbar.html">-->
<!--      <link rel="import" href="pages/bower_components/app-route/app-location.html">-->
<!--      <link rel="import" href="pages/bower_components/app-route/app-route.html">-->
<!--      <link rel="import" href="pages/bower_components/iron-pages/iron-pages.html">-->
<!--      <link rel="import" href="pages/bower_components/iron-icons/iron-icons.html">-->
<!--      <link rel="import" href="pages/bower_components/iron-selector/iron-selector.html">-->
<!--      <link rel="import" href="pages/bower_components/paper-icon-button/paper-icon-button.html">-->
<!--      <link rel="import" href="pages/bower_components/paper-card/paper-card.html">-->
<!--      <link rel="import" href="pages/bower_components/paper-toolbar/paper-toolbar.html">-->


      <script>


          // Load pre-caching Service Worker
    /*      if ('serviceWorker' in navigator) {
              window.addEventListener('load', function() {
                  navigator.serviceWorker.register('/service-worker.js');
              });
          }*/
      </script>
    <!-- Bootstrap core CSS -->
    <link href="pages/css/bootstrap.css" rel="stylesheet">

<!--     Custom styles for this template -->
    <link href="pages/css/navbar-fixed-top.css" rel="stylesheet">

<!--         JS -->
<!--             <script src="pages/js/angular.min.js"></script>-->
      <script type="text/javascript" src="pages/js/jquery.js"></script>

<!--    <script src="pages/js/class.js"></script>-->

      <link rel="import" href="pages/elements/elements.html">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <![endif]-->

      <style>


         body {
              --app-primary-color: #00BCD4;
              --app-secondary-color: black;

              display: block;
          }

          app-header {
              color: #fff;
              background-color: var(--app-primary-color);
          }
          app-header paper-icon-button {
              --paper-icon-button-ink-color: white;
          }
         .card {
             /* Add shadows to create the "card" effect */
             box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
             transition: 0.3s;
             border-radius: 8px; /* 5px rounded corners */
         }

         /* On mouse-over, add a deeper shadow */
         .card:hover {
             box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
         }


      </style>

      <style>
          body {
              margin: 0;
              font-family: 'Roboto', 'Noto', sans-serif;
              line-height: 1.5;
              min-height: 100vh;
              background-color: #eeeeee;
          }
      </style>



  </head>

  <body >





  <?php if(REQUEST('nav') != 'false') require_once 'pages/navbar.php'; ?>



