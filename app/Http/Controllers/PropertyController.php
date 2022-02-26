<?php

namespace App\Http\Controllers;

use App\Models\Property;

use App\Http\Requests\StoreOrUpdatePropertyRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use DB;


class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = ['paginatedProperties' => Property::latest()->paginate(6)];

        if($request->ajax())
        {
            return response($response, 200);
        }

        return view('home', $response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = new Property;

        return view('property.create-or-edit', [
            'propertyTypesAndFeatures' => $property->getAllTypesAndFeatures(), 
            'mode' => 'create',
            'property' => $property
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrUpdatePropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdatePropertyRequest $request)
    {
        $property = Property::create(Property::getArrayForStoreOrUpdate($request));
        
        $property->features()->attach(Property::getArrayForAttachingFeatures($request));

        $property->media()->insert(Property::getArrayForInsertingMedia($request, $property->property_id));

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

        $response = ['paginatedProperties' => $paginatedPropertyQuery, 'searchQuery' => $request->except('_token')];

        if($request->ajax())
        {
            return response($response, 200);
        }

        return view('property.search', $response);
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
            ->paginate(10);

        $response = ['property' => $property, 'paginatedProperties' => $paginatedSimilarProperties];

        if($request->ajax())
        {
            return response($response, 200);
        }

        return view('property.show', $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        abort_if(!$property->does_property_belong_to_the_authenticated_user, 403);

        return view('property.create-or-edit', [
            'propertyTypesAndFeatures' => $property->getAllTypesAndFeatures(), 
            'mode' => 'edit',
            'property' => $property
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrUpdatePropertyRequest  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdatePropertyRequest $request, Property $property)
    {
        abort_if(!$property->does_property_belong_to_the_authenticated_user, 403);

        $property = tap($property)->update(Property::getArrayForStoreOrUpdate($request));
        
        $property->features()->sync(Property::getArrayForAttachingFeatures($request));

        $property->media()->insert(Property::getArrayForInsertingMedia($request, $property->property_id));

        return $property;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        abort_if(!$property->does_property_belong_to_the_authenticated_user, 403);

        foreach($property->media as $propertyMedia)
        {
            Storage::disk('public')->delete($propertyMedia->path);
        }

        $property->reports()->delete();
        $property->reviews()->delete();
        $property->delete();
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
