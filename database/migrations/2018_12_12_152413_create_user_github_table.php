<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGithubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_github', function (Blueprint $table) {
            $table->integer('id')->index()->unsigned()->nullable(false)->comment(' i');
            $table->integer('user_id')->unsigned()->nullable(false)->comment('user_id');
            $table->string('name', 125)->nullable()->comment('name');
            $table->string('email', 125)->nullable()->comment('email');
            $table->string('location', 125)->nullable()->comment('location');
            $table->string('avatar_url', 255)->nullable()->comment('avatar_url');
            $table->string('login', 155)->nullable()->comment('login');
            $table->string('type', 50)->nullable()->comment('type');
            $table->string('bio', 255)->nullable()->comment('bio');

            $table->string('node_id', 255)->nullable()->comment('node_id');
            $table->string('gravatar_id', 125)->nullable()->comment('gravatar_id');
            $table->string('url', 200)->nullable()->comment('url');
            $table->string('html_url', 200)->nullable()->comment('html_url');
            $table->string('followers_url', 200)->nullable()->comment('followers_url');
            $table->string('following_url', 200)->nullable()->comment('following_url');
            $table->string('gists_url', 200)->nullable()->comment('gists_url');
            $table->string('starred_url', 200)->nullable()->comment('starred_url');
            $table->string('subscriptions_url', 200)->nullable()->comment('subscriptions_url');
            $table->string('organizations_url', 200)->nullable()->comment('organizations_url');
            $table->string('repos_url', 200)->nullable()->comment('repos_url');
            $table->string('events_url', 200)->nullable()->comment('events_url');
            $table->string('received_events_url', 200)->nullable()->comment('received_events_url');
            $table->smallInteger('site_admin')->nullable(false)->default(0)->comment('site_admin');
            $table->string('company', 155)->nullable()->comment('company');
            $table->string('blog', 155)->nullable()->comment('blog');
            $table->string('hireable', 200)->nullable()->comment('hireable');
            $table->smallInteger('public_repos')->nullable()->comment('public_repos');
            $table->smallInteger('public_gists')->nullable()->comment('public_gists');
            $table->smallInteger('followers')->nullable()->comment('followers');
            $table->smallInteger('following')->nullable()->comment('following');
            $table->string('created_at', 64)->nullable()->comment('created_at');
            $table->string('updated_at', 64)->nullable()->comment('updated_at');

            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users'); // ->onDelete('cascade')->onUpdate('cascade')
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `user_github` comment 'user_github table'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_github');
    }
}
