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
        Schema::create('data_visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name');
            $table->string('visitor_email');
            $table->string('visitor_mobile_no');
            $table->string('visitor_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_visitors');
    }
};
