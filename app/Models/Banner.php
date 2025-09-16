<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'type',
        'description',
        'image',
        'alt_text',
        'link',
        'status',
        'created_by',
    ];
}
