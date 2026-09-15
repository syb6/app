<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'birthday',
        'favorite_color',
        'favorite_food',
        'favorite_movie',
        'favorite_song',
        'favorite_memory',
        'favorite_place',
        'favorite_snack',
        'dream_destination',
        'anything_else',
        'ip_address',
    ];
}