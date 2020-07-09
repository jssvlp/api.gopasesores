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
            $table->string('name')->unique();
            $table->string('extension');
            $table->enum('type',['General','Documento Identidad']);
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('policy_id')->nullable();
            $table->unsignedBigInteger('sinister_id')->nullable();

            //Foreign
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('policy_id')->references('id')->on('policies')->onDelete('cascade');
            $table->foreign('sinister_id')->references('id')->on('sinisters')->onDelete('cascade');

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
