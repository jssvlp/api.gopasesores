<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinisters', function (Blueprint $table) {
            $table->id();
            $table->string('sinister_company_number')->nullable();
            $table->string('type');
            $table->date('sinister_date');
            $table->date('notice_date');
            $table->date('insurance_notice_date')->nullable();
            $table->string('assigned_provider')->nullable();
            $table->longText('facts_description');
            $table->enum('status',['Objetado','Pagado','En proceso','Solicitado']);
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
        Schema::dropIfExists('sinisters');
    }
}
