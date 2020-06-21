<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('nationality');
            $table->string('province_of_birth');
            $table->string('postal_code');
            $table->enum('economic_activity',['Profesional independiente', 'Empleado'])->nullable();
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('cell_phone_number');
            $table->string('phone_number')->nullable();
            $table->string('email');
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
        Schema::dropIfExists('contacts');
    }
}
