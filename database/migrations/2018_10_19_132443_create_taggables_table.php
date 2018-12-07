<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taggables', function (Blueprint $table) {
            $table->integer('tag_id')->unsigned()->nullable(false);
            $table->integer('taggable_id')->unsigned()->nullable(false);
            $table->char('taggable_type', 32)->nullable(false);
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `taggables` comment 'taggables'");
        // \Illuminate\Support\Facades\DB::statement("INSERT INTO `taggables` (`tag_id`, `taggable_id`, `taggable_type`) VALUES ('1', '1', 'App\Models\Article')");
        // \Illuminate\Support\Facades\DB::statement("INSERT INTO `taggables` (`tag_id`, `taggable_id`, `taggable_type`) VALUES ('1', '2', 'App\Models\Article')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taggables');
    }
}
