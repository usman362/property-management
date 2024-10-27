<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(BuildingMedia::class, 'id', 'building_id')->where('media_type','image');
    }

    public function videos()
    {
        return $this->hasMany(BuildingMedia::class, 'id', 'building_id')->where('media_type','videos');
    }
}
