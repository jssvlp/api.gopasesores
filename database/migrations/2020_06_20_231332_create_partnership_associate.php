<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnershipAssociate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnership_associate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partnership_client_id');
            $table->unsignedBigInteger('client_people_id')->nullable();
            $table->unsignedBigInteger('client_company_id')->nullable();

            //Foreigns
            $table->foreign('partnership_client_id')->references('id')->on('client_partnership');
            $table->foreign('client_people_id')->references('id')->on('client_people');
            $table->foreign('client_company_id')->references('id')->on('client_company');

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
        Schema::dropIfExists('partnership_associate');
    }
}
