<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicNeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'gadget_id',
        'day_of_week',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
