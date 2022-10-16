<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_key',
        'user_ip',
        'user_agent'
    ];
}
