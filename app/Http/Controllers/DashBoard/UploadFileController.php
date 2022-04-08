<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
class UploadFileController extends Controller
{
    public function uploadFile(Request $request)
    {
        $path = 'uploads/'.date("Y-m-d");
        $file = $request->file; 
        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }
        $name = time().'.'.$file->getClientOriginalExtension();
        $file->move($path, $name);

        return $path .'/'. $name;
    }
}
