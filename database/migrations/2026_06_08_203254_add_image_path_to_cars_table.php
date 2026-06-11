<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Dodajemy nową kolumnę na zdjęcie (może być pusta, jeśli ktoś nie ma zdjęcia)
            $table->string('image_path')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
