<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'title',
        'slug',
        'image',
        'status',
        'featured',
    ];

    public function newslist()
    {
        return $this->hasMany(News::class);
    }
}
