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

use Intervention\Image\ImageManagerStatic as Image;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
                            'properties' => Property::latest()->get(),
                            ]);
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
            'rent' => 'required|numeric',
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
            'rent' => $request->rent,
            'description' => $request->description,
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
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // dd($request->input());
        $properties = Property::query();

        if(!empty($request->regions))
        {
            $properties->whereIn('region', $request->regions);
        }

        if(!empty($request->types))
        {
            $properties->whereIn('type', $request->types);
        }

        if(!empty($request->priceRange))
        {
            $properties->whereBetween('rent', $request->priceRange);
        }

        switch ($request->orderBy) {
            case  'priceLowToHigh':
                $properties->orderBy('rent', 'asc');
                break;
            
            case  'priceHighToLow':
                $properties->orderBy('rent', 'desc');
                break;
            
            default:
                $properties->latest();
                break;
        }

        $response = ['properties' => $properties->get(), 'searchQuery' => $request->except('_token')];

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
    public function show(Property $property)
    {
        return view('show-property', ['property' => $property]);
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
}
