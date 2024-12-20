<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Property
 *
 * @property string $title
 * @property string|null $description
 * @property float $price
 * @property string|null $type
 * @property string $status
 * @property string|null $location
 * @property string $city
 * @property float|null $size
 * @property int|null $rooms
 */
class Property extends Model
{
    use HasFactory;

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
