<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'vin', 'brand', 'model', 'generation', 'production_year',
        'first_registration_date', 'engine_capacity', 'engine_power',
        'engine_code', 'fuel_type', 'transmission', 'drive_type',
        'current_mileage', 'usage_description', 'previous_owners_count',
        'origin_country', 'is_accident_free', 'accident_description',
        'status', 'image_path','price',
    ];

    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    // NOWE: Relacja do galerii zdjęć
    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }
}
