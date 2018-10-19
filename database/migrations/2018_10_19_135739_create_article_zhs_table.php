<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleZhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_zhs', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->string('title', 255)->nullable(false);
            $table->string('slug')->unique()->index();
            $table->string('source', 255)->comment('source');
            $table->string('description', 255);
            $table->longText('content')->comment('json{raw,html}');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_zhs');
    }
}
