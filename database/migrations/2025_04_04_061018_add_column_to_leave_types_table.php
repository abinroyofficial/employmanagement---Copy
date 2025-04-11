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
    public function up(): void
    {
        Schema::table('leave_types', function (Blueprint $table) {
           
            $table->string('type')->after('type_name')->nullable(); 
        });
    }

   
    public function down(): void
    {
        Schema::table('leave_types', function (Blueprint $table) {
         
            $table->dropColumn('type');
        });
    }
};
