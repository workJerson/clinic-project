<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('total_rate', 8, 2);
            $table->unsignedBigInteger('h_m_o_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();
            $table->foreign('h_m_o_id')->references('id')->on('h_m_o_s');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_rates');
    }
}
