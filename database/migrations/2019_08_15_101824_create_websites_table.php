<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('domain_id');
            $table->string('theme');
            $table->integer('index_web');
            $table->integer('index_image');
            $table->string('tool');
            $table->string('keyword');
            $table->unsignedBigInteger('server_id');
            $table->string('server_folder');
            $table->unsignedBigInteger('ad_id')->nullable();
            $table->date('date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('webmaster_id')->nullable();
            $table->string('slug');
            $table->integer('wp_posts');
            $table->integer('wp_pages');
            $table->string('wp_page_titles');
            $table->integer('wp_categories');
            $table->string('wp_category_titles');
            $table->timestamps();

            $table->foreign('ad_id')->references('id')->on('ads');
            $table->foreign('server_id')->references('id')->on('servers');
            $table->foreign('domain_id')->references('id')->on('domains');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('webmaster_id')->references('id')->on('webmasters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('websites');
    }
}
