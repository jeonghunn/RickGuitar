<div id="footer" style="margin-top: 80px;">

    <a class="container">
        <br>

        <a href="info"><p class="text-muted" style="text-align: center;">Copyrightⓒ. 2017. Tarks. All Rights
                Reserved.</p></a>

</div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="pages/js/bootstrap.min.js"></script>
<script src="pages/js/html2canvas.min.js"></script>
<script>
    $(function () {
        html2canvas($("body"), {
            onrendered: function (canvas) {
                $(".blurheader").append(canvas);
                $("canvas").attr("id", "canvas");
                stackBlurCanvasRGB(
                    'canvas',
                    0,
                    0,
                    $("canvas").width(),
                    $("canvas").height(),
                    20);
            }
        });
        vv = setTimeout(function () {
            $("header").show();
            clearTimeout(vv);
        }, 200);
    });

    $(window).scroll(function () {
        $("canvas").css(
            "-webkit-transform",
            "translatey(-" + $(window).scrollTop() + "px)");
    });

    window.onresize = function () {
        $("canvas").width($(window).width());
    };

    $(document).bind('touchmove', function () {
        $("canvas").css(
            "-webkit-transform",
            "translatey(-" + $(window).scrollTop() + "px)");
    });

    $(document).bind('touchend', function () {
        $("canvas").css(
            "-webkit-transform",
            "translatey(-" + $(window).scrollTop() + "px)");
    });
</script>

</body>
</html>


