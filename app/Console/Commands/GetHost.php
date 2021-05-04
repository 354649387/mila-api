<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use QL\QueryList;

class GetHost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:host';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $rt = [];

        for ($i=1;$i<=10000;$i++) {

            $tmp = range(0000,9999);

            $host_num = array_rand($tmp,1);

//            dd($host_num);

            $ql = QueryList::get('https://whois.chinaz.com/'.$host_num.'.com');

            $select = "body > div.Tool-MainWrap.wrapper.pr > div.IcpMain02 > div > div > p:nth-child(1) > a.col-red";

            $rt[$host_num] = $ql->find($select)->text();

        }
        //空白则证明被注册
        print_r($rt);
    }
}
