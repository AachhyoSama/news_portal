<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BottomAdvertisements extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagename', 'link', 'status'
    ];
}
