<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'num_views',
        'ip_address'
    ];
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}