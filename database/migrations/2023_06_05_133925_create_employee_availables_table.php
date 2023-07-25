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
        Schema::create('employee_availables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('keperluan_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_availables');
    }
};
