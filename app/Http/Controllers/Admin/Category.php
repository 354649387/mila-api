<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tool\Json;
use App\Model\Category as ModelCategory;


class Category extends Controller
{
    //栏目列表
    public function categorys(){

        $categorys = \App\Model\Category::all();

        $res = $this->categorysTree($categorys->toArray());

        return Json::code(1,'success',$res);

    }


    public function categorysTree($data,$pid = 0,$str = ''){

        static $arr = [];

        foreach ($data as $key => $value) {




            if($value['pid'] === $pid){

                $value['name'] = $str.$value['name'];


                $arr[] = $value;

                $this->categorysTree($data,$value['id'],"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".'|-'.$str);

            }





        }

        return $arr;


    }












    public function get_list()
    {

        $category = ModelCategory::all()->toArray();


        return Json::tree($category);

    }


    /**
     * 新增顶级栏目
     */
    public function addTopCategory()
    {

//        return Json::code(1,'success',[]);

        $name = request()->input('name');

        $cateogry = new ModelCategory();

        $cateogry->name = $name;

        $cateogry->save();

    }

    /**
     * 删除栏目   删除顶级栏目是否连着子栏目一起删除？
     */
    public function deleteCategory()
    {

        $id = request()->input('id');

         $category = ModelCategory::find($id);

         $pid = $category->pid;

         if($pid === 0){

             //有子栏目 得到子栏目id
             $son_category = ModelCategory::where('pid',$id)->get()->toArray();
             $son_ids = array_column($son_category,'id');

             //将父类id和子类id放一起
             $del_ids = $son_ids;
             $del_ids[] = $id;


             //删除成功返回1  删除失败返回0
             $res = ModelCategory::destroy($del_ids);

             if (!$res) {

                 return Json::code(2, 'error');

             }

         }else{

             //没子栏目，直接删除
             $res = ModelCategory::destroy($id);

             if (!$res) {

                 return Json::code(2, 'error');


             }

         }

        return Json::code(1, 'success');


    }

    /**
     * 添加子分类
     */
    public function addSonCategory()
    {

        $pid = request()->input('pid');
        $name = request()->input('name');

        $p_category = ModelCategory::find($pid);

        if (!$p_category) {

            return Json::code(2, '父栏目不存在');

        }

        $category = new ModelCategory();

        $category->pid = $pid;
        $category->name = $name;

        $res = $category->save();

        if (!$res) {

            return Json::code(2, '新增子栏目失败');

        }


        return Json::code(1, 'success');

    }

    /**
     * 更新栏目
     */
    public function update()
    {

        $id = request()->input('id');
        $name = request()->input('name');

        $category = ModelCategory::find($id);

        $category->name = $name;

        $category->save();

        return Json::code(1, 'success');


    }


    public function tree($category, $pid = 0)
    {

        $lists = [];

        foreach ($category as $key => $value) {

            if ($value['pid'] == $pid) {


                $lists[$value['id']] = $value;


                unset($category[$key]);


                $lists[$value['id']]['children'] = $this->tree($category, $value['id']);

            }


        }


    }


}
