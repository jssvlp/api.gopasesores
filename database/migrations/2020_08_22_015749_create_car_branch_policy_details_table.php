<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarBranchPolicyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_branch_policy_details', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_type'); //Lista de tipo de vehiculos
            $table->string('brand'); //Lista de marcas
            $table->string('model')->nullable();
            $table->string('year');
            $table->string('chassis')->nullable();
            $table->string('registry')->nullable();
            $table->integer('passengers_quantity')->nullable();
            $table->integer('cylinders')->nullable();
            $table->double('tons')->nullable();
            $table->double('inferable')->nullable();
            $table->string('endorsement_of_assignment'); //Lista de bancos;
            $table->string('plan_type'); //Lista de planes
            $table->unsignedBigInteger('policy_id');

            $table->foreign('policy_id')->references('id')->on('policies');


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
        Schema::dropIfExists('car_branch_policy_details');
    }
}
