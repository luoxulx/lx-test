<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('parent_id')->unsigned()->default(0)->comment('父级ID');
            $table->string('name', 100)->nullable(false);
            //$table->string('name_en', 100)->nullable(false);
            $table->string('description', 255)->nullable()->comment('分类描述');
            //$table->string('description_en', 255)->nullable()->comment('分类描述');
            $table->string('thumbnail', 100)->nullable()->comment('缩略图');

            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `categories` comment 'categories table分类'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
