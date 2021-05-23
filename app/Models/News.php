<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = "news";

    protected $fillable = [
        'title',
        'author',
        'slug',
        'details',
        'image',
        'category_id',
        'status',
        'featured',
        'view_count',
        'is_trending'
    ];

    protected $casts = [
        'category_id' => 'array'
    ];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function newsimages()
    {
        return $this->hasMany(NewsImage::class);
    }
}
