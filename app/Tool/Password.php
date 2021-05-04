<?php


namespace App\Tool;


class Password
{

    private static $key='superAdmin is so cool!';

    static function getPassword($password){

        return md5($password.md5(self::$key));
    }
}
