
</paper-toolbar>


<style>

    #container
    {
        overflow:hidden;

    }

    #fancy_h1_wrap
    {

        width:100%;
        height:100%;
        top:100%;
    }

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

<style is="custom-style">
    .flex-horizontal {
        @apply(--layout-horizontal);
    }
    .flexchild {
        @apply(--layout-flex);
    }
</style>



<!-- html -->

<div id="fancy_h1_wrap">
  <center>
<!--      <h1 style="font-size: 36px; center;">HaruCore</h1>-->
<br><br>
      <h3 style="font-size: 21px;" ><?php echo PostAct(getAPIUrl(),  array(array('api_key', getAPIKey()), array('a', 'CoreVersion'))); ?></h3><br><br><h3 stlye="font-size: 18px;">Developed By Junghoon Lee</h3>
<br>

      <p></p>
</center>
</div>

<script src="static/endcredits.js"></script>