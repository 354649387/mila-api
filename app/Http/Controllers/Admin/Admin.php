<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Admin as AdminModel;
use App\Model\AdminRole;
use App\Tool\Json;

class Admin extends Controller{

    public function lists(){

        $admins = \App\Model\Admin::with('admin_role')->where('status','!=',1)->get();

        $admins = $admins ? $admins->toArray() : [];

        foreach ($admins as $key => $value) {

            $role_id = $value['admin_role']['role_id'];

            $admins[$key]['role'] = $this->getRoleNameByRoleId($role_id);

        }

        return Json::code(1,'success',$admins);

    }


    /**
     * 通过角色id得到角色名称
     */
    public function getRoleNameByRoleId($rid){

        $role_name = \App\Model\Role::find($rid)->name;


        return $role_name;
    }

    /**
     * @return false|string
     * 管理员添加
     * 添加admin表以及admin_role表
     */
    public function add(){

        //后续加判断不能同名等

        $username = request()->input('name');
        $nickname = request()->input('nickname');
        $password = request()->input('password');

        $role_id = request()->input('role');


        $admin = new AdminModel();

        $admin->username = $username;
        $admin->nickname = $nickname;
        $admin->password = $password;

        $admin->save();

        $admin_role = new AdminRole();

        $admin_role->admin_id = \App\Model\Admin::where('username',$username)->first()->id;
        $admin_role->role_id = $role_id;

        $admin_role->save();

        return Json::code(1,'success');



    }

    /**
     *通过管理员id得到管理员详情
     */
    public function getAdminById(){

        $id = request()->input('id',48);

        $admin = AdminModel::with('admin_role')->find($id);

        $role_id = $admin->admin_role->role_id;

        $role_name = $this->getRoleNameByRoleId($role_id);

        $admin = $admin->toArray();
        $admin['role'] = $role_name;

//        dd($admin);

        return Json::code(1,'success',$admin);

    }


    /**
     * 编辑
     */
    public function update(){


        $id = request()->input('id');
        $username = request()->input('name');
        $nickname = request()->input('nickname');
        $password = request()->input('password');

        //得到的是角色name
        $role_name = request()->input('role');

        $role_id = \App\Model\Role::where('name',$role_name)->first()->id;

//        dd($role_id);
        $admin = AdminModel::find($id);

        $admin->username = $username;
        $admin->nickname = $nickname;
        $admin->password = $password;

        $admin->save();

        $admin_role = AdminRole::where('admin_id',$id)->first();

//        $admin_role->admin_id = $id;
        $admin_role->role_id = $role_id;

        $admin_role->save();

        return Json::code(1,'success');

    }

    /**
     * 删除
     */

    public function delete(){

        $id = request()->input('id');

        //先改状态为非正常1，后续改成软删除
        $admin = AdminModel::find($id);
        $admin->status = 1;
        $admin->save();

        return Json::code(1,'success');
    }

    /**
     * 禁用
     */
    public function disable(){

        $id = request()->input('id');

        $admin = AdminModel::find($id);

        //状态2为禁用
        $admin->status = 2;
        $admin->save();

        return Json::code(1,'success');

    }

    /**
     * 启用
     */
    public function enable(){

        $id = request()->input('id');

        $admin = AdminModel::find($id);

        //状态0为正常
        $admin->status = 0;
        $admin->save();

        return Json::code(1,'success');

    }

    /**
     * 获取角色列表
     */
    public function getRole(){

        $roles = \App\Model\Role::all();
        $roles = $roles ? $roles->toArray() : [];

        return Json::code(1,'success',$roles);
    }

}
