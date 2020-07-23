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
            $table->string('picture')->nullable();

            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->unique();

            $table->unsignedBigInteger('people_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->enum('status',['Prospecto','Cliente'])->default('Prospecto');

            //TODO: Notification config
            //Foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('owner_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('set null');
            $table->foreign('people_id')->references('id')->on('people')->onDelete('set null');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
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
