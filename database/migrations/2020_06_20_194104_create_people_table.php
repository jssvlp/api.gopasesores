<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('document_type',['Cedula','Pasaporte','RNC','Cedula de Extranjería']);
            $table->string('document_number');
            $table->date('document_expire_date')->nullable();
            $table->date('document_expedition_date')->nullable();
            $table->enum('gender',['Masculino','Femenino']);
            $table->string('client_code')->nullable();

            $table->date('birth_date')->nullable();
            //CRM DATA
            $table->enum('marital_status',['Soltero','Casado','Divorciado','Unión Libre','Viudo']);
            $table->double('monthly_income')->nullable();
            $table->enum('currency',['RD','USD'])->nullable();

            $table->unsignedBigInteger('occupation_id')->nullable();

            //Foreign
            $table->foreign('occupation_id')->references('id')->on('occupations');

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
        Schema::dropIfExists('client_people');
    }
}
