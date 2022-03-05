<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use App\Http\Helpers\HelperMethods;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Requests\StoreOrUpdatePropertyRequest;

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
        'does_property_belong_to_the_authenticated_user',
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

    public function getDoesPropertyBelongToTheAuthenticatedUserAttribute()
    {
        if (Auth::check() && $this->user) //checking for $this->user in case property is new (created by doing "new Property") which means user is null so will throw undesired error
        {
            return $this->user->id === Auth::user()->id;
        }

        return false;
    }

    public function getAllTypesAndFeatures()
    {
        foreach(PropertyType::with('features')->get() as $item)
        {
            $propertyTypesAndFeatures[$item->type] = $item->features;
        }

        return collect($propertyTypesAndFeatures);
    }

    public static function getArrayForStoreOrUpdate(StoreOrUpdatePropertyRequest $request)
    {
        return [
            'user_id' => Auth::user()->id,
            'region' => $request->region,
            'city' => $request->city,
            'town' => $request->town,
            'address' => $request->address,
            'gps_location' => $request->gpsLocation,
            'contact_phone_number' => $request->contactPhoneNumber,
            'contact_email' => $request->contactEmail,
            'type' => $request->type,
            'price' => $request->price,
            'other_features' => $request->otherFeatures,
            'is_rent_negotiable' => $request->negotiable, //test what happens in database when negotiable os not ticked
        ];
    }

    public static function getArrayForAttachingFeatures(StoreOrUpdatePropertyRequest $request)
    {
        $attachArray = [];

        if($request->checkedFeatures) 
        {
            foreach ($request->checkedFeatures as $key => $value )
            {
                $attachArray[$value] = ['number' => null] ;
            }   
        }

        if($request->pickedFeatures)
        {
            $attachArray[$request->pickedFeatures] = ['number' => null] ;
        }

        if($request->inputFeatures) 
        {
            foreach ($request->inputFeatures as $key => $value )
            {
                $attachArray[$key] = ['number' => $value ?? 1] ;
            }
        }

        return $attachArray;
    }

    public static function getArrayForInsertingMedia(StoreOrUpdatePropertyRequest $request, $property_id)
    {
        $propertyMediaInsertArray = [];

        /** @var \Illuminate\Filesystem\Filesystem */
        $storagePublicDisk = Storage::disk('public'); //otherwise PHP intelephense cant detect method and returns undefined method since it looks for it from interface

        foreach ($request->media as $key => $value )
        {
            $newStoragePath = Auth::user()->id.'/'.$property_id.'/'.$value;

            $storagePublicDisk->move('filepond/tmp/'.$value, $newStoragePath);

            Image::make($storagePublicDisk->path($newStoragePath))->save(null, 60);

            $propertyMediaInsertArray[] = [
                'property_id' => $property_id, 
                'path' => $newStoragePath,
                'mime_type' => $storagePublicDisk->mimeType($newStoragePath),
                'extension' => pathinfo($storagePublicDisk->path($newStoragePath), PATHINFO_EXTENSION),
                'size_in_bytes' => $storagePublicDisk->size($newStoragePath),
                'formatted_size' => HelperMethods::formatSizeUnits($storagePublicDisk->size($newStoragePath)),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]; 
        }

        return $propertyMediaInsertArray;
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
