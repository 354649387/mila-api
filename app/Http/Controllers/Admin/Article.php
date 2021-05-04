<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tool\Json;

class Article extends Controller{

    /**
     * 新增文章
     */
    public function add(){

        $article = new \App\Model\Article();


        $title = request()->input('title');
        $keyword = request()->input('keyword');
        $desc = request()->input('desc');
        $content = request()->input('content');
        $category_id = request()->input('category_id');
        $img = request()->input('img');

        $article->title = $title;
        $article->keyword = $keyword;
        $article->desc = $desc;
        $article->content = $content;
        $article->category_id = $category_id;
        $article->img = $img;

        $res = $article->save();

        if(!$res){

            return Json::code(2,'error');

        }



        return Json::code(1,'success');



    }


    /**
     * 文章列表
     */
    public function list(){

        $data = \App\Model\Article::where('status',1)->orderBy('created_at','desc')->get();

        $data = $data->toArray();

        return Json::code(1,'success',$data);
    }

    /**
     * 删除文章
     */
    public function delete(){

        $id = request()->input('id');

        \App\Model\Article::destroy($id);

        return Json::code(1,'success');


    }

    /**
     * 编辑文章
     */
    public function edit(){




        $id = request()->input('id');
        $title = request()->input('title');
        $keyword = request()->input('keyword');
        $desc = request()->input('desc');
        $content = request()->input('content');
        $category_id = request()->input('category_id');
        $img = request()->input('img');


        $article = \App\Model\Article::find($id);


        $article->title = $title;
        $article->keyword = $keyword;
        $article->desc = $desc;
        $article->content = $content;
        $article->category_id = $category_id;
        $article->img = $img;

        $res = $article->save();

        if(!$res){

            return Json::code(2,'error');

        }



        return Json::code(1,'success');

    }

    /**
     * 根据id获取详情
     */
    public function getDefaultById(){

        $id = request()->input('id',2);

        $data = \App\Model\Article::find($id);

        $data = $data->toArray();


        return Json::code(1,'success',$data);
    }
}
