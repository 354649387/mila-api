<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tool\Json;

class Login extends Controller{


    /**
     * 登陆
     */
    public function login(){

        $username = request()->input('username');

        $password = request()->input('password');

        $is_exist = \App\Model\Admin::where('username',$username)->where('status',0)->first();

        if(!$is_exist){

            return Json::code(2,'用户名不存在');

        }

        $true_username = $is_exist->username;

        $true_password = $is_exist->password;

        if($password !== $true_password){

            return Json::code(2,'密码错误');

        }

        return Json::code(1,'success',['username' => $true_username]);

    }

    /**
     * 注册功能
     * @return false|string
     */
    public function registr(){

        $username = request()->input('username');

        $password = request()->input('password');

        $is_exist = \App\Model\Admin::where('username',$username)->where('status',0)->first();

        if($is_exist){

            return Json::code(2,'用户名已存在');

        }

        $admin = new \App\Model\Admin();

        $admin->username = $username;

        $admin->password = $password;

        $res = $admin->save();

        if(!$res){

            return Json::code(2,'注册失败');

        }

        return Json::code(1,'注册成功');

    }



}
