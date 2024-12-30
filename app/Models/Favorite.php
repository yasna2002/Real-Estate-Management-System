<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @property int $id
 * @property int $user_id
 * @property int $property_id
 * @property  int $likes
 * @property  int $dislikes
 * */

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];


    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
