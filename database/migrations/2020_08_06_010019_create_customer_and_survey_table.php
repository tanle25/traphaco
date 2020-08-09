<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAndSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('customer_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedTinyInteger('status');
            $table->timestamps();
        });

        Schema::create('customer_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_test_id');
            $table->unsignedBigInteger('question_id')->nullable(); // Chú ý xét kỹ trường hợp null
            $table->unsignedBigInteger('option_choice')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::table('customer_tests', function (Blueprint $table) {
            $table->foreign('survey_id')->references('id')->on('survey')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

        });

        Schema::table('customer_answers', function (Blueprint $table) {
            $table->foreign('customer_test_id')->references('id')->on('customer_tests')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_tests', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['survey_id']);
            $table->dropForeign(['created_by']);
        });

        Schema::table('customer_answers', function (Blueprint $table) {
            $table->dropForeign(['customer_test_id']);
            $table->dropForeign(['question_id']);
        });
        Schema::dropIfExists('customer_tests');
        Schema::dropIfExists('customer_answers');
    }
}