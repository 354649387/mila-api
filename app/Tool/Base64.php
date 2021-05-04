<?php


namespace App\Tool;


class Base64
{


    /**
     * 判断是否用base64进行encode过
     *
     * @param $str
     * @return bool
     */
    static function str_is_base64($str)
    {
        if ((new self())->is_utf8(base64_decode($str)) && base64_decode($str) != '') {
            return true;
        }
        return false;
    }


    /**
     * 判断否为UTF-8编码
     *
     * @param $str
     * @return bool
     */
    function is_utf8($str)
    {
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            $c = ord($str[$i]);
            if ($c > 128) {
                if (($c > 247)) {
                    return false;
                } elseif ($c > 239) {
                    $bytes = 4;
                } elseif ($c > 223) {
                    $bytes = 3;
                } elseif ($c > 191) {
                    $bytes = 2;
                } else {
                    return false;
                }
                if (($i + $bytes) > $len) {
                    return false;
                }
                while ($bytes > 1) {
                    $i++;
                    $b = ord($str[$i]);
                    if ($b < 128 || $b > 191) {
                        return false;
                    }
                    $bytes--;
                }
            }
        }
        return true;
    }

}
