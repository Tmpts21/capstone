<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('gender');
            $table->string('city');
            $table->string('barangay');
            $table->string('permanent_address');
            $table->string('present_address');
            $table->string('phone_number');


            $table->string('avatar')->nullable();
            $table->string('vaccination_card')->nullable();

            $table->decimal('latitude', 10, 8 );
            $table->decimal('longitude', 11, 8 );


            $table->string('rem_days')->nullable();

            $table->string('dailyHealthCheckDate')->nullable(); 

            $table->string('status')->default('normal');
            $table->string('role')->default('student');

            $table->string('tracing_log')->nullable();

            $table->string('medical_assesment')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
