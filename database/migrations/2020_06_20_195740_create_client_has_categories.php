<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientHasCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_has_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('client_people_id')->nullable();
            $table->unsignedBigInteger('client_company_id')->nullable();

            //Foreign
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('client_has_categories');
    }
}
