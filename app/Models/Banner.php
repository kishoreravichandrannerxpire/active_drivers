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

    public function histories()
    {
        return $this->hasMany(BannerHistory::class, 'banners_id');
    }

    protected static function booted()
    {
        static::created(function ($banner) {
            $banner->histories()->create([
                'title'       => $banner->title,
                'type'        => $banner->type,
                'description' => $banner->description,
                'image'       => $banner->image,
                'alt_text'    => $banner->alt_text,
                'link'        => $banner->link,
                'status'      => $banner->status,
                'action'      => 'created',
            ]);
        });

        static::updated(function ($banner) {
            $banner->histories()->create([
                'title'       => $banner->title,
                'type'        => $banner->type,
                'description' => $banner->description,
                'image'       => $banner->image,
                'alt_text'    => $banner->alt_text,
                'link'        => $banner->link,
                'status'      => $banner->status,
                'action'      => 'updated',
            ]);
        });

        static::deleting(function ($banner) {
            $banner->histories()->create([
                'title'       => $banner->title,
                'type'        => $banner->type,
                'description' => $banner->description,
                'image'       => $banner->image,
                'alt_text'    => $banner->alt_text,
                'link'        => $banner->link,
                'status'      => $banner->status,
                'action'      => 'deleted',
            ]);
        });
    }
}
