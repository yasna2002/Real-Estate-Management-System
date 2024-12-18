<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    protected $guarded = [
        'id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
