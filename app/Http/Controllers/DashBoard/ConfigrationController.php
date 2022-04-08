<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configration;
use Illuminate\Support\Facades\Hash;
use Auth;
class ConfigrationController extends CRUDController
{
    use APIResponseTrait;
    public function __construct(Configration $model)
    {
        $this->model = $model;
    }

    public function update($id=1 , Request $request){
       
        $row = $this->model->FindOrFail(1);
        $requestArray = $request->all();
        if(isset($requestArray['image']) )
        {
            $fileName = $this->uploadImage($request );
            $requestArray['image'] =  $fileName;
        }
        
        // $requestArray['user_id'] = Auth::user()->id;
        $row->update($requestArray);
        return $this->APIResponse(null, null, 200);
    }
}
