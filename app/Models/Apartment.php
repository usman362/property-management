<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    public function building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }

    public function images()
    {
        return $this->hasMany(ApartmentMedia::class, 'apartment_id', 'id')->where('media_type','image');
    }

    public function videos()
    {
        return $this->hasMany(ApartmentMedia::class, 'apartment_id', 'id')->where('media_type','videos');
    }

    public function comments()
    {
        return $this->hasMany(ApartmentComment::class, 'apartment_id', 'id')->where('status',true);
    }
}
