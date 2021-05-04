<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tool\Json;
use Illuminate\Support\Facades\Storage;


class Upload extends Controller
{
    /**
     * 百度编辑器的上传
     */
    public function ueditorUpload()
    {

        $path = public_path('UEditor').'/';

        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents($path."config.json")), true);
        $action = $_GET['action'];

        switch ($action) {
            case 'config':
                $result = json_encode($CONFIG);
                break;

            /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                $result = include($path."action_upload.php");
                break;

            /* 列出图片 */
            case 'listimage':
                $result = include($path."action_list.php");
                break;
            /* 列出文件 */
            case 'listfile':
                $result = include($path."action_list.php");
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                $result = include($path."action_crawler.php");
                break;

            default:
                $result = json_encode(array(
                    'state' => '请求地址出错'
                ));
                break;
        }

        /* 输出结果 */
        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
            } else {
                echo json_encode(array(
                    'state' => 'callback参数不合法'
                ));
            }
        } else {
            echo $result;
        }
    }

    /**
     * element ui的上传缩略图
     */
    public function elementUploadImg(){

        //获取上传的文件
        $upload_file = request()->file('file');


        if ($upload_file) {
            //获取文件的原文件名 包括扩展名
            $oldname= $upload_file->getClientOriginalName();

            //获取文件的扩展名
            $extendname=$upload_file->getClientOriginalExtension();

            //获取文件的类型
//            $type=$upload_file->getClientMimeType();

            //获取文件的绝对路径，但是获取到的在本地不能打开
            $path=$upload_file->getRealPath();

            //要保存的文件名 时间+随机数+扩展名
            $filename=date('Ymd') . '/' . uniqid('', false) .'.'.$extendname;


            Storage::disk('uploads')->put($filename,file_get_contents($path));



        } else {

            return Json::code(2,'error');
        }


        return Json::code(1,'success',['img_url' => '/api/uploads/'.$filename]);

    }

    public function emptyUpload(){

        return Json::code(1,'success');

    }
}
