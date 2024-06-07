<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyValueStore extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'expires_at'];
}
