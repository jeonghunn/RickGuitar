<?php

class BirthdayClass
{


    function getWriteResult($title, $content, $square_data, $square_cards)
    {

        $birthday_name = $square_data['birthday_name'];
        $birthday_year = $square_data['birthday_year'];
        $birthday_month = $square_data['birthday_month'];
        $birthday_day = $square_data['birthday_day'];
        $birthday_contents = $square_data['birthday_contents'];

        $wiki_result = $this->getWikipediaResult($birthday_month, $birthday_day);

        $square_data = array_merge($square_data, array("birthday_wiki" => EncodeJson($wiki_result)));


        return array($title, $content, $square_data, $square_cards);
    }

    function getReadResult($data, $cards)
    {

        $birthday_name = $data['birthday_name'];
        $birthday_year = $data['birthday_year'];
        $birthday_month = $data['birthday_month'];
        $birthday_day = $data['birthday_day'];
        $birthday_contents = $data['birthday_contents'];
        $birthday_wiki = $data['birthday_wiki'];
        $birthday_wiki_contents = '{[br]}{[h4]}' . $birthday_month . '월 ' . $birthday_day . '일에는 무슨 일들이 일어났을까요?{[/h4]}
                {[hr]}{[p style="font-size: 14px;"]}' . $this->getBirthdayWikiContents($birthday_wiki, $birthday_month, $birthday_day) . "{[/p]}";

        $result_array = array(
            array("content" => '{[p]}{[span style="font-size: 32px;"]}{[span
                                style="font-size: 40px;"]}' . $birthday_name . '{[/span]} 님은 {[br]}{[span
                                style="font-size: 40px;"]}' . $birthday_year . '{[/span]}년 {[span
                                style="font-size: 40px;"]}' . $birthday_month . '{[/span]}월 {[span
                                style="font-size: 40px;"]}' . $birthday_day . '{[/span]}일에{[br]} 태어났고,{[/span]}
                {[/p]}'),
            array("content" => ' {[span style="font-size: 32px;"]}{[p]}{[span style="font-size: 32px;"]}﻿지금까지{[/span]}{[/p]}
{[span style="font-size: 32px;"]}{[span style="font-size: 40px;"]}' . $this->getLifeDays($birthday_year, $birthday_month, $birthday_day) . '{[/span]}일{[/span]}{[br]}
지났습니다.{[/p]}

{[/span]}'),
            array("content" => '{[span style="font-size: 32px;"]}﻿이번 생일이 {[br]} {[span
                            style="font-size: 40px;"]}' . $this->getBirthdayNum($birthday_year) . '{[/span]}번째 {[br]}생일이며{[/span]}'),
            array("content" => ' {[span style="font-size: 32px;"]}﻿만으로 {[br]} {[span
                            style="font-size: 40px;"]}' . $this->getRealAge($birthday_year, $birthday_month, $birthday_day) . '{[/span]}살 {[br]}입니다.{[/span]}'),
            array("content" => '{[span style="font-size: 32px;"]}﻿인생을 시간으로 본다면{[br]} 지금 시간은{[br]} {[span
                        style="font-size: 40px;"]}' . $this->getLifeHour($birthday_year, $birthday_month, $birthday_day) . '{[/span]}시 {[span
                        style="font-size: 40px;"]}' . $this->getLifeMin($birthday_year, $birthday_month, $birthday_day) . '{[/span]}분이 됩니다.{[/span]}'),
            array("content" => '{[span style="font-size: 32px;"]}﻿지금까지 생일이 {[br]}{[span
                        style="font-size: 40px;"]}' . $this->getBirthdayLastHour($birthday_month, $birthday_day) . '{[/span]}시간 {[span
                        style="font-size: 40px;"]}' . $this->getBirthdayLastMin($birthday_month, $birthday_day) . '{[/span]}분 지났으며,{[/span]}'),


        );

        array_push($result_array, array("content" => '{[span style="font-size: 32px;"]}﻿생일이 끝나기까지 {[br]}{[span
                        style="font-size: 40px;"]}' . $this->getBirthdayLeftHour($birthday_month, $birthday_day) . '{[/span]}시간 {[span
                        style="font-size: 40px;"]}' . $this->getBirthdayLeftMin($birthday_month, $birthday_day) . '{[/span]}분 남았습니다.{[/span]}'));

        array_push($result_array,
            array("content" => '{[span style="font-size: 32px;"]}{[span
                        style="font-size: 40px;"]}' . $this->getNextYear() . '{[/span]}년 다음 생일은 {[br]}{[span
                        style="font-size: 40px;"]}' . $this->getNextRemainBirthday($birthday_month, $birthday_day) . '{[/span]}일 후가 됩니다.{[/span]}'),
            array("content" => $birthday_wiki_contents),
            array("content" => $birthday_contents));

        return $result_array;
    }

    function getBirthdayWikiContents($birthday_wiki, $birthday_month, $birthday_day)
    {

        $birthday_wiki_contents = "";

        if ($birthday_wiki != "") {

            $birthday_wiki_array = json_decode($birthday_wiki, true);

            for ($i = 0; $i < count($birthday_wiki_array); $i++) {

                $birthday_wiki_contents = $birthday_wiki_contents . $birthday_wiki_array[$i] . "{[br /]}";

            }


        } else {


            $wikicon = file_get_contents('http://ko.m.wikipedia.org/wiki/' . $birthday_month . '월_' . $birthday_day . '일');

            $DOM = new DOMDocument;
            $DOM->loadHTML(mb_convert_encoding($wikicon, 'HTML-ENTITIES', 'UTF-8'));

//get all H1
            $items = $DOM->getElementsByTagName('ul');


            $itr = $items->item(1);


            if ($itr->hasChildNodes()) {
                $childs = $itr->childNodes;
                foreach ($childs as $i) {
                    $birthday_wiki_contents = $birthday_wiki_contents . $i->nodeValue . "{[br /]}";
                }
            }
        }

        return $birthday_wiki_contents;
    }

    function getWikipediaResult($birthday_month, $birthday_day)
    {
        $wikicon = file_get_contents('http://ko.m.wikipedia.org/wiki/' . $birthday_month . '월_' . $birthday_day . '일');
        $DOM = new DOMDocument;
        $DOM->loadHTML(mb_convert_encoding($wikicon, 'HTML-ENTITIES', 'UTF-8'));
        //get all H1
        $items = $DOM->getElementsByTagName('ul');

//  echo "<ul>".$items->item(1)->nodeValue."</ul>";

        $itr = $items->item(1);
        $array = array();

        if ($wikicon == null) return false;
        if ($itr->hasChildNodes()) {
            $childs = $itr->childNodes;
            foreach ($childs as $i) {
                $array[] = $i->nodeValue;
            }

        }

        return $array;
    }


    function getYear()
    {
        return date("Y");
    }

    function getMonth()
    {
        return date("n");
    }

    function getDay()
    {
        return date("j");
    }

    function getBirthdayNum($birthday_year)
    {
        return $this->getYear() - $birthday_year + 1;
    }

    function getBTimeLast($birthday_month, $birthday_day)
    {
        return time() - mktime(0, 0, 0, $birthday_month, $birthday_day, $this->getYear()); // 정한 날과의 시간 차이
    }

    function getBirthdayLastHour($birthday_month, $birthday_day)
    {
        return floor($this->getBTimeLast($birthday_month, $birthday_day) / 3600);
    }

    function getBirthdayLastMin($birthday_month, $birthday_day)
    {
        return floor($this->getBTimeLast($birthday_month, $birthday_day) / 60) % 60;
    }


    function getBTimeLeft($birthday_month, $birthday_day)
    {
        return mktime(23, 59, 59, $birthday_month, $birthday_day, $this->getYear()) - time();  // 정한 날과의 시간 차이
    }

    function getBirthdayLeftHour($birthday_month, $birthday_day)
    {
        return floor($this->getBTimeLeft($birthday_month, $birthday_day) / 3600);
    }

    function getBirthdayLeftMin($birthday_month, $birthday_day)
    {
        return floor($this->getBTimeLeft($birthday_month, $birthday_day) / 60) % 60;
    }

    function getNextYear()
    {
        return $this->getYear() + 1;
    }

    function getNextRemainBirthday($birthday_month, $birthday_day)
    {
        return -$this->remain($this->getNextYear() . "-" . "$birthday_month" . "-" . "$birthday_day");
    }

    function getBirthdayText($birthday_year, $birthday_month, $birthday_day)
    {
        return "$birthday_year" . "-" . "$birthday_month" . "-" . "$birthday_day";
    }

    function getLifeDays($birthday_year, $birthday_month, $birthday_day)
    {
        return $this->remain($this->getBirthdayText($birthday_year, $birthday_month, $birthday_day));
    }

    function getRealAge($birthday_year, $birthday_month, $birthday_day)
    {
        return $this->realagecalc($birthday_year, $birthday_month, $birthday_day, $this->getYear(), $this->getMonth(), $this->getDay());
    }

    function realagecalc($birth_year, $birth_month, $birth_day, $now_year, $now_month, $now_day)
    {
        if ($birth_month < $now_month)
            $age = $now_year - $birth_year;
        else if ($birth_month == $now_month) {
            if ($birth_day <= $now_day)
                $age = $now_year - $birth_year;
            else
                $age = $now_year - $birth_year - 1;
        } else
            $age = $now_year - $birth_year - 1;

        return $age;
    }

    function getLife($birthday_year, $birthday_month, $birthday_day)
    {
        return $this->getRealAge($birthday_year, $birthday_month, $birthday_day) / 80;
    }

    function getLifeTime($birthday_year, $birthday_month, $birthday_day)
    {
        return $this->getLife($birthday_year, $birthday_month, $birthday_day) * 1440;
    }

    function getLifeHour($birthday_year, $birthday_month, $birthday_day)
    {
        return floor($this->getLifeTime($birthday_year, $birthday_month, $birthday_day) / 60);
    }

    function getLifeMin($birthday_year, $birthday_month, $birthday_day)
    {
        return $this->getLifeTime($birthday_year, $birthday_month, $birthday_day) % 60;
    }

    function remain($d)
    {
        $day = strtotime($d);
        return intval((time() - $day) / 86400);
    }
}

?>