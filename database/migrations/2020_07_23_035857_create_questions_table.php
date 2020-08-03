<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedInteger('score')->nullable();
            $table->text('content')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('survey', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            $table->unsignedTinyInteger('type')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });

        Schema::create('survey_section', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->string('title')->nullable()->default('Không có tiêu đề');
            $table->string('content')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('survey_section_has_questions', function (Blueprint $table) {
            $table->unsignedBigInteger('survey_section_id');
            $table->unsignedBigInteger('question_id');
            $table->timestamps();
        });

        //crete relations
        Schema::table('questions', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('survey', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('survey_section_has_questions', function (Blueprint $table) {
            $table->foreign('survey_section_id')->references('id')->on('survey_section')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });

        Schema::table('survey_section', function (Blueprint $table) {
            $table->foreign('survey_id')->references('id')->on('survey')->onDelete('cascade');
        });

        Schema::table('question_options', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });

        Schema::table('survey', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });

        Schema::table('survey_section_has_questions', function (Blueprint $table) {
            $table->dropForeign(['survey_section_id']);
            $table->dropForeign(['question_id']);
        });

        Schema::table('survey_section', function (Blueprint $table) {
            $table->dropForeign(['survey_id']);
        });

        Schema::table('question_options', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
        });

        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_options');
        Schema::dropIfExists('survey');
        Schema::dropIfExists('survey_section');
        Schema::dropIfExists('survey_section_has_questions');

    }
}