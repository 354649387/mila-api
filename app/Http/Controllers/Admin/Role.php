<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tool\Json;

class Role extends Controller
{

    /**
     * 新增路由
     */
    public function addRole(){

        $name = request()->input('name');
        $rule_id = request()->input('ruleId');

        $role = new \App\Model\Role();

        $role->name = $name;
        $role->rules = $rule_id;

        $res = $role->save();

        if(!$res){

            return Json::code('2','error');

        }


        return Json::code('1','success');

    }


    /**
     * 获取角色
     */

    public function getRole()
    {

        $rule = \App\Model\Role::all()->toArray();

        return Json::code(1, 'success', $rule);

    }


    /**
     * 通过角色id获取所属的全部路由的描述
     */
    public function getRuleDescByRoleId(){

        $role_id = request()->input('roleId',5);

        //dd($role_id);

        $role = \App\Model\Role::find($role_id);

        $rules = $role->rules;

        $rules_arr = explode(',',$rules);

        $rule = \App\Model\Rule::whereIn('id',$rules_arr)->get();

        $rule_desc = array_column($rule->toArray(),'desc');

        return Json::code(1,'success',$rule_desc);

//        dd($rule_desc);

    }

    /**
     * 编辑
     */
    public function edit(){

        $id = request()->input('roleId');

        $name = request()->input('name');

        $rule_desc = request()->input('ruleId','测试1,测试2,测试3');

        //这里是得到路由的描述。。。
        $rule_desc_arr = explode(',',$rule_desc);


        $rule_descs = \App\Model\Rule::whereIn('desc',array_values($rule_desc_arr))->get();

        $rule_ids = array_column($rule_descs->toArray(),'id');

        $rule_ids = implode(',',$rule_ids);


        $role = \App\Model\Role::find($id);

        $role->name = $name;
        $role->rules = $rule_ids;

        $res = $role->save();

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

        $res = \App\Model\Role::destroy($id);

        if(!$res){

            return Json::code('2','error');

        }


        return Json::code('1','success');

    }

    /**
     * 获取所有路由
     */
    public function getRule()
    {
        $rule = \App\Model\Rule::all()->toArray();

        return Json::code('1','success',$rule);
    }

}
