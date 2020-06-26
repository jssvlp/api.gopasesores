<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_companies', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('rnc')->unique();
            $table->date('rnc_expedition_date')->nullable();
            $table->date('rnc_expire_date')->nullable();
            $table->date('constitution_date')->nullable();
            $table->string('client_code')->nullable();
            $table->unsignedBigInteger('economic_activity_id');

            //Foreign
            $table->foreign('economic_activity_id')->references('id')->on('economic_activities');

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
        Schema::dropIfExists('client_companies');
    }
}
