<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ip_address',
        'ip_date'
    ];
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}