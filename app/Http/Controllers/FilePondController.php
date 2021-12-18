<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class FilePondController extends Controller
{
    public function process(Request $request)
    { 
        $locationID = date('Y-m-d_H:i:s').'_'.uniqid().'.'.$request->file('filepond')->extension();
        
        $request->file('filepond')
                ->storeAs('filepond/tmp/', $locationID, 'public' );

        return $locationID; //* it is stored as "serverId" on filepond file in frontend
    }

    public function revert(Request $request)
    { 
       Storage::disk('public')->delete('filepond/tmp/'.$request->getContent());
    }
}
