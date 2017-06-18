
<!--Toolbar-->
<!--Signed in-->
<?php if(CheckLogin()) {


    //GET REQUEST INFO

    $haru_year = REQUEST('year');
    $haru_month = REQUEST('month');
    $haru_day = REQUEST('day');

    //Today Mode
    $haru_istoday = 0;

    //NowTime
    $haru_now_hour = date('H');

    //If Request are null
    if($haru_year == null || $haru_month == null || $haru_day == null) {
        $haru_year = date("Y");
        $haru_month = intval(date("m"));
        $haru_day = intval(date("d"));
        $haru_istoday = true;
    }

    //Selcted day
    $haru_selected_day = $haru_year."/".$haru_month."/".$haru_day;
    $haru_selected_dayFormat = $haru_year."/".str_pad($haru_month, 2, 0, STR_PAD_LEFT)."/".str_pad($haru_day, 2, 0, STR_PAD_LEFT);

    //Before After Day
    $beforeDay = date("Y/m/d", strtotime($haru_selected_dayFormat." -1 day"));
    $afterDay = date("Y/m/d", strtotime($haru_selected_dayFormat." +1 day"));


    //Day Array
    $beforeDayA = explode('/', $beforeDay);
    $afterDayA = explode('/', $afterDay);

    //Day Link
$beforeDayLink = "?year=".$beforeDayA[0]."&month=".intval($beforeDayA[1])."&day=".intval($beforeDayA[2]);
    $afterDayLink = "?year=".$afterDayA[0]."&month=".intval($afterDayA[1])."&day=".intval($afterDayA[2]);

    //Get Rank
    $haru_grade_result = json_decode(PostAct(getAPISUrl(), array(array('a', 'haru_getgrade'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', getUserAuth()))), true);
    $haru_grade = $haru_grade_result['grade'];
    $haru_grade_top = $haru_grade_result['grade_top'];
    $haru_point = round($haru_grade_result['point']/10);
    $haru_grade_last_update = $haru_grade_result['last_update'];

    //quarter
    $curMonth = date("m", time());
    $curQuarter = ceil($curMonth/3);

    ?>
<paper-icon-button icon="chevron-left" onclick="location.href='<?php echo  $beforeDayLink?>'" ></paper-icon-button>
<paper-button onclick="location.href='home'"><?php echo $haru_selected_day ?></paper-button>
<paper-icon-button icon="chevron-right" onclick="location.href='<?php echo  $afterDayLink ?>'"></paper-icon-button>
<?php } ?>

</paper-toolbar>


<style>

    .grade_1 {
        color: white;
        text-shadow: 6px 6px 20px #BF7F00, -3px -3px 20px #FDD835;
        font-size: 48px;
        font-weight:bold;

    }

    .grade_2 {
        color: white;
        text-shadow: 6px 6px 20px #616161, -3px -3px 20px #E0E0E0;
        font-size: 48px;
        font-weight:bold;

    }

    .grade_3 {
        color: white;
        text-shadow: 6px 6px 20px #5D4037, -3px -3px 20px #D7CCC8;
        font-size: 48px;
        font-weight:bold;

    }

    .grade_4 {
        color: white;
        text-shadow: 6px 6px 20px #000000, -3px -3px 20px #212121;
        font-size: 48px;
        font-weight:bold;

    }


    .rank_1 {
        color: white;
        text-shadow: 6px 6px 20px #00C6ED, -3px -3px 20px #9DCFFF;
        font-size: 64px;
        font-weight:bold;
        background: linear-gradient(330deg, #00C6ED 0%, #9DCFFF 25%, #52e0e0 50%, #00C6ED 75%, #9DCFFF 100%);
        08
        -webkit-background-clip: text;
        09
        -webkit-text-fill-color: transparent;


    }

    .rank_2 {
        color: white;
        text-shadow: 6px 6px 20px #00C6ED, -3px -3px 20px #9DCFFF;
        font-size: 64px;
        font-weight:bold;

    }

    .rank_3 {
        color: white;
        text-shadow: 6px 6px 20px #BF7F00, -3px -3px 20px #FDD835;
        font-size: 64px;
        font-weight:bold;

    }

    .rank_4 {
        color: white;
        text-shadow: 6px 6px 20px #616161, -3px -3px 20px #E0E0E0;
        font-size: 64px;
        font-weight:bold;

    }

    .rank_5 {
        color: white;
        text-shadow: 6px 6px 20px #5D4037, -3px -3px 20px #D7CCC8;
        font-size: 64px;
        font-weight:bold;

    }

    .rank_ {
        color: white;
        text-shadow: 6px 6px 20px #000000, -3px -3px 20px #212121;
        font-size: 64px;
        font-weight:bold;

    }

    .timetitle {
        font-size: 20px;
        font-weight: bold;
    }

    /*데스크탑*/
    @media screen and (min-width: 1367px){

        #cardpaper {
            width: 60%;
        }

    }

    /*랩탑*/
    @media screen and (min-width: 1025px) and (max-width: 1366px){

        #cardpaper {
            width: 60%;
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



<!--Not Signed in-->
<?php if(!CheckLogin()) { ?>


<div class="layout vertical center" style ="margin-top: 3%;">

    <div id="cardpaper" class="layout vertical">
<paper-card heading="오늘 하루 어떠셨나요?" image="" alt="Emmental">
    <div class="card-content">
        오늘 하루를 기록하고 평가할 수 있습니다. 하루를 통해 오늘 하루를 돌아보세요.<br>HARU는 현재 Closed Alpha인 소프트웨어입니다.
    </div>
    <div class="card-actions">
        <paper-button onclick="location.href='<?php echo getClientUrl(true)?>signup'"><?php S('getting_started');?></paper-button>
        <paper-button onclick="location.href='<?php echo getClientUrl(true)?>login'"><?php S('sign_in');?></paper-button>
    </div>
</paper-card>

    </div>






</div>

<!--   Signed in -->
<?php }else{



    $haru_result = json_decode(PostAct(getAPISUrl(), array(array('a', 'haru_getbyday'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', getUserAuth()), array('year', $haru_year), array('month', $haru_month),  array('day', $haru_day) )), true);


    function SearchHour($array, $time)
    {
        $key = 100;
      //  $search = ['hour' => $time];
        foreach ($array as $k => $v) {
            if ($v['hour'] == $time) {
                $key = $k;
                // key found - break the loop
                break;
            }
        }

        return $key;
    }

    function getGradeValue($grade_point){

        if($grade_point<= 100 && $grade_point >= 75) return "A";
        if($grade_point<= 74 && $grade_point >= 50) return "B";
        if($grade_point<= 49 && $grade_point >= 25) return "C";
        if($grade_point<= 24 && $grade_point >= 1) return "F";


    }

    function getGradeNum($grade_point){

        if($grade_point<= 100 && $grade_point >= 75) return 1;
        if($grade_point<= 74 && $grade_point >= 50) return 2;
        if($grade_point<= 49 && $grade_point >= 25) return 3;
        if($grade_point<= 24 && $grade_point >= 1) return 4;


    }

    function getRankNum($grade){
        if($grade <= 1) return 1;
        if($grade<= 10 && $grade >= 2) return 2;
        if($grade<= 30 && $grade >= 11) return 3;
        if($grade<= 60 && $grade >= 31) return 4;
        if($grade<= 100 && $grade >= 61) return 5;

    }

    ?>

<paper-material elevation="1" id="cardpaper" style="margin-top: 3%; height: auto; text-align: center;">




    <?php if($haru_grade != null) {?>

        <div class="container flex-horizontal" >

        <div style="text-align: center; width:50%;">
            <?php S('haru_rank_top') ?><br>
    <span class="rank_<?php echo getRankNum($haru_grade) ?>" ><?php echo $haru_grade; ?>%</span>
        </div>

        <div style="text-align: center; width:50%;">
            <?php S($curQuarter.'_quarter_high') ?><br>
            <span class="rank_<?php echo getRankNum($haru_grade_top) ?>" ><?php echo $haru_grade_top; ?>%</span>
        </div>


    </div>



    <?php  }else { ?>

        <?php S('haru_rank_top') ?><br>
        <h3 ><?php S('haru_during_deployment')  ?></h3>
    <?php }?>
</paper-material>

<paper-material elevation="1" id="cardpaper" style="margin-top: 3%; height: auto;">




<!--  view more button  -->
    <div id="more_container" style="display: none; text-align:center;">
        <paper-button onclick="showOldTimes()"  raised><?php S('day_view_more')?></paper-button>
        <br><br>
    </div>


    <?php  for($timecount = 0 ; $timecount <=23 ; $timecount++){
        //If this is future
        if($haru_istoday && $haru_now_hour < $timecount) break;

        //Search hour in result

        $result_key = SearchHour($haru_result, $timecount);

        ?>

        <div id="container_time_<?php echo $timecount ?>">
    <div class="container flex-horizontal" >


<!--     Normal Mode   -->
        <div class="flexchild" id="normal_mode_time_<?php echo $timecount ?>">


            <div class="timetitle"><?php S('day_time_'.$timecount);?></div>

            <a id="contents_time_<?php echo $timecount ?>"><?php echo contentconvert($haru_result[$result_key]['contents']) ?></a><paper-icon-button icon="create" onclick="OpenEditMode(<?php echo $timecount ?>)"></paper-icon-button></div>

        <div id="normal_mode_grade_time_<?php echo $timecount ?>" class="grade_<?php echo getGradeNum($haru_result[$result_key]['grade']) ?>"><?php echo getGradeValue($haru_result[$result_key]['grade']) ?></div>



<!--Edit Mode-->
        <div class="flexchild" id="edit_mode_time_<?php echo $timecount ?>" style="display: none;">

            <div class="timetitle"><?php S('day_time_'.$timecount);?></div>



            <paper-input  label="<?php S('day_work');?>" id="contents_form_time_<?php echo $timecount ?>" value="<?php echo $haru_result[$result_key]['contents'] ?>" ></paper-input>
            <paper-dropdown-menu label="<?php S('day_grade');?>">
                <paper-listbox class="dropdown-content" id="grade_dropdown_time_<?php echo $timecount ?>"  selected="<?php echo getGradeNum($haru_result[$result_key]['grade']) -1 ?>">
                    <paper-item value="100"><?php S('day_grade_a');?></paper-item>
                    <paper-item value="50"><?php S('day_grade_b');?></paper-item>
                    <paper-item value="25"><?php S('day_grade_c');?></paper-item>
                    <paper-item value="1"><?php S('day_grade_f');?></paper-item>
                </paper-listbox>
            </paper-dropdown-menu>


            <paper-dropdown-menu label="<?php S('day_how_long');?>">
                <paper-listbox class="dropdown-content" id="howlong_dropdown_time_<?php echo $timecount ?>"  selected="0">

                    <?php  for($howlongcount = $timecount ; $howlongcount <=23 ; $howlongcount++){
                        if($haru_istoday && $howlongcount > $haru_now_hour) break;
                        ?>
                    <paper-item ><?php S('day_time_'.$timecount);?>~<?php S('day_time_'.$howlongcount);?></paper-item>
<?php  } ?>

                </paper-listbox>
            </paper-dropdown-menu>
            <paper-icon-button icon="check" onclick="CloseEditMode(<?php echo $timecount ?> )"></paper-icon-button></div>

    </div>
        <hr>
        </div>
        <?php } ?>




</paper-material>

<!--    Toast-->
    <paper-toast text="<?php S('error_des');?>" id="completetoastfailed"></paper-toast>
    <paper-toast text="<?php S('day_blank_error_des');?>" id="blankerrortoast"></paper-toast>
    <paper-toast text="<?php S('day_too_late_error_des');?>" id="too_late_error_toast"></paper-toast>

<?php } ?>

<script>

    //Init
    init();


    function init(){
        hideOldTimes();
    }

    function OpenEditMode(hour){
        document.getElementById("edit_mode_time_" + hour).style.display = "";
        document.getElementById("normal_mode_time_" + hour).style.display = "none";
        document.getElementById("normal_mode_grade_time_" + hour).style.display = "none";
    }

    function CloseEditMode(hour){

        var contents = document.getElementById("contents_form_time_" + hour).value;
        var gradeselected = document.getElementById("grade_dropdown_time_" + hour).selected;
        var howlongselected = document.getElementById("howlong_dropdown_time_" + hour).selected;
        var gradepoint = 0;
        var end_hour = 0;

        if(gradeselected == 0) gradepoint = 100;
        if(gradeselected == 1) gradepoint = 50;
        if(gradeselected == 2) gradepoint = 25;
        if(gradeselected == 3) gradepoint = 1;

        end_hour = Number(hour) + Number(howlongselected);



        //not selected
        if(gradeselected == 'undefined' || contents == '') {
            document.querySelector('#blankerrortoast').open();
            return false;
        }



            $.ajax({
            type: "POST",
            url: "<?php echo getAPIUrlS() ?>",
            data: {"a": "haru_update", "apiv": "<?php echo getAPIVersion()?>", "api_key": "<?php echo getAPIKey()?>", "auth": "<?php echo getUserAuth()?>",  "year": "<?php echo $haru_year?>", "month": "<?php echo $haru_month?>", "day": "<?php echo $haru_day?>", "hour": hour, "contents": contents, "grade":  gradepoint , "end_hour":  end_hour },
            success: function(data){
                if(data.includes("success"))
                {




                    for(a = hour; a <= end_hour; a++) {
                        document.getElementById("edit_mode_time_" + a).style.display = "none";
                        document.getElementById("normal_mode_time_" + a).style.display = "";
                        document.getElementById("normal_mode_grade_time_" + a).style.display = "";
                        document.getElementById("contents_time_" + a).innerText = document.getElementById("contents_form_time_" + hour).value;
                        document.getElementById("contents_form_time_" + a).value = document.getElementById("contents_form_time_" + hour).value;
                        document.getElementById("normal_mode_grade_time_" + a).innerText = getGradeValue(gradepoint);
                        document.getElementById("normal_mode_grade_time_" + a).className = "grade_" + getGradeNum(gradepoint);

                    }

                }else
                {


                    if(data.includes("too_late_error"))
                    {
                        document.querySelector('#too_late_error_toast').open();
                    }else{
                        document.querySelector('#completetoastfailed').open();
                    }



                }
            }
        });


    }

    function updateInfoGrade(){
        $.ajax({
            type: "POST",
            url: "<?php echo getAPIUrlS() ?>",
            data: {"a": "haru_getgraderefresh", "apiv": "<?php echo getAPIVersion()?>", "api_key": "<?php echo getAPIKey()?>", "auth": "<?php echo getUserAuth()?>"},
            success: function(data){
                if(data.includes("grade"))
                {

                    location.reload(true);




                }else
                {
                    document.querySelector('#completetoastfailed').open();


                }
            }
        });
    }

    function hideOldTimes(){
        //check today
        var today = <?php echo $haru_istoday ?>;
        var showoldtimeitems =  3;
        if( today == false) return;

        //view more button
        if(0 != <?php echo $haru_now_hour ?> && <?php echo $haru_now_hour ?> - showoldtimeitems > 0) {
            document.getElementById("more_container").style.display = "";
        }else{
            return;
        }

        for(a = 0; a <= 23; a++){
            if(a == <?php echo $haru_now_hour ?> - 3 || <?php echo $haru_now_hour ?> - showoldtimeitems < 0 ) break;
            document.getElementById("container_time_" + a).style.display = "none";
        }
    }

    function showOldTimes(){

        var showoldtimeitems =  3;
        //view more button
         document.getElementById("more_container").style.display = "none";

        for(a = 0; a <= 23; a++){
            if(a == <?php echo $haru_now_hour ?> - 3 || <?php echo $haru_now_hour ?> - showoldtimeitems < 0 ) break;
            document.getElementById("container_time_" + a).style.display = "";
        }
    }

    function getGradeValue(grade_point){

        if(grade_point<= 100 && grade_point >= 75) return "A";
        if(grade_point<= 74 && grade_point >= 50) return "B";
        if(grade_point<= 49 && grade_point >= 25) return "C";
        if(grade_point<= 24 && grade_point >= 1) return "F";

    }


    function getGradeNum(grade_point){

        if(grade_point<= 100 && grade_point >= 75) return 1;
        if(grade_point<= 74 && grade_point >= 50) return 2;
        if(grade_point<= 49 && grade_point >= 25) return 3;
        if(grade_point<= 24 && grade_point >= 1) return 4;


    }

</script>
