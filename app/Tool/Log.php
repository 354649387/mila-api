<?php


namespace App\Tool;


class Log
{


    static function log($message,$filePath='default')
    {

        $path = storage_path('logs/' . $filePath);

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents($path.'/'.date('Y-m-d').'.log',$message.PHP_EOL,FILE_APPEND);

    }

}
