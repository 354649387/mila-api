<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('管理员id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('username',255)->nullable(false)->default('')->comment('管理员名称');
            $table->string('password',32)->nullable(false)->default('')->comment('管理员密码');
            $table->string('nickname',255)->nullable(false)->default('')->comment('管理员昵称');
            $table->integer('last_login_time')->default(0)->comment('最后登陆时间');
            $table->integer('status')->nullable(false)->default(0)->comment('状态 0表示正常，1表示非正常');
        });


        DB::statement("ALTER TABLE `admin` COMMENT='管理员表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
