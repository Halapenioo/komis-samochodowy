<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');

            // Daty i przebieg
            $table->date('last_inspection_date')->nullable();
            $table->date('next_inspection_date')->nullable();
            $table->date('insurance_expiry_date')->nullable();
            $table->integer('mileage_at_inspection');

            // Pomiary lakieru (Góra i zderzaki)
            $table->integer('paint_thickness_hood')->nullable();
            $table->integer('paint_thickness_roof')->nullable();
            $table->integer('paint_thickness_front_bumper')->nullable();
            $table->integer('paint_thickness_rear_bumper')->nullable();

            // Pomiary lakieru (Lewa strona)
            $table->integer('paint_thickness_front_left_fender')->nullable();
            $table->integer('paint_thickness_front_left_door')->nullable();
            $table->integer('paint_thickness_rear_left_door')->nullable();
            $table->integer('paint_thickness_rear_left_fender')->nullable();

            // Pomiary lakieru (Prawa strona)
            $table->integer('paint_thickness_front_right_fender')->nullable();
            $table->integer('paint_thickness_front_right_door')->nullable();
            $table->integer('paint_thickness_rear_right_door')->nullable();
            $table->integer('paint_thickness_rear_right_fender')->nullable();

            // Uwagi i systemowe
            $table->text('known_defects')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
