<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimeCommissionPolicyInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prime_commission_policy_information', function (Blueprint $table) {
            $table->id();
            $table->enum('currency',['DOP','USD']);
            $table->double('prime');
            $table->double('isc');
            $table->double('commission_percentage');
            $table->double('commission_percentage_client_owner');
            $table->double('total');
            $table->string('day_of_payment');

            //Payments config
            $table->enum('payment_type',['Contado','Financiado','Fraccionado']);
            $table->enum('payment_method',['Efectivo','Tarjeta crédito','Transferencia']);
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('policy_id');
            $table->timestamps();

            $table->foreign('policy_id')->references('id')->on('policies');
            $table->foreign('bank_id')->references('id')->on('banks');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prime_commission_policy_information');
    }
};
