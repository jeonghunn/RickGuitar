
    <link href="pages/css/signin.css" rel="stylesheet">

    <div class="container">

      <form class="form-signin" role="form" method='post' action= '<?php echo getClientUrl(true)."?a=loginact'"; ?>>
        <h2 class="form-signin-heading"><?php S('sign_in'); ?></h2>
        <input type="text" name='id' class="form-control" placeholder="<?php S('id');?>" required autofocus>
        <input type="password" name='password'  class="form-control" placeholder="<?php S('password');?>" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> <?php S('remember_me');?>
        </label>
        <button class="btn btn-lg btn btn-block btn-success" type="submit"><?php S('sign_in');?></button>
      </form>

      <br><br>
      <center><p>Under Construction</p></center>

    </div> <!-- /container -->