<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('attendences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date'); 
            $table->time('sign_in')->nullable(); 
            $table->time('sign_out')->nullable(); 
            $table->string('shift')->nullable(); 
            $table->decimal('total_time', 5, 2)->nullable();
            $table->string('attendance_status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendences');
    }
};
