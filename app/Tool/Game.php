<?php


namespace App\Tool;


class Game
{
    /**
     * 获取适用平台
     * Create by Peter Yang
     * 2020-10-30 15:09:30
     * @param $platform_type
     */
    public static function getPlatformTypeHtml($platform_type){


        if(in_array('安卓', $platform_type, true) && in_array('ios', $platform_type, true)){

            return '<i>&#xe622;</i><i>&#xe631;</i>';
        }

        if(in_array('安卓', $platform_type, true)){

            return '<i>&#xe622;</i>';
        }


        if(in_array('ios', $platform_type, true)){

            return '<i>&#xe631;</i>';
        }

    }


    public static function getIconArray(){

        return
            [
                '动作冒险'=>'&#xe604;',
                '角色扮演'=>'&#xe605;',
                '卡牌游戏'=>'&#xe606;',
                '射击枪战'=>'&#xe613;',
                '休闲益智'=>'&#xe61e;',
                '塔防游戏'=>'&#xe616;',
                '模拟经营'=>'&#xe614;',
                '战争策略'=>'&#xe7d4;',
                '体育竞速'=>'&#xe621;',
                '音乐舞蹈'=>'&#xe639;',
                '恋爱养成'=>'&#xe65c;',
                '解谜烧脑'=>'&#xe79f;'
            ];

    }


}
