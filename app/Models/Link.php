<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory, SoftDeletes;

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
