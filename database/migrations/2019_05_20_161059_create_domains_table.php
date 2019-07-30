<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('domain', 45);
            $table->integer('pa');
            $table->integer('da');
            $table->date('expiration');
            $table->string('nameserver1');
            $table->string('nameserver2');
            $table->string('index_status');
            $table->unsignedBigInteger('registrars_id');
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('registrars_id')->references('id')->on('registrars');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domains');
    }
}
