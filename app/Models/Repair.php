<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'replaced_part_name',
        'oem_number',
        'part_status',
        'repair_date',
        'mileage_at_repair',
        'part_cost',
        'labor_cost',
        'photo_old_part_path',
        'photo_new_part_path',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
