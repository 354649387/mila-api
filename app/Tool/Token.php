<?php


namespace App\Tool;


use App\Model\Admin;
use App\Model\ApiToken;
use Ramsey\Uuid\Uuid;

class Token
{


    /**
     * 生成令牌
     * Create by Peter
     * 2019/08/14 09:36:35
     * Email:904801074@qq.com
     * @param $admin_id
     * @param int $expire_time
     * @return \Ramsey\Uuid\UuidInterface
     * @throws \Exception
     */
    static function createToken($admin_id,$expire_time=86400){

        $token=Uuid::uuid1();

        $api_token=new ApiToken();

        $api_token->admins_id=$admin_id;

        $api_token->expire_time=$expire_time+time();

        $api_token->token=$token;

        $api_token->save();

        return $token;

    }


    static function checkToken($token){



    }

}
