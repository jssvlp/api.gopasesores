<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchDetailCivilRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_detail_civil_risks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('civil_risk_type');
            $table->mediumText('commercial_activity');
            $table->mediumText('address');
            $table->mediumText('special_conditions');
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
        Schema::dropIfExists('branch_detail_civil_risks');
    }
}
