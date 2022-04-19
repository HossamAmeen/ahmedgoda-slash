<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{Validator,Hash};
use Auth;
class AdminController extends CRUDController
{
    use APIResponseTrait;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->validationItem());
        if ($validator->fails()) {
            return $this->APIResponse(null, $validator->errors(), 400);
        }
       
        $requestArray = $request->all();
        // $requestArray['user_id'] = auth('api')->user()->id;
        $requestArray['role'] = 1;
        if(isset($requestArray['password']) )
            $requestArray['password'] =  Hash::make($requestArray['password']);
        if($request->hasFile('image_file'))
        { 
            $fileName = $this->storeFile($request->image_file , $this->getFolderNameFromModel());
            
            $requestArray['image'] =  $fileName;
        }
        $this->model->create($requestArray);
        return $this->APIResponse(null,"", 200);
    }

    public function update($id , Request $request){
       
        $requestArray = $request->all();
        if(isset($requestArray['password']) )
            $requestArray['password'] =  Hash::make($requestArray['password']);
        $row = $this->model->FindOrFail($id);
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
    public function validationItem()
    {
        return [];
    }
}
