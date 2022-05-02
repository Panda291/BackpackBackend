<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticNeed extends Model
{
    use hasFactory;

    protected $fillable = [
        'gadget_id',
        'needed_on'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'needed_on' => 'datetime',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return substr_replace($date->format(DateTimeInterface::RFC3339_EXTENDED), 'Z', -6);
    }
}
