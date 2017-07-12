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




}

?>