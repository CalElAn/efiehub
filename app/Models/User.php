<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'is_user_reviewed_by_the_authenticated_user',
        'is_user_the_authenticated_user'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['favouritedProperties'];

    public function getIsUserReviewedByTheAuthenticatedUserAttribute()
    {
        if (Auth::check()) 
        {
            return $this->reviews()->where('user_id', Auth::user()->id)->get()->isNotEmpty();
        }

        return false;
    }

    public function getIsUserTheAuthenticatedUserAttribute()
    {
        if (Auth::check()) 
        {
            return $this->id === Auth::user()->id;
        }

        return false;
    }

    public function getPaginatedProperties($queryString)
    {
        return $this->properties()->latest()->paginate(10)->withPath($queryString);
    }

    public function getPaginatedFavouritedProperties($queryString)
    {
        $paginatedFavouritedProperties 
            = $this
                ->favouritedProperties()
                ->with('property')
                ->latest()
                ->paginate(10)
                ->withPath($queryString)
                ->toArray();

        foreach ($paginatedFavouritedProperties['data'] as $key => $value) 
        {
            $paginatedFavouritedProperties['data'][$key] = $value['property'];
        }

        return $paginatedFavouritedProperties;
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function favouritedProperties()
    {
        return $this->hasMany(FavouritedProperty::class, 'user_id', 'id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function isPropertyFavourited($property)
    {
        return $this->favouritedProperties()->where('property_id', $property->property_id)->get()->isNotEmpty();
    }
}
