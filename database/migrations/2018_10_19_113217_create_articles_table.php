<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('category_id')->unsigned()->nullable(false);
            $table->tinyInteger('user_id')->unsigned()->nullable(false);
            $table->tinyInteger('status')->unsigned()->default(1)->comment('状态');
            $table->integer('view_count')->unsigned()->default(0)->comment('点击查看计数');
            $table->string('title', 255)->nullable(false);
            $table->string('slug')->unique()->nullable(false)->index();
            $table->string('source', 255)->comment('来源网址');
            $table->string('description', 255)->nullable()->comment('描述');
            $table->string('thumbnail', 100)->nullable()->comment('缩略图');
            $table->longText('content')->nullable()->comment('主体内容json{raw,html}');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
