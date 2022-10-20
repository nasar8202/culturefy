<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyStrategiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_strategies', function (Blueprint $table) {
            $table->increments("id");
            $table->longText('survey_data');
            $table->integer('admin_id')->unsigned()->nullable(); 
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_strategies');
    }
}
