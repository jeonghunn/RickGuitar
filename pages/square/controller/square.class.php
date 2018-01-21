<?php

/**
 * Created by IntelliJ IDEA.
 * User: jhrunning
 * Date: 10/07/2017
 * Time: 2:25 AM
 */
class SquareClass
{


    function ConvertForRead($HTML_PURIFIER, $contents)
    {

        $contents = html_entity_decode($contents);

        $contents = htmlspecialchars($contents);

        $contents = str_replace("]}", ">", $contents);
        $contents = str_replace("{[/", "</", $contents);
        $contents = str_replace("{[br", "<br", $contents);
        $contents = str_replace("{[span", "<span", $contents);
        $contents = str_replace("{[font", "<font", $contents);
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

        // $contents = $HTML_PURIFIER->purify($contents);
        return $contents;
    }

    function getHTMLTitle($title, $square_cards)
    {

        if ($title == "" || $title == null) {
            $title = str_replace("{[", "<", $square_cards[0]['content']);
            $title = str_replace("]}", ">", $title);
            $title = strip_tags($title);

            return mb_substr($title, 0, 30);
        } else {
            return mb_substr($title, 0, 30);
        }


    }


    function getStyle($customstyle, $align)
    {

        $class_result = "";

        if ($customstyle == "") {
            //set default style
            $class_result = "squarecard";

        }

        if ($align == "left") {
            $customstyle = $customstyle . " text-align:left;";
        }

        if ($align == "center-center" || $align == "") {
            $customstyle = $customstyle . " vertical-align: middle;";
        }

        $style_result = 'style="' . $customstyle . '" class="' . $class_result . '"';

        return $style_result;
    }

}