<?php

namespace App\Http\Controllers;

use App\Models\PropertyMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class FilePondController extends Controller
{
    public function process(Request $request)
    { 
        $locationID = date('Y-m-d_H_i_s').'_'.uniqid().'.'.$request->file('filepond')->extension();
        
        $request->file('filepond')
                ->storeAs('filepond/tmp/', $locationID, 'public');

        return $locationID; // it is stored as "serverId" on filepond file in frontend
    }

    public function revert(Request $request)
    { 
       Storage::disk('public')->delete('filepond/tmp/'.$request->getContent());
    }

    public function load(Request $request)
    {
        switch ($request->model) {
            case 'PropertyMedia':
                $path = PropertyMedia::find($request->id)->path;
                break;
            
            case 'User':
                $path = User::find($request->id)->profile_picture_path;
                break;
        }

        /** @var \Illuminate\Filesystem\Filesystem */
        $storagePublicDisk = Storage::disk('public');
        $storagePath = $storagePublicDisk->path($path);

        return response()->file(
            $storagePath, [
                'Content-Disposition' => 'inline', 
                'filename' => $storagePath
            ]
        );
    }

    public function remove(Request $request)
    {
        switch ($request->model) {
            case 'PropertyMedia':
                $model = PropertyMedia::find($request->id);
                $path = $model->path;
                $abortIfCheck = $model->property->does_property_belong_to_the_authenticated_user;
                $deleteOperation = 'delete';
                $deleteParams = '';
                break;
            
            case 'User':
                $model = User::find($request->id);
                $path = $model->profile_picture_path;
                $abortIfCheck = $model->is_user_the_authenticated_user;
                $deleteOperation = 'update';
                $deleteParams = ['profile_picture_path' => $model->getDefaultProfilePicture()];
                break;
        }

        abort_if(!$abortIfCheck, 403);

        if(Storage::disk('public')->delete($path)) return $model->{$deleteOperation}($deleteParams);
    }
}
