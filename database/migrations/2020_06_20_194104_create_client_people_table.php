<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_people', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('document_type',['Cedula','Passaporte','RNC','Cedula de Extranjería']);
            $table->string('document_number');
            $table->date('document_expire_date');
            $table->date('document_expedition_date');
            $table->enum('gender',['Masculino','Femenino']);
            $table->string('client_code')->nullable();

            $table->date('birth_date')->nullable();
            //CRM DATA
            $table->enum('marital_status',['Soltero','Casado','Divorciado','Unión Libre','Viudo']);
            $table->double('monthly_income')->nullable();
            $table->enum('currency',['RD','USD']);

            $table->enum('status',['Activo','Inactivo']);

            $table->unsignedBigInteger('occupation_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->unique();

            //Foreign
            $table->foreign('user_id')->references('id')->on('users');
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
