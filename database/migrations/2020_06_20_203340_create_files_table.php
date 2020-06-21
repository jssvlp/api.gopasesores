<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type',['General']);
            $table->unsignedBigInteger('client_id_people')->nullable();
            $table->unsignedBigInteger('client_id_company')->nullable();
            $table->unsignedBigInteger('client_id_partnership')->nullable();

            //Foreings
            $table->foreign('client_id_people')->references('id')->on('client_people');
            $table->foreign('client_id_company')->references('id')->on('client_company');
            $table->foreign('client_id_partnership')->references('id')->on('client_partnership');

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
        Schema::dropIfExists('files');
    }
}
