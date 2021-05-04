<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('path',255)->nullable(false)->default('')->comment('路由地址');
            $table->string('desc',255)->nullable(false)->default('')->comment('路由描述');
        });

        DB::statement("ALTER TABLE `rule` COMMENT='路由表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rule');
    }
}
