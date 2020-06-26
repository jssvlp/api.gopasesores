<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            /*TODO: colocar todos los campos que son comunes a los tres tipos de clientes
            * Crear llaves foraneas para los distintos tipos de clientes
            */
            $table->boolean('authorize_data_processing')->default(1);
            $table->date('date_of_admission');
            $table->longText('comment')->nullable();

            $table->unsignedBigInteger('contact_employee_id')->nullable();
            $table->unsignedBigInteger('referred_by_id')->nullable();
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->unique();

            $table->unsignedBigInteger('client_people_id')->nullable();
            $table->unsignedBigInteger('client_company_id')->nullable();
            $table->enum('status',['Prospecto','Concretado'])->default('Prospecto');

            //TODO: Notification config
            //Foreign
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contact_employee_id')->references('id')->on('employees');
            $table->foreign('referred_by_id')->references('id')->on('employees');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('client_people_id')->references('id')->on('client_people');
            $table->foreign('client_company_id')->references('id')->on('client_companies');
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
        Schema::dropIfExists('clients');
    }
}
