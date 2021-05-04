<?php


namespace App\Tool;


class Url
{

    /**
     * 分页获取其他参数
     * @param array|string[] $exclude
     * @return string
     */
    static function getUrlParameterString(array $exclude=['page']){


        $exclude_key=['static_key','admin_key'];


        $url=request()->fullUrl();


        $url=explode('?',$url)[1]??'';

//        dd($url);

        if(!$url) return '';

        $param_array=explode('&',$url);


        $new_url='';

//        dd($param_array);

        foreach ($param_array as $key=>$value){

            $item=explode('=',$value);

//            dd($item);

            if(!in_array($item[0], $exclude_key, true)){

                $new_url.=$item[0].'='.$item[1].'&';

            }


        }

        $new_url=substr($new_url,0, -1);


        if(!$new_url) return '';

        return '?'.$new_url;

    }

    /**
     * 获取上传文件真实路径（服务器路径）
     * @param $path
     * @param string $dir
     * @return string
     */
    static function getFilePath($path,$dir='uploads'){


//        return request()->server('REQUEST_SCHEME').'://'.request()->getHost().'/'.$dir.'/'.$path;
        return public_path($dir.'/'.$path);


    }

    /**
     * 获取下载链接（nginx中的 proxy_set_header Host 要设置对）
     * @param $path
     * @param string $dir
     * @return string
     */
    static function getFileDownloadUrl($path,$dir='uploads'){

        return env('DOWNLOAD_URL').'/'.$dir.'/'.$path;
    }


    static function getMobileUrlFromPc($url){



        return str_replace('www','m',$url);
    }

}
