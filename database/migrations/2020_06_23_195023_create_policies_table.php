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
            $table->enum('status',['Vencida','Vigente','No renovada','Expedición','Devengada','Cancelada']);
            $table->date('validity_start_date');
            $table->date('validity_end_date');
            $table->boolean('renewable');
            $table->longText('description_insure_property');

            //Asegurado principal
            $table->unsignedBigInteger('client_id');
            //Beneficiario secundario
            $table->string('additional_beneficiary_name');
            $table->string('additional_beneficiary_document');

            $table->longText('protected_comment');
            $table->longText('public_comment');


            $table->unsignedBigInteger('branch_id')->nullable();

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
