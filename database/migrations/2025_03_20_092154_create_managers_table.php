
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('employ_id')->unique(); 
            $table->string('phone')->nullable(); 
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->string('gender_id');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->string('supervisor'); 
            $table->time('work_time_from'); 
            $table->time('work_time_to'); 
            $table->decimal('salary', 10, 2);  
            $table->integer('leave')->nullable(); 
          
            
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};

