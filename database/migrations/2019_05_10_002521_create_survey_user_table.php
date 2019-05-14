<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('survey_id');
            $table->foreign('survey_id')->references('id')->on('surveys');
            $table->integer('user_id');
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
        Schema::dropIfExists('survey_user');
    }
}
