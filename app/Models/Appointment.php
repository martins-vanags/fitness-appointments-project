<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'student_count',
        'start_time',
        'end_time',
        'certificate_needed',
        'price',
        'description'
    ];
}
