<?php


namespace App\Tool;


class Number
{

    static function getNumber($number){


        return ($number<10)?'0'.$number:$number;
    }

}
