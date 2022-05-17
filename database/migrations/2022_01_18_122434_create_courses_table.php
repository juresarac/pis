<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->enum('level', array('beginner', 'intermediate', 'advanced'));
            $table->enum('type',  array('individual', 'group'))->nullable();
            $table->integer('min_members');
            $table->integer('max_members');
            $table->enum('type_of_course', array('conversation', 'business'));
            $table->dateTime('start_of_the_course');
            $table->dateTime('end_of_the_course');
            $table->string('course_content');
            $table->string('img');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
