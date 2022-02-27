<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Notifications\CallBackRequested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(User $user, Request $request)
    {
        $notifications 
            = $user->notifications->each(function ($item, $key) {
                $item->diffForHumans = $item->created_at->diffForHumans();
            });
            // dd(url()->current());

        $response = [
            'user' => $user->load('reviews'),
            'paginatedProperties' => $user->getPaginatedProperties(url()->current().'?category=paginatedProperties'),
            'reviews' => $user->reviews,
            'paginatedFavouritedProperties' => $user->getPaginatedFavouritedProperties(url()->current().'?category=paginatedFavouritedProperties'),
            'notifications' => $notifications,
        ];

        if($request->ajax())
        {
            return response([
                'paginatedProperties' => $response[$request->category] 
            ]
                , 200
            );
        }

        return view('user.show', $response);
    }

    public function edit(User $user)
    {
        abort_if(!$user->is_user_the_authenticated_user, 403);

        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        abort_if(!$user->is_user_the_authenticated_user, 403);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => 'required'
        ]);

        if($request->filepond) //input name has to be filepond because that is what is used in the "process" function in FilePond Controller
        {
            /** @var \Illuminate\Filesystem\Filesystem */
            $storagePublicDisk = Storage::disk('public');

            $storagePublicDisk->move('filepond/tmp/'.$request->filepond, 'profile_pictures/'.$request->filepond);

            $user->update(['profile_picture_path' => 'profile_pictures/'.$request->filepond]);
        }

        $user 
            = tap($user)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,           
                ]);

        return redirect()->route('users.show', ['user' => $user]);
    }

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

    public function createReview(Request $request, User $user)
    {
        abort_if($user->is_user_reviewed_by_the_authenticated_user, 403);

        $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        return response(
                $user->reviews()->create([
                    'user_id' => Auth::user()->id,
                    'rating' => $request->rating,
                    'review' => $request->body,
                ])
                ->fresh()
                ,201
            );
    }

    public function requestCallBack(User $user, Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
        ]);

        $user->notify(
            new CallBackRequested(
                Auth::user()->id, 
                $request->input()
            )
        );
    }
}
