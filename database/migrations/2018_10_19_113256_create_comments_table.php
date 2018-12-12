<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->integer('commentable_id')->unsigned()->nullable(false);
            $table->char('commentable_type', 32)->nullable(false);
            $table->string('created_by', 100)->nullable()->comment('guest nickname');
            $table->mediumText('content')->comment('评论内容');

            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `comments` comment 'comments table评论'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
