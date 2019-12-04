<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('city');
            $table->string('address');
            $table->string('zip_code', 50);
            $table->string('home_phone_number', 20)->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->string('email_address')->nullable();
            $table->date('birth_date');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('occupation')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_person_number')->nullable();
            $table->string('senior_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
