<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyMedia;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

use DB;

use App\Http\Helpers\HelperMethods;
use Illuminate\Database\Eloquent\Collection;
use Intervention\Image\ImageManagerStatic as Image;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = ['paginatedProperties' => Property::latest()->paginate(5)->withPath('/')];

        if($request->ajax())
        {
            return response($response, 200);
        }

        return view('home', $response);
    }

    public function paginateProperties($propertyQuery = null, $itemsPerPage = 5, Request $request = null)
    {
        if( !is_null($request) && $request->path() === 'properties/search' ) $itemsPerPage = 10;
        
        return (is_null($propertyQuery) ? Property::latest() : $propertyQuery)->paginate($itemsPerPage)->withPath('/properties/paginate');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = PropertyType::with('features')->get();

        foreach($properties as $item)
        {
            $property[$item->type] = $item->features;
        }

        $property = collect($property);

        return view('add-property', ['property' => $property]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'region' => 'required',
            'city' => 'required',
            'town' => 'required',
            'address' => 'required',
            'contactPhoneNumber' => 'required',
            'contactEmail' => 'required|email',
            'type' => 'required',//add check for exists|type,type, write tests for validation, show failed validation errors in vue form
            'price' => 'required|numeric',
        ]);

        $property = Property::create([
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
        ]);

        $attachArray = [];

        if($request->checkedFeatures) 
        {
            foreach ($request->only('checkedFeatures')['checkedFeatures'] as $key => $value )
            {
                $attachArray[$value] = ['number' => null] ;
            }   
        }

        if($request->pickedFeatures) 
        {
            foreach ($request->only('pickedFeatures') as $key => $value )
            {
                $attachArray[$value] = ['number' => null] ;
            }
        }

        if($request->inputFeatures) 
        {
            foreach ($request->only('inputFeatures')['inputFeatures'] as $key => $value )
            {
                $attachArray[$key] = ['number' => $value ?? 1] ;
            }
        }
        
        $property->features()->attach($attachArray);

        foreach ($request->only('media')['media'] as $key => $value )
        {
            $newStoragePath = Auth::user()->id.'/'.$property->property_id.'/'.$value;

            /** @var \Illuminate\Filesystem\Filesystem */
            $storagePublicDisk = Storage::disk('public'); //otherwise PHP intelephense cant detect method and returns undefined method since it looks for it from interface

            $storagePublicDisk->move('filepond/tmp/'.$value, $newStoragePath);

            Image::make($storagePublicDisk->path($newStoragePath))->save(null, 60);

            $propertyMediaInsertArray[] = [
                'property_id' => $property->property_id, 
                'path' => $newStoragePath,
                'mime_type' => $storagePublicDisk->mimeType($newStoragePath),
                'extension' => pathinfo($storagePublicDisk->path($newStoragePath), PATHINFO_EXTENSION),
                'size_in_bytes' => $storagePublicDisk->size($newStoragePath),
                'formatted_size' => HelperMethods::formatSizeUnits($storagePublicDisk->size($newStoragePath)),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]; 
        }

        PropertyMedia::insert($propertyMediaInsertArray);

        return $property;
    }

    /**
     * Search for the specified resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // dd($request->input());
        $propertyQuery = Property::query();

        if(!empty($request->regions))
        {
            $propertyQuery->whereIn('region', $request->regions);
        }

        if(!empty($request->types))
        {
            $propertyQuery->whereIn('type', $request->types);
        }

        if(!empty($request->priceRange))
        {
            $propertyQuery->whereBetween('price', $request->priceRange);
        }

        switch ($request->orderBy) {
            case  'priceLowToHigh':
                $propertyQuery->orderBy('price', 'asc');
                break;
            
            case  'priceHighToLow':
                $propertyQuery->orderBy('price', 'desc');
                break;
            
            default:
                $propertyQuery->latest();
                break;
        }

        /** @var Illuminate\Pagination\LengthAwarePaginator */
        $paginatedPropertyQuery = $propertyQuery->paginate(10);

        $response = ['paginatedProperties' => $paginatedPropertyQuery->withPath('/properties/search'), 'searchQuery' => $request->except('_token')];

        if($request->ajax())
        {
            return response($response, 200);
        }

        return view('search-property', $response);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property, Request $request)
    {
        $paginatedSimilarProperties = 
            Property::where([
                ['region', $property->region],
                ['type', $property->type],
                ['slug', '!=', $property->slug], //for some reason using !== instead of == displays no records at all
            ])
            ->paginate(10)
            ->withPath("/properties/{$property->slug}");

        $response = ['property' => $property, 'paginatedProperties' => $paginatedSimilarProperties];

        if($request->ajax())
        {
            return response($response, 200);
        }

        return view('show-property', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }

    public function createReport(Request $request, Property $property)
    {
        $request->validate([
            'body' => 'required'
        ]);

        return $property->reports()->create([
                    'user_id' => Auth::user()->id,
                    'body' => $request->body
                ]);
    }

    public function createReview(Request $request, Property $property)
    {
        abort_if($property->is_property_reviewed_by_the_authenticated_user, 403);

        $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        return response(
                $property->reviews()->create([
                    'user_id' => Auth::user()->id,
                    'rating' => $request->rating,
                    'review' => $request->body,
                ])
                ->fresh()
                ,201
            );
    }

}
