<?php


namespace App\Tool;


use Illuminate\Support\Facades\Schema;

class Field
{

    protected static $field=[];


    static function getFieldList($table_name){

        if(array_key_exists($table_name,self::$field)){


            return self::$field[$table_name];

        }else{

            $columns = Schema::getColumnListing($table_name);


            $table_expand_field_list[$table_name]=$columns;

            self::$field[$table_name]=$columns;


            return $columns;
//            app()->instance('table_expand_field_list',$table_expand_field_list);

        }


    }

}
