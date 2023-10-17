<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_name',
        'sale_from',
        'sale_to',
        'is_sale_active',
        'sale_percent',
        'slug',
    ];
}
