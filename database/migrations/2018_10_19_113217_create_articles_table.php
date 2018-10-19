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
            $table->string('title', 255)->nullable(false);
            $table->string('slug')->unique()->nullable(false)->index();
            $table->string('source', 255)->comment('source');
            $table->string('description', 255)->nullable();
            $table->string('thumbnail', 100)->nullable();
            $table->longText('content')->nullable()->comment('json{raw,html}');

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
