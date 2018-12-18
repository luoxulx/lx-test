<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWechatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wechat', function (Blueprint $table) {
            $table->integer('id')->index()->unsigned()->nullable(false)->comment('id');
            $table->integer('user_id')->index()->unsigned()->nullable(false)->comment('user_id');

            $table->foreign('user_id')->references('id')->on('users'); // ->onDelete('cascade')->onUpdate('cascade')
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `user_linkedin` comment 'user_wechat table'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_wechat');
    }
}
