<div id="footer" style="margin-top: 80px;">

    <a class="container">
        <br>

        <a href="info"><p class="text-muted" style="text-align: center;">Copyrightⓒ. 2017-2018. Tarks. All Rights
                Reserved.</p></a>

</div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="pages/js/bootstrap.min.js"></script>
<script>
    var pageContent = document.getElementById("content"),
        pagecopy = pageContent.cloneNode(true),
        blurryContent = document.getElementById("blurryscroll");
    blurryContent.appendChild(pagecopy);
    window.onscroll = function () {
        blurryContent.scrollTop = window.pageYOffset;
    }

</script>
</body>
</html>


