<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;

class Property extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'properties';

    protected $guarded = [];

    protected $primaryKey = 'property_id';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        // 'property_id',
        // 'user_id',
    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'title', 
        'is_property_favourited_by_the_authenticated_user', 
        'is_property_reviewed_by_the_authenticated_user',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'other_features' => 'array',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['features', 'media', 'reviews', 'propertyType', 'user'];


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
     * Determine if the property is favourited by the currently authenticated user 
     *
     * @return bool
     */
    public function getIsPropertyFavouritedByTheAuthenticatedUserAttribute()
    {
        if (Auth::check()) 
        {   
            /** @var \App\Models\User */
            $user = Auth::user(); 

            return $user->isPropertyFavourited($this);
        }

        return false;
    }
  
    public function getIsPropertyReviewedByTheAuthenticatedUserAttribute()
    {
        if (Auth::check()) 
        {
            return $this->reviews()->where('user_id', Auth::user()->id)->get()->isNotEmpty();
        }

        return false;
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
