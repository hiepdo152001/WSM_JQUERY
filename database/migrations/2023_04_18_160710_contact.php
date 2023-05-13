<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->integer('type');
            $table->integer('phone');
            $table->string('project');
            $table->string('reason');
            $table->timestamp('time_start')->nullable();
            $table->timestamp('time_end')->nullable();
            $table->integer('status');
            $table->timestamp('dealine')->nullable();
            $table->timestamps();
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
