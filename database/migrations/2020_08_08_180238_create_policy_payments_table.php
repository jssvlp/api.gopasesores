<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_number');

            $table->enum('payment_method',['Efectivo','Tarjeta crédito','Transferencia'])->nullable();
            $table->double('value_to_paid');
            $table->date('limit_payment_date');
            $table->double('collected_in_office_value')->nullable();
            $table->date('collected_in_office_date')->nullable();
            $table->boolean('collected_in_office')->default(false);

            $table->boolean('collected_insurance')->default(false);
            $table->double('collected_insurance_value')->nullable();
            $table->date('collected_insurance_date')->nullable();
            $table->integer('receipt_number')->nullable();

            $table->double('commissioned_mount')->nullable();
            $table->boolean('commissioned')->default(false);
            $table->date('commissioned_date')->nullable();
            $table->mediumText('comment')->nullable();
            $table->string('accounting_code')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('policy_id');

            $table->foreign('policy_id')->references('id')->on('policies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policy_payments');
    }
}
