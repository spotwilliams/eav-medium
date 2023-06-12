<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'name',
        'type',
        'column_name',
    ];
}
