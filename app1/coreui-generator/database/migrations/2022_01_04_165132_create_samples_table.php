<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->dateTime('post_date');
            $table->text('body');
            $table->string('password');
            $table->string('token');
            $table->string('email');
            $table->integer('author_gender');
            $table->string('post_type');
            $table->integer('post_visits');
            $table->string('category');
            $table->string('category_short');
            $table->boolean('is_private');
            $table->integer('writer_id')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('writer_id')->references('id')->on('writers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('samples');
    }
}
