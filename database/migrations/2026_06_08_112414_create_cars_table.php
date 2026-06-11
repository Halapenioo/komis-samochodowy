<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('vin')->unique();
            $table->string('brand');
            $table->string('model');
            $table->string('generation')->nullable();
            $table->integer('production_year');
            $table->date('first_registration_date')->nullable();
            $table->integer('engine_capacity');
            $table->integer('engine_power');
            $table->string('engine_code')->nullable();
            $table->string('fuel_type');
            $table->string('transmission');
            $table->string('drive_type');
            $table->integer('current_mileage');
            $table->text('usage_description');
            $table->integer('previous_owners_count')->default(1);
            $table->string('origin_country')->nullable();
            $table->boolean('is_accident_free')->default(true);
            $table->text('accident_description')->nullable();
            $table->string('status')->default('w przygotowaniu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
