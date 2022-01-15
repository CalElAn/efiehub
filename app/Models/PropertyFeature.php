<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFeature extends Model
{
    use HasFactory;

    protected $table = 'property_features';

    protected $primaryKey = 'feature';
    
    public $incrementing = false;

    protected $keyType = 'string';

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'Properties_PropertyFeatures_join', 'feature', 'property_id', 'feature', 'property_id')->withTimestamps();
    }

    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class, 'PropertyTypes_PropertyFeatures_join', 'feature', 'type', 'feature', 'type')->withTimestamps();
    }
}
