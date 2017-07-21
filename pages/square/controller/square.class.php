<?php

/**
 * Created by IntelliJ IDEA.
 * User: jhrunning
 * Date: 10/07/2017
 * Time: 2:25 AM
 */
class SquareClass
{


    function ConvertForRead($contents)
    {

        $contents = str_replace("]}", ">", $contents);
        $contents = str_replace("{[/", "</", $contents);
        $contents = str_replace("{[br", "<br", $contents);
        $contents = str_replace("{[span", "<span", $contents);
        $contents = str_replace("{[h", "<h", $contents);
        $contents = str_replace("{[p", "<p", $contents);
        $contents = str_replace("{[b", "<b", $contents);
        $contents = str_replace("{[a", "<a", $contents);
        $contents = str_replace("{[i", "<i", $contents);
        $contents = str_replace("{[u", "<u", $contents);
        $contents = str_replace("{[o", "<o", $contents);
        $contents = str_replace("{[t", "<t", $contents);
        $contents = str_replace("&quot;", '"', $contents);
        $contents = str_replace('\"', '"', $contents);
        $contents = str_replace('\'', "''", $contents);


        return $contents;
    }

    function getHTMLTitle($title, $square_cards)
    {

        if ($title == "" || $title == null) {
            return mb_substr(str_replace("{[br]}", " ", $square_cards[0]['content']), 0, 30);
        } else {
            return mb_substr($title, 0, 30);
        }


    }

}