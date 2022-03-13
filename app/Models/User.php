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
        'profile_picture_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email',
        'phone_number',
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

    public function getPaginatedProperties()
    {
        return $this->properties()->latest()->paginate(10)->fragment('UploadedProperties');
    }

    public function getPaginatedFavouritedProperties()
    {
        $paginatedFavouritedProperties 
            = $this
                ->favouritedProperties()
                ->with('property')
                ->latest()
                ->paginate(10, ['*'], 'favourited_properties_page')
                ->fragment('Favourites')
                ->toArray();

        //the data property is currently the "favourited properties model" with the "property model" as an object under it 
        // the below step is to make the "property model" directly under the data property 
        foreach ($paginatedFavouritedProperties['data'] as $key => $value) {
            $paginatedFavouritedProperties['data'][$key] = $value['property'];
        }

        return $paginatedFavouritedProperties;
    }

    public function getDefaultProfilePicture()
    {
        return 'https://ui-avatars.com/api/?size=50&rounded=true&name='.$this->name;
    }

    public function isPropertyFavourited($property)
    {
        return $this->favouritedProperties()->where('property_id', $property->property_id)->get()->isNotEmpty();
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

    public function receivedMessages()
    {
        return $this->hasMany(ChatMessage::class, 'to_user_id', 'id');
    }

    public function sentMessages()
    {
        return $this->hasMany(ChatMessage::class, 'from_user_id', 'id');
    }
}
