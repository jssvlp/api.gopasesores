<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_number');
            $table->string('invoice_number')->nullable();
            $table->enum('status',['Vencida','Vigente','No renovada','Expedición','Devengada','Cancelada']);
            $table->date('validity_start_date');
            $table->date('validity_end_date');
            $table->boolean('renewable');
            $table->longText('description_insured_property');
            $table->double('insured_amount');
            $table->enum('currency',['DOP','USD']);

            $table->double('prime');
            $table->double('isc')->nullable();
            $table->double('commission_percentage')->nullable();
            $table->double('commission_percentage_client_owner')->nullable();
            $table->double('total')->nullable();
            $table->string('day_of_payment')->nullable();
            $table->enum('payment_type',['Contado', 'Financiado'])->default('Contado');
            $table->string('bank_payment')->nullable();

            //Asegurado principal
            $table->unsignedBigInteger('client_id');

            //Beneficiario secundario, es una persona que no necesariamente es un cliente registrado, sino  una persona externa relacionada al cliente
            $table->string('additional_beneficiary_name')->nullable();
            $table->string('additional_beneficiary_document')->nullable();

            $table->longText('protected_comment')->nullable();
            $table->longText('public_comment')->nullable();

            $table->unsignedBigInteger('branch_id');

            //Foreign
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('client_id')->references('id')->on('clients');

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
        Schema::dropIfExists('policies');
    }
}
