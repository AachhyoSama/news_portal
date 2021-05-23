<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $table = "advertisements";

    protected $fillable = [
        'homepage_header_image',
        'homepage_header_url',
        'homepage_sidebar_image',
        'homepage_sidebar_url',
        'homepage_bottom_image',
        'homepage_bottom_url',

        'singlepage_header_image',
        'singlepage_header_url',
        'singlepage_sidebar_image',
        'singlepage_sidebar_url',
        'singlepage_bottom_image',
        'singlepage_bottom_url',
    ];
}
