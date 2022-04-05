<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class ServiceController extends CRUDController
{
    use APIResponseTrait;
    public function __construct(Service $model)
    {
        $this->model = $model;
    }
    public function store(Request $request){
       
        $requestArray = $request->all();
        if($request->hasFile('image'))
        { 
            $fileName = $this->uploadImage( $request , 530 , 432 );
          if(isset($requestArray['image']) )
          $requestArray['image'] =  $fileName;
        }
        $requestArray['user_id'] = Auth::user()->id;
        $this->model->create($requestArray);
        session()->flash('action', 'تم الاضافه بنجاح');
        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function update($id , Request $request){
        $requestArray = $request->all();
        if($request->hasFile('image'))
        {
            $fileName = $this->uploadImage( $request ,530 , 432 );
          if(isset($requestArray['image']) )
          $requestArray['image'] =  $fileName;
        }
        $row = $this->model->FindOrFail($id);        
        $requestArray['user_id'] = Auth::user()->id;
        $row->update($requestArray);
        session()->flash('action', 'تم التحديث بنجاح');
        return redirect()->route($this->getClassNameFromModel().'.index');
    }
}
