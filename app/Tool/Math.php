<?php


namespace App\Tool;


class Math
{

    /**
     * 获取星星评分数量
     * @param $score
     * @param int $defaultScore
     */
    static function getScoreWithStar($score,$defaultScore=8){


        if(!$score) $score=8;

        if(!is_numeric($score)) $score=8;

        return (int)($score/2);


    }

}
