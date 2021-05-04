<?php


namespace App\Tool;


class Doctrine
{

    protected static $rc=null;

    protected $rcMethod=null;

    protected $docComment='';

    /**
     * Create by Peter
     * 2019/08/27 16:21:53
     * Email:904801074@qq.com
     * @param string $namespace
     * @return Doctrine
     * @throws \ReflectionException
     */
    static function setNamespace(string $namespace){


        $rc = new \ReflectionClass($namespace);

        self::$rc=$rc;

        return new self;


    }


     function setMethod(string $methodName){

        $this->rcMethod=self::$rc->getMethod($methodName);

        return $this;

    }


    function getDocComment(){

        return $this->docComment=$this->rcMethod->getDocComment();
    }


    function getDocCommentPrototype($key,$default=''){

        $docComment=$this->getDocComment();

        $re=preg_match('/\@'.$key.'\((.*?)\)/',$docComment,$match);

        if(!$re) return $default;

        return explode('=',$match[1])[0];

    }


    function getuuu(){

        return 'uuu';
    }

    public function __call($method, $args) {
        echo "unknown method " . $method;
        return false;
    }

}
