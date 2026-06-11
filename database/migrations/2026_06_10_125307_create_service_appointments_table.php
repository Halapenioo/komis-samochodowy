<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacja One-to-Many z użytkownikiem
            $table->string('car_name');
            $table->date('appointment_date');
            $table->text('description');
            $table->string('status')->default('nowe'); // statusy: nowe, w_naprawie, gotowe
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_appointments');
    }
};
