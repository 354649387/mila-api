<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('admin_id')->nullable(false)->default(0)->comment('管理员id');
            $table->integer('role_id')->nullable(false)->default(0)->comment('角色id');
        });

        DB::statement("ALTER TABLE `admin_role` COMMENT='管理员对应角色表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_role');
    }
}
