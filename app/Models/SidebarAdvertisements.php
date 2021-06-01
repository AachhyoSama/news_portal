<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarAdvertisements extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagename', 'link', 'status'
    ];
}
