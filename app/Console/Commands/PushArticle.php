<?php

namespace App\Console\Commands;

use App\Jobs\PushArticleJob;
use App\Model\ArticleTask;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PushArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '推送文章';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //获取到ArticleTask10个文章
//        $article_topten_array = ArticleTask::limit(10)->where('status',1)->orderBy('id','desc')->get();
        $article_topten_array = ['1','2','3','4','5','6','7','8','9','10'];
        $now=time();

        foreach ($article_topten_array as $key=>$value){

            $time=$now+1*60*($key+1);

            $delay=$time-$now;

            dispatch(new PushArticleJob($value))->delay($delay)->onQueue('high');
//            PushArticleJob::dispatch($value);

//            dispatch(new PushArticleJob($value->id))->delay($delay)->onQueue('high');
//            dispatch(new PushArticleJob($value->id));

//            $value->status=2;
//
//            $value->save();

        }
    }
}
