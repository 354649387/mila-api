<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tool\Json;

class Rule extends Controller{

    /**
     * 新增路由
     */
    public function addRule(){

        $path = request()->input('path');
        $desc = request()->input('desc');

        $rule = new \App\Model\Rule();

        $rule->path = $path;
        $rule->desc = $desc;

        $res = $rule->save();

        if(!$res){

            return Json::code('2','error');

        }


        return Json::code('1','success');

    }


    /**
     * 获取路由
     */

    public function getRule(){

        $rule = \App\Model\Rule::all()->toArray();

        return Json::code(1,'success',$rule);

    }

    /**
     * 编辑
     */
    public function edit(){

        $id = request()->input('id');

        $path = request()->input('path');

        $desc = request()->input('desc');

        $rule = \App\Model\Rule::find($id);

        $rule->path = $path;
        $rule->desc = $desc;

        $res = $rule->save();

        if(!$res){

            return Json::code('2','error');

        }


        return Json::code('1','success');



    }

    /**
     * 删除
     */

    public function delete(){

        $id = request()->input('id');

        $res = \App\Model\Rule::destroy($id);

        if(!$res){

            return Json::code('2','error');

        }


        return Json::code('1','success');

    }

}
