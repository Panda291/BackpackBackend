<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticNeed extends Model
{
    use hasFactory;

    protected $fillable = [
        'foreignId',
        'needed_on'
    ];
}