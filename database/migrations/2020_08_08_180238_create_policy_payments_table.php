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
            $table->date('payment_date');
            $table->date('limit_payment_date');
            $table->double('value');
            $table->boolean('collected_insurance');
            $table->double('collected_insurance_value');
            $table->double('commission_mount');
            $table->boolean('commissioned');
            $table->date('commission_date');
            $table->mediumText('comment');
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
