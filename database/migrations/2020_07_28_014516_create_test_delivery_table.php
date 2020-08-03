<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_round', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });

        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_round');
            $table->unsignedBigInteger('candiate_id')->nullable(); //người được chấm
            $table->unsignedBigInteger('examiner_id')->nullable(); // Người chấm
            $table->unsignedSmallInteger('multiplier')->default(1); //Hệ số nhân
            $table->unsignedBigInteger('survey_id');
            $table->unsignedFloat('score')->default(0);
            $table->unsignedSmallInteger('status');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_id');
            $table->unsignedBigInteger('question_id')->nullable(); // Chú ý xét kỹ trường hợp null
            $table->unsignedBigInteger('option_choice')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::create('option_choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('answer_id');
            $table->unsignedBigInteger('option_id')->nullable(); // Chú ý xét kỹ trường hợp null
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->foreign('examiner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('candiate_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('survey_id')->references('id')->on('survey')->onDelete('cascade');
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('set null');
        });

        Schema::table('option_choices', function (Blueprint $table) {
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('questions')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropForeign(['candiate_id']);
            $table->dropForeign(['examiner_id']);
            $table->dropForeign(['survey_id']);
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['test_id']);
            $table->dropForeign(['question_id']);
        });
        Schema::table('option_choices', function (Blueprint $table) {
            $table->dropForeign(['answer_id']);
            $table->dropForeign(['option_id']);
        });
        Schema::dropIfExists('tests');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('option_choices');
        Schema::dropIfExists('survey_round');
    }
}