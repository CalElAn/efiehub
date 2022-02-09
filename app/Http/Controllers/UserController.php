<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Notifications\CallBackRequested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createFavouritedProperty(Property $property)
    {   
        /** @var \App\Models\User */
        $user = Auth::user(); 
        
        if( $user->isPropertyFavourited($property) )
        { 
            return $user->favouritedProperties()->where('property_id', $property->property_id)->delete();
        }
        
        return $user->favouritedProperties()->create(['property_id' => $property->property_id]);
    }

    public function requestCallBack(User $user, Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required',
        ]);

        $user->notify(
            new CallBackRequested(
                Auth::user()->id, 
                $request->phoneNumber
            )
        );
    }
}
