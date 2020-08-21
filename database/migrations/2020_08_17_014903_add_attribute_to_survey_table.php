<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributeToSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            if (!Schema::hasColumn('questions', 'order')) {
                $table->unsignedTinyInteger('order')->nullable();
            }

        });

        Schema::table('question_options', function (Blueprint $table) {
            if (!Schema::hasColumn('question_options', 'order')) {
                $table->unsignedTinyInteger('order')->nullable();
            }
        });

        Schema::table('survey_section', function (Blueprint $table) {
            if (!Schema::hasColumn('survey_section', 'order')) {
                $table->unsignedTinyInteger('order')->nullable();
            }
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
            $table->dropColumn('order');
            $table->dropColumn('must_mask');
        });

        Schema::table('question_options', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('survey_section', function (Blueprint $table) {
            $table->dropColumn('order');
        });

    }
}