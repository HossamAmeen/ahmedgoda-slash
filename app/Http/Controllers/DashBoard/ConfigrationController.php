<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Configration,User};
use Illuminate\Support\Facades\Hash;
use Auth;
class ConfigrationController extends CRUDController
{
    use APIResponseTrait;
    public function __construct(Configration $model)
    {
        $this->model = $model;
    }
    public function getAccount()
    {
        $user = auth('api')->user();
        return $this->APIResponse($user, null, 200);
    }
    public function updateAccount(Request $request)
    {
        $requestArray = $request->all();
        if(isset($requestArray['password']) )
            $requestArray['password'] =  Hash::make($requestArray['password']);
        $row = User::FindOrFail(auth('api')->user()->id);
        // $requestArray['user_id'] = auth('api')->user()->id;
        if($request->hasFile('image_file'))
        { 
            $fileName = $this->storeFile($request->image_file , $this->getFolderNameFromModel());
            if(isset($requestArray['image']) )
                $requestArray['image'] =  $fileName;
            if(File::exists($row->image) && 0) {
                File::delete($row->image);
            }
        }
        $row->update($requestArray);
        return $this->APIResponse($row, "", 200);
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
