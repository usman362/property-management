<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(BuildingMedia::class, 'building_id', 'id')->where('media_type','image');
    }

    public function videos()
    {
        return $this->hasMany(BuildingMedia::class, 'building_id', 'id')->where('media_type','videos');
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class, 'building_id', 'id');
    }
}
