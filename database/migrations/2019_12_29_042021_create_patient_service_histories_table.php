<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientServiceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('patient_service_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('patient_hmo_id')->nullable();
            $table->unsignedBigInteger('personnel_id')->nullable();
            $table->string('approval_code')->nullable();
            $table->decimal('total_charges', 18, 6)->nullable();
            $table->decimal('discounted_charges', 18, 6)->nullable();
            $table->decimal('discount_rate')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('transaction_status');
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('patient_hmo_id')->references('id')->on('patient_hmos');
            $table->foreign('personnel_id')->references('id')->on('personnels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('patient_service_histories');
    }
}
