<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'hidden'
    ];

}
