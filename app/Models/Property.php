<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;

class Property extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'properties';

    protected $guarded = [];

    protected $primaryKey = 'property_id';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['title'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('withRelationships', function (Builder $builder) {
            $builder->with(['features', 'media', 'reviews', 'propertyType', 'user']);
        });
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug_name',
                'onUpdate' => true,
            ]
        ];
    }

    public function getSlugNameAttribute()
    {
        return $this->type . ' in ' . $this->town;
    }

    public function getTitleAttribute()
    {
        return "{$this->type} in {$this->town}";
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function features()
    {
        return $this->belongsToMany(PropertyFeature::class, 'Properties_PropertyFeatures_join', 'property_id', 'feature', 'property_id', 'feature')->withPivot('number')->withTimestamps();
    }

    public function media()
    {
        return $this->hasMany(PropertyMedia::class, 'property_id', 'property_id');
    }

    public function propertyType() //changed name from 'type' cos it conflicted with a property on the model
    {
        return $this->belongsTo(PropertyType::class, 'type', 'type');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
