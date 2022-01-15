<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteProperty extends Model
{
    use HasFactory;

    protected $table = 'favourite_properties';

    protected $primaryKey = 'favourite_id';

    protected $guarded = [];
}
