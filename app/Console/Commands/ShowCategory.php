<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Category as ModelCategory;

class ShowCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:category';

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
        $category = ModelCategory::all()->toArray();
        // dd($category);
        dd($this->tree($category));
    }




    public function tree($category,$pid=0){


        $lists = [];

        foreach ($category as $key => $value) {
            
            if($value['pid'] ==$pid){


                $value['children'] = $this->tree($category,$value['id']);


                $lists[] = $value;
                
            }


        }



        return $lists;

        
    }





}
