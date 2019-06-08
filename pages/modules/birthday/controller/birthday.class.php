<?php

/**
 * Created by IntelliJ IDEA.
 * User: jhrunning
 * Date: 10/07/2017
 * Time: 2:25 AM
 */
class BirthdayClass
{

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
}