<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gadget extends Model
{
    use hasFactory;

    protected $fillable = [
        'name',
        'icon',
    ];

    protected $attributes = [
        'in_backpack' => false,
    ];

    protected $hidden = [
        'RFID',
        'created_at',
        'updated_at',
    ];
}
