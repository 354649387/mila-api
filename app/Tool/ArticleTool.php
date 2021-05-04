<?php


namespace App\Tool;


use App\Events\ArticleIsClick;
use App\Model\Article;

class ArticleTool
{


    /**
     * 热门资讯，点击量排行
     * @param int $limit
     * @return Article[]|\App\Model\Base[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\LaravelIdea\Helper\App\Model\_ArticleCollection|\LaravelIdea\Helper\App\Model\_ArticleQueryBuilder[]|\LaravelIdea\Helper\App\Model\_BaseCollection|\LaravelIdea\Helper\App\Model\_BaseQueryBuilder[]
     */
    static function getHotArticle($limit = 4)
    {


        return Article::with('category')->whereHas('category', function ($query) {

            $query->where('pid', 3);
        })->orderBy('click', 'desc')->limit($limit)->get();


    }

    static function ArticleClick($id){

        if(request()->input('static_key')) return;

        //触发点击事件
        event(new ArticleIsClick($id));


    }



}
