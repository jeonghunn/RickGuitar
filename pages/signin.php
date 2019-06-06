<?php
importHeader(null);
?>


<style>


    /*데스크탑*/
    @media screen and (min-width: 1367px){

        #cardpaper {
            width: 70%;
        }

    }

    /*랩탑*/
    @media screen and (min-width: 1025px) and (max-width: 1366px){

        #cardpaper {
            width: 70%;
        }


    }

    /*아이패드 가로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape){

    }

    /*아이패드 세로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: portrait){

    }

    /*모바일*/
    @media screen and (min-width: 351px) and (max-width: 767px){

    }

    /*작은 모바일*/
    @media screen and (max-width: 350px){

    }
</style>

<form class="form-signin" id="signinform" name="signinform"
      action='<?php echo getClientUrl(true) . "index.php?a=signinact'"; ?>' method="post">
    <h1 class="h3 mb-3 font-weight-normal"><?php S('sign_in'); ?></h1>
    <label for="inputEmail" class="sr-only"><?php S('email'); ?></label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only"><?php S('password'); ?></label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> <?php S('keep_signed_in'); ?>
        </label>
        <label style="float:right;">
           <a href="signup"><?php S('sign_up'); ?></a>
        </label>
    </div>
    <button class="btn btn-lg btn-dark btn-block" type="submit"
    ><?php S('sign_in'); ?></button>
</form>


<script>

    $("#signinform").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            document.getElementById('signinform').submit();
        }
    });

    //    signinform.addEventListener('iron-form-response', function(event) {
//        alert(event.detail.text);
//    });


</script>