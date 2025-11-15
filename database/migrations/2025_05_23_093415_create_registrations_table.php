<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_code')->unique();
            $table->string('email');
            $table->string('fullname');
            $table->string('phone');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('registration_type');
            $table->string('class_type')->nullable();
            $table->string('preferred_time')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
