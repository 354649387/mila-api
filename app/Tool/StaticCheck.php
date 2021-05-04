<?php


namespace App\Tool;


use App\Events\ListPageStatic;

class StaticCheck
{


    /**
     * 获取静态化内容
     */
    static function getHtml()
    {


        if (env('APP_DEBUG')) {
            return;
        }

//        dd(123);

        $static_key = request()->input('static_key');

        //判断是否是静态化请求
        if ($static_key == env('STATIC_KEY')) {
            return;
        }


        $mode = strtolower(resolve('domain_mode'));


        $htmlName = '';


        $url = request()->path() . (empty(request()->getQueryString()) ? '' : '?' . request()->getQueryString());


        switch ($url) {

            case '/':

                $htmlName = 'index.html';

                break;

            default :

                $htmlName = $url;

                break;
        }


        $htmlPath = storage_path('static/' . $mode . '/' . $htmlName);

//        return '';

        if (file_exists($htmlPath)) {


            $view = file_get_contents($htmlPath);

            echo $view;

            exit();

        }

    }

    /**
     * 生成静态文件到缓存
     * @param $html
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    static function cacheHtml($html)
    {

        $static_key = request()->input('static_key');

        $mode = strtolower(resolve('domain_mode'));

        if ($static_key == env('STATIC_KEY')) {

//            $url=request()->path().Url::getUrlParameterString();

            $url = request()->path();


        } else {

            //如果是动态参数就直接返回页面，不缓存
            if (Url::getUrlParameterString()) {
                return $html;
            }

            $url = request()->path();

//            $url=request()->path();
        }


        \Cache::set('html:' . $mode . ':' . $url, $html, 60 * 60 * 24);


        return $html;


    }


    static function getHtmlForCache()
    {

//        return;

        $static_key = request()->input('static_key');

        //debug不走缓存
        if (env('APP_DEBUG')) {


            return;
        }


        //判断是否是静态化请求
        if ($static_key == env('STATIC_KEY')) {


            return;
        }

        //动态参数不走缓存
        if (Url::getUrlParameterString()) {

            return;
        }

        //获取当前域名
        $mode = strtolower(resolve('domain_mode'));

//        if(Url::getUrlParameterString()){
//
//            $url=request()->path().Url::getUrlParameterString();
//        }else{

        $url = request()->path();
//        }

        //如果当前域名在缓存中
        if (\Cache::has('html:' . $mode . ':' . $url)) {



            //当缓存标记不存在时，执行更新（目的是为了一个列表页面当前只有一个任务在执行）
            if(!\Cache::has('html_tag:'.$url)){

                \Cache::put('html_tag:'.$url,1,60);

                //触发更新
                event(new ListPageStatic($url, $mode));

            }





            echo \Cache::get('html:' . $mode . ':' . $url);

            exit();
        }

    }

}
