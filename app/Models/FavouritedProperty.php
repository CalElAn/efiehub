<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouritedProperty extends Model
{
    use HasFactory;

    protected $table = 'favourited_properties';

    protected $primaryKey = 'favourited_id';

    protected $guarded = [];

    // protected $hidden = ['user_id'];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }
}
