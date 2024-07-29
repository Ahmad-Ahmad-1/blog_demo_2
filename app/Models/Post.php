<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'caption', 'img'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function last()
    {
        return Post::latest()->first();
    }

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            $post->user_id = auth()->user()->id;
        });
    }
}
