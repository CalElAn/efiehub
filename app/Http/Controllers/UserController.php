<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    public function favouriteProperty(Request $request)
    {   
        /** @var \App\Models\User */
        $user = Auth::user(); 
        $propertyId = $request->propertyId; 
        
        if( $user->isPropertyFavourited($propertyId) )
        { 
            return $user->favouriteProperties()->where('property_id', $propertyId)->delete();
        }
        
        return $user->favouriteProperties()->create(['property_id' => $propertyId]);
    }
}
