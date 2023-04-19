<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'member_id',
        'amount',
        'paid_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $visible = [
        'id',
        'member_id',
        'amount',
        'paid_at',
    ];
}
