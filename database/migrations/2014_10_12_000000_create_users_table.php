<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 255);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_web')->default(false);
            $table->boolean('is_cms')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('login_attempts')->default(0);
            $table->smallInteger('account_type')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();

            $table->unique(['is_web', 'is_cms', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
