<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTwitterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_twitter', function (Blueprint $table) {
            $table->integer('id')->index()->unsigned()->nullable(false)->comment('id');
            $table->integer('user_id')->index()->unsigned()->nullable(false)->comment('user_id');

            $table->foreign('user_id')->references('id')->on('users'); // ->onDelete('cascade')->onUpdate('cascade')
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `user_twitter` comment 'user_twitter table'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_twitter');
    }
}
