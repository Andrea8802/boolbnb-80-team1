<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'rooms_num',
        'beds_num',
        'baths_num',
        'size',
        'address',
        'lat',
        'long',
        'imageApartment',
        'visibility',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function added_images()
    {
        return $this->hasMany(AddedImage::class);
    }
    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    public function statistics()
    {
        return $this->hasMany(Statistic::class);
    }
}