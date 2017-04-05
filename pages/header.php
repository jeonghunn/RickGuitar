<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">


    <meta name="description" content="">

    <meta name="author" content="">
      <!-- See https://goo.gl/qRE0vM -->
      <meta name="theme-color" content="#009688">


    <link rel="shortcut icon" href="icon.png">

    <title>Square</title>

      <!-- will be replaced with elements/elements.vulcanized.html -->
      <link rel="import" href="pages/elements/elements.html">

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
          // Setup Polymer options
          window.Polymer = {
              dom: 'shadow',
              lazyRegister: true,
          };

          // Load webcomponentsjs polyfill if browser does not support native
          // Web Components
          (function() {
              'use strict';

              var onload = function() {
                  // For native Imports, manually fire WebComponentsReady so user code
                  // can use the same code path for native and polyfill'd imports.
                  if (!window.HTMLImports) {
                      document.dispatchEvent(
                          new CustomEvent('WebComponentsReady', {bubbles: true})
                      );
                  }
              };

              var webComponentsSupported = (
                  'registerElement' in document
                  && 'import' in document.createElement('link')
                  && 'content' in document.createElement('template')
              );

              if (!webComponentsSupported) {
                  var script = document.createElement('script');
                  script.async = true;
                  script.src = 'http://tarks.net/rect/pages/bower_components/webcomponentsjs/webcomponents-lite.min.js';
                  script.onload = onload;
                  document.head.appendChild(script);
              } else {
                  onload();
              }
          })();

          // Load pre-caching Service Worker
    /*      if ('serviceWorker' in navigator) {
              window.addEventListener('load', function() {
                  navigator.serviceWorker.register('/service-worker.js');
              });
          }*/
      </script>
    <!-- Bootstrap core CSS -->
<!--    <link href="pages/css/bootstrap.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
<!--    <link href="pages/css/navbar-fixed-top.css" rel="stylesheet">-->

        <!-- JS -->
<!--             <script src="pages/js/angular.min.js"></script>-->
      <script type="text/javascript" src="pages/js/jquery.js"></script>

<!--    <script src="pages/js/class.js"></script>-->



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <![endif]-->

      <style>
         body {
              --app-primary-color: #009688;
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

          .drawer-list {
              margin: 0 20px;
          }

          .drawer-list a {
              display: block;
              padding: 0 16px;
              text-decoration: none;
              color: var(--app-secondary-color);
              line-height: 40px;
          }

          .drawer-list a.iron-selected {
              color: black;
              font-weight: bold;
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

  <body>





  <?php if(REQUEST('nav') != 'false') require_once 'pages/navbar.php'; ?>

 <div class="container">


