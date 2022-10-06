<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->longText('business_name')->nullable();
            $table->longText('business_describe')->nullable();
            $table->longText('known_as')->nullable();
            $table->longText('business_operating_start_date')->nullable();
            $table->longText('business_history_describe')->nullable();
            $table->longText('hr_point_person')->nullable();
            $table->longText('survey_result')->nullable();
            $table->longText('kickoff_session')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('business_infos');
    }
}
