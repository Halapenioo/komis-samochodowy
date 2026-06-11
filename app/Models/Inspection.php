<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id', 'last_inspection_date', 'mileage_at_inspection', 'next_inspection_date', 'insurance_expiry_date',
        'paint_thickness_hood', 'paint_thickness_roof', 'paint_thickness_front_bumper', 'paint_thickness_rear_bumper',
        'paint_thickness_front_left_fender', 'paint_thickness_front_left_door', 'paint_thickness_rear_left_door', 'paint_thickness_rear_left_fender',
        'paint_thickness_front_right_fender', 'paint_thickness_front_right_door', 'paint_thickness_rear_right_door', 'paint_thickness_rear_right_fender',
        'known_defects'
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
