<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'long_link',
        'slug',
        'title',
        'favicon',
    ];


    public function metrics()
    {
        return $this->hasMany(Metric::class);
    }
}
