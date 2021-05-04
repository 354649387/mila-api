<?php


namespace App\Tool;


class Category
{

    /**
     * Create by Peter
     * 2019/11/12 16:27:29
     * Email:904801074@qq.com
     * @param $pid
     * @return array
     */
    static function getCategoryByPid($pid){


        return (new self())->c($pid);
    }

    /**
     * Create by Peter
     * 2019/11/12 16:27:39
     * Email:904801074@qq.com
     * @param $pid
     * @return array
     */
    private function c($pid){

        static $all=[];

        $list= \App\Model\Category::where('pid',$pid)->get();

        if($list) {

            foreach ($list as $key => $value) {

                $all[] = $value;

                $id = $value->id;

                $this->c($id);


            }

        }

        return array_values($all);

    }

    /**
     * 分类下拉组件的获取分类数据函数
     */
    static function getCategoryByPidForCategory($pid){

        $tag_id=env('TAG_ID');

        $mode_tag_id=env('MODE_TAG_ID');

        return (new self())->c2($pid,[$tag_id,$mode_tag_id]);

    }


    /**
     * Create by Peter
     * 2019/11/12 16:27:39
     * Email:904801074@qq.com
     * @param $pid
     * @param array $disableID 不查询的id
     * @return array
     */
    private function c2($pid,array $disableID){

        static $all=[];

        $list= \App\Model\Category::where('pid',$pid)->get();

        if($list) {

            foreach ($list as $key => $value) {

                $id = $value->id;

                if(in_array($id,$disableID)) continue;

                $all[] = $value;

                $this->c2($id,$disableID);


            }

        }

        return array_values($all);

    }

    /**
     * 获取关联表名称
     * Create by PeterYang
     * 2020/08/12 23:07:49
     * Email:904801074@qq.com
     * @param $category_id
     * @return bool|string
     */
    static function getExpandTableName($category_id){

        $redis = app("redis.connection");

        try {

//        if(\Cache::has('expand_table:table_expand_name_'.$category_id)){
            if ($redis->hexists('expand_table', 'table_expand_name_' . $category_id)) {


                return $redis->hget('expand_table', 'table_expand_name_' . $category_id);
            }


            $data = \App\Model\Category::find($category_id);


            $path = getObjPlus($data, 'path');

            if (!$path) {
                return '';
            }

            $pathArray = explode(',', $path);

            $pathArray = array_reverse($pathArray);

            foreach ($pathArray as $key => $value) {


                $table_name = 'expand_table_' . $value;

                $is_exists = \Schema::hasTable($table_name);

                if ($is_exists) {

//                $table_expand_name=resolve('table_expand_name');
//
//                $table_expand_name[$category_id]=$table_name;

//                dd($table_expand_name);

//                app()->instance('table_expand_name',$table_expand_name);


//                \Cache::set('expand_table:table_expand_name_'.$category_id,$table_name);

//                \Cache::put('expand_table:table_expand_name_'.$category_id,$table_name);

//                \Redis::ha
                    $redis->hset('expand_table', 'table_expand_name_' . $category_id, $table_name);


                    return $table_name;
                }


            }

            return '';
        } finally {

//            $redis->close();
        }
    }

}
