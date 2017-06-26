


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





<!-- html -->

<div style="text-align: center;">

<!--      <h1 style="font-size: 36px; center;">HaruCore</h1>-->
<br><br>
      <h3 style="font-size: 21px;" ><?php echo PostAct(getAPIUrl(),  array(array('api_key', getAPIKey()), array('a', 'CoreVersion'))); ?></h3><br><br><h3 stlye="font-size: 18px;">Developed By Junghoon Lee</h3><br><paper-button raised onclick="location.href='mailto:jeonghunn1@gmail.com'">jeonghunn1@gmail.com</paper-button><br><br>
    <b><?php S('contributors'); ?></b><br>Choi Jin Young, CraftingMod

    <br><br>

          <p>2017.6.18 개발 시작</p>
    <p>2017.6.23 Alpha Ver, Birthday</p>


</div>