<?php


namespace App\Tool;


class Json
{


    static function code($code,$msg='',$data=[]){


        return json_encode(['code'=>$code,'msg'=>$msg,'data'=>$data]);
    }

    static function codeArray($code,$msg='',$data=[]){

        return ['code'=>$code,'msg'=>$msg,'data'=>$data];
    }




     static function tree ($data, $pid = 0) {


        $tree = [];


        
        if ($data && is_array($data)) {

            foreach($data as $v) {

                if($v['pid'] == $pid) {

                	$v['children'] = self::tree($data, $v['id']);
                	
                	$tree[] = $v;

                }
            }



        }


        return $tree;
    }





    static function tree1($category,$pid=0){

    	$tree = array();

	    foreach ($category as $k => $v) {

	        if ($v["pid"] == $pid) {

	            unset($category[$k]);

	            if (!empty($category)) {

	                $children = self::tree($category, $v["id"]);

	                if (!empty($children)) {

	                    $v["_child"] = $children;

	                }
	            }

	            $tree[] = $v;
	        }
	    }
	    return $tree;

    }




    static function tree2($category,$pid=0){

    	$lists = [];


    	foreach ($category as $key => $value) {
    		# code...
    		if($value['pid'] == $pid){

    			unset($value[$key]);

    			$value['children'] = self::tree($category,$value['id']);

    		}

    		$lists[] = $value;
    	}

    	return $lists;


    }




}
