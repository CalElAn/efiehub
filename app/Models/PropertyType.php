<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;

    protected $table = 'property_types';

    protected $primaryKey = 'type';

    public $incrementing = false;

    protected $keyType = 'string';

    public function features()
    {
        return $this->belongsToMany(PropertyFeature::class, 'PropertyTypes_PropertyFeatures_join', 'type', 'feature', 'type', 'feature')->withTimestamps();
    }
}
