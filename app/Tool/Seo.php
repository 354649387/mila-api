<?php


namespace App\Tool;


class Seo
{

    /**
     * 游戏页面的seo
     * @param $gameItem
     */
    static function getSeoTitleForGame($gameItem){

        $title=getObjPlus($gameItem,'title');

//        $platform_type=getObjPlus($gameItem,'ex.platform_type');

//        //无安卓，无ios
//        if(!in_array('安卓',$platform_type)&&!in_array('安卓',$platform_type)){
//
//
//        }
        //有安卓，有ios
//        if(in_array('安卓',$platform_type)&&in_array('安卓',$platform_type)){


//            $title.='_'.'安卓版_ios版下载';
//        }

//        //无安卓，有ios
//        if(!in_array('安卓',$platform_type)&&in_array('安卓',$platform_type)){
//
//            $title.='_'.getObjPlus($gameItem,'title').'ios版下载';
//        }
//
//        //有安卓，无ios
//        if(in_array('安卓',$platform_type)&&!in_array('安卓',$platform_type)){
//
//            $title.='_'.getObjPlus($gameItem,'title').'安卓版下载';
//        }


        return mb_substr($title,0,8).'_手机版_安卓版_ios版下载_'.getObjPlus(resolve('site_info'),'site_name');

    }

    /**
     * 获取游戏页面关键词
     * @param $gameItem
     * @return string
     */
    static function getSeoKeywordForGame($gameItem){


        return getObjPlus($gameItem,'title').','.getObjPlus($gameItem,'title').'安卓版下载';
    }


    /**
     * 获取应用详情seo标题
     * @param $appItem
     */
    static function getSeoTitleForApp($appItem){

        $title=getObjPlus($appItem,'title');

//        $title.='_'.'安卓版_ios版下载';
//
//        return mb_substr($title,0,22).'_'.getObjPlus(resolve('site_info'),'site_name');

        return mb_substr($title,0,8).'_手机版_安卓版_ios版下载_'.getObjPlus(resolve('site_info'),'site_name');

//        return getObjPlus($appItem,'title')."手机版_".getObjPlus($appItem,'title')."安卓版下载".'_'.getObjPlus(resolve('site_info'),'site_name');

    }

    /**
     * 获取详情页面的seo关键词
     * @param $item
     */
    public static function getSeoKeywordForDetail($item){

        $keyword=getObjPlus($item,'keyword');

        if($keyword) return $keyword;

        return getObjPlus($item,'title');

    }

    /**
     * 获取详情页面的seo描述
     * @param $item
     * @return array|mixed|string
     */
    static function getSeoDescForDetail($item){

        $desc=getObjPlus($item,'desc');

        if($desc) return mb_substr(str_replace('　','',$desc),0,60);

        return getObjPlus(resolve('site_info'),'seo_desc');

    }

    /**
     * 常规详情页面seo标题
     * @param $item
     */
    static function getSeoTitleForDetail($item){


        return mb_substr(str_replace(' ','',getObjPlus($item,'title')),0,23).'_'.getObjPlus(resolve('site_info'),'site_name');

    }

    /**
     * 获取栏目页面seo标题
     * @param $category
     * @return array|mixed|string
     */
    static function getSeoTitleForChannel($category){

        $seo_title=getObjPlus($category,'seo_title');

        if($seo_title) return $seo_title;

        return getObjPlus(resolve('site_info'),'seo_title');

    }


    /**
     * 获取栏目页面seo关键字
     * @param $category
     * @return array|mixed|string
     */
    static function getSeoKeywordForChannel($category){

        $seo_keyword=getObjPlus($category,'seo_keyword');

        if($seo_keyword) return $seo_keyword;

        return getObjPlus(resolve('site_info'),'seo_keyword');

    }


    /**
     * 获取栏目页面seo描述
     * @param $category
     * @return array|mixed|string
     */
    static function getSeoDescForChannel($category){

        $seo_desc=getObjPlus($category,'seo_desc');

        if($seo_desc) return $seo_desc;

        return getObjPlus(resolve('site_info'),'seo_desc');

    }


}
