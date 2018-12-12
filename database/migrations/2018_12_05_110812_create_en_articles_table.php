<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('en_articles', function (Blueprint $table) {
            $table->integer('article_id')->unsigned()->comment('关联article ID');
            $table->string('title', 255)->nullable()->comment('en title');
            $table->string('source', 255)->nullable()->comment('en source');
            $table->string('description', 255)->nullable()->comment('en description');
            $table->longText('content')->nullable()->comment('en content');
            $table->index('article_id');
            $table->foreign('article_id')->references('id')->on('articles'); // ->onDelete('cascade')->onUpdate('cascade')
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `en_articles` comment 'en_articles table暂时弃用'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('en_articles');
    }
}
