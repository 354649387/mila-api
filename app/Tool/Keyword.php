<?php


namespace App\Tool;


class Keyword
{

    /**
     * 关键字标红
     * Create by Peter Yang
     * 2020-10-22 13:40:04
     */
    public static function getKeywordWithRed($string,$keyword){



        return str_replace($keyword,'<foot style="color: red">'.$keyword.'</foot>',$string);
    }

}
