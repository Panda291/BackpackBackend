<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gadget extends Model
{
    use hasFactory;

    protected $fillable = [
        'name'
    ];

    protected $attributes = [
        'in_backpack' => false,
    ];
}
