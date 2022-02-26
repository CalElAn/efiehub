<?php

namespace App\Http\Controllers;

use App\Models\PropertyMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class FilePondController extends Controller
{
    public function process(Request $request)
    { 
        $locationID = date('Y-m-d_H_i_s').'_'.uniqid().'.'.$request->file('filepond')->extension();
        
        $request->file('filepond')
                ->storeAs('filepond/tmp/', $locationID, 'public' );

        return $locationID; //* it is stored as "serverId" on filepond file in frontend
    }

    public function revert(Request $request)
    { 
       Storage::disk('public')->delete('filepond/tmp/'.$request->getContent());
    }

    public function load(PropertyMedia $propertyMedia)
    {
        /** @var \Illuminate\Filesystem\Filesystem */
        $storagePublicDisk = Storage::disk('public');
        $storagePath = $storagePublicDisk->path($propertyMedia->path);

        return response()->file(
            $storagePath, [
                'Content-Disposition' => 'inline', 
                'filename' => $storagePath
            ]
        );
    }

    public function remove(PropertyMedia $propertyMedia)
    {
        abort_if(!$propertyMedia->property->does_property_belong_to_the_authenticated_user, 403);

        if(Storage::disk('public')->delete($propertyMedia->path)) return $propertyMedia->delete();
    }
}
