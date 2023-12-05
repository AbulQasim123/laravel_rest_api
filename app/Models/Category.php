<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $fillable = [
        'slug',
        'name',
        'is_active'
    ];

    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s', strtotime($value));
    }
}
