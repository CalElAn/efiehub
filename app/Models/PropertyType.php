<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;

    protected $table = 'property_type';

    protected $primaryKey = 'type';

    public $incrementing = false;

    protected $keyType = 'string';

    public function features()
    {
        return $this->belongsToMany(PropertyFeature::class, 'PropertyType_PropertyFeature_join', 'type', 'feature', 'type', 'feature')->withTimestamps();
    }
}
