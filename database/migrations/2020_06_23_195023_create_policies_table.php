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
            $table->string('code');
            $table->enum('status',['Vencida','Vigente']);
            $table->enum('type',['Nueva','Renovada']);
            $table->date('validity_start_date');
            $table->date('validity_end_date');
            $table->boolean('renovated');
            $table->string('description_insure_property');
            $table->double('prime_total');
            $table->integer('amount_of_fees')->default(1);
            $table->double('fee_amount');
            $table->double('amount_paid');
            $table->double('pending_balance');
            $table->double('commission');
            $table->double('insurance_payment');
            $table->longText('comment');

            $table->unsignedBigInteger('policy_type_id');
            $table->unsignedBigInteger('insurance_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('people_id')->nullable();

            //Foreign
            $table->foreign('insurance_id')->references('id')->on('insurances');
            $table->foreign('policy_type_id')->references('id')->on('policy_types')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('people_id')->references('id')->on('people');
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
