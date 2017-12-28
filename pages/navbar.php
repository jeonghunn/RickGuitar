<div id="blurryscroll" aria-hidden="true"></div>
<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <b><a class="navbar-brand" href="home"><?php S('app_full_name') ?></a></b>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="home"><?php S('home') ?></a></li>
                <li><a href="birthday"><?php S('birthday') ?></a></li>
                <?php if (isDevelopmentServer()) echo "<li><a href=\"info\">Development Server</a></li>" ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
