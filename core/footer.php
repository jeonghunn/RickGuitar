</div>

    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

   <div id="footer">
      <div class="container">
        <p class="text-muted">Copyrightⓒ. 2014. Tarks. All Rights Reserved.</p>
      </div>
    </div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> -->
 <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

      <!-- Material Design for Bootstrap -->
    <script src="js/material.min.js"></script>
    <script src="js/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>


    <!-- Sliders -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/noUiSlider/6.2.0/jquery.nouislider.min.js"></script>
    <script>
      $(function() {
        $.material.init();
        $(".shor").noUiSlider({
          start: 40,
          connect: "lower",
          range: {
            min: 0,
            max: 100
          }
        });

        $(".svert").noUiSlider({
          orientation: "vertical",
          start: 40,
          connect: "lower",
          range: {
            min: 0,
            max: 100
          }
        });
      });
    </script>

    <!-- Dropdown.js -->
    <script src="https://cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.js"></script>
    <script>
      $("#dropdown-menu select").dropdown();
    </script>


  </body>
</html>


