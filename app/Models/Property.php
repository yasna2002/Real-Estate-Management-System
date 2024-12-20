<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    const PROPERTY_TYPE_HOUSE = 'house';
    const PROPERTY_TYPE_APARTMENT = 'apartment';
    const PROPERTY_TYPE_VILLA = 'villa';
    const PROPERTY_TYPE_OFFICE = 'office';
    const PROPERTY_TYPE_FARM = 'farm';
    const PROPERTY_TYPE_HOTEL = 'hotel';

    const PROPERTY_STATUS_RENT = 'rent';
    const PROPERTY_STATUS_BUY = 'buy';

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public static function getPropetyTypes()
    {
        return [
            self::PROPERTY_TYPE_HOUSE,
            self::PROPERTY_TYPE_APARTMENT,
            self::PROPERTY_TYPE_VILLA,
            self::PROPERTY_TYPE_OFFICE,
            self::PROPERTY_TYPE_FARM,
            self::PROPERTY_TYPE_HOTEL,
        ];
    }

    public static function getPropertyStatus(): array
    {
        return [
            self::PROPERTY_STATUS_RENT,
            self::PROPERTY_STATUS_BUY,
        ];
    }
}
