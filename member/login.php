
    <link href="css/signin.css" rel="stylesheet">

    <div class="container">

      <form class="form-signin" role="form" method='post' action='?a=loginact'>
        <h2 class="form-signin-heading"><? S('sign_in'); ?></h2>
        <input type="text" name='id' class="form-control" placeholder="<? S('id');?>" required autofocus>
        <input type="password" name='password'  class="form-control" placeholder="<? S('password');?>" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> <? S('remember_me');?>
        </label>
        <button class="btn btn-lg btn btn-block" type="submit"><? S('sign_in');?></button>
      </form>

      <br><br>
      <center><p>Under Construction</p></center>

    </div> <!-- /container -->