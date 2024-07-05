<?php

namespace App\Modules\WaterMetrics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterQuality extends Model
{
    use HasFactory;

    protected $fillable = [
        'ph',
        'chlorine',
        'alkalinity',
        'turbidity',
        'temperature',
        'date'
    ];
}
