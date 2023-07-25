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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            // $table->string('visitor_name');
            // $table->string('visitor_email');
            // $table->string('visitor_mobile_no');
            // $table->string('visitor_address');
            $table->string('visitor_enter_time');
            $table->string('visitor_out_time');
            $table->string('first_emotion');
            $table->string('feedback');
            $table->enum('visitor_status', ['On meet', 'Complete']);
            $table->foreignId('employee_availables_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('data_visitors_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
