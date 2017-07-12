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

    function getReadResult($cards)
    {

        $result_array = array(array("content" => "생일 태스트입니다."));

        return $result_array;
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
        floor($this->getLifeTime($birthday_year, $birthday_month, $birthday_day) / 60);
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