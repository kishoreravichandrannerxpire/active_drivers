<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerHistory extends Model
{
    protected $table = 'banners_history';
    protected $fillable = [
        'banners_id',
        'title',
        'type',
        'description',
        'image',
        'alt_text',
        'link',
        'status',
        'action'
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class, 'banners_id');
    }
}
