<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('workfromhomes', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->unsignedBigInteger('status_id')->default(0)->after('remarks');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->dropColumn('session');
            $table->unsignedBigInteger('section_id')->default(0)->after('to_date');
            $table->foreign('section_id')->references('id')->on('sections');
        });
    }


    public function down(): void
    {
        Schema::table('workfromhomes', function (Blueprint $table) {});
    }
};
