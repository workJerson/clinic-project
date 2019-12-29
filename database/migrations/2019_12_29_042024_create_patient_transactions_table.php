<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_service_history_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('service_rate_id');
            $table->timestamps();

            $table->foreign('patient_service_history_id')->references('id')->on('patient_service_histories');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('service_rate_id')->references('id')->on('service_rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_transactions');
    }
}
