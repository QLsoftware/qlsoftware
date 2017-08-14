<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetcoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('getcourses', function (Blueprint $table) {
            $table->integer('id');
            $table->string('kch');
            $table->string('kxh');
            $table->string('name');
            $table->string('status');
            $table->increments('index');
            $table->bigInteger('times');
            $table->string('info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
