<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon, File;
use  Auth;
use Illuminate\Support\Facades\{Validator,Hash};
class CRUDController extends Controller
{
    use APIResponseTrait;
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $rows = $this->model;
        $rows = $rows->orderBy('id', 'DESC');
        $rows = $this->filter($rows);
        $with = $this->with();
        if (!empty($with))
        {
            $rows = $rows->with($with);
        }
        $attributes = $this->attributes();
        $rows = $rows->get($attributes);

        return $this->APIResponse($rows, null, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->validationItem());
        if ($validator->fails()) {
            return $this->APIResponse(null, $validator->errors(), 400);
        }
       
        $requestArray = $request->all();
        // $requestArray['user_id'] = auth('api')->user()->id;
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

    public function show($id)
    {
        $item = $this->model->where('id',$id)->get( $this->attributes() )->first();
        $with = $this->with();
        if (!empty($with))
        {
            $item = $this->model::with($with)->get()->find($id);
            // $rows = $rows->with($with);
        }
        return $this->APIResponse($item, null, 200);
    }

    public function update($id , Request $request){
        $requestArray = $request->all();
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
        return $this->APIResponse(null, "", 200);
    }

    public function destroy($id)
    {

        $row = $this->model->FindOrFail($id);
        
        if(isset($row->image) && is_file($row->image))
        {
           
            unlink($row->image);
        }
        $row->delete();
        return $this->APIResponse(null, null, 200);
    }

    protected function filter($rows)
    {
        return $rows;
    }

    protected function with()
    {
        return [];
    }


    protected function append()
    {
        return [];
    }

    protected function attributes()
    {
        return '*';
    }

    protected function getFolderNameFromModel()
    {
        return strtolower( str_plural( class_basename($this->model) ) );
    }

    public function validationItem()
    {
        return [];
    }

    protected function storeFile($file, $folderName="images")
    {
        $path = 'uploads/'.$folderName.'/'.date("Y-m-d");
        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }
        $name = time().'.'.$file->getClientOriginalExtension();
        $file->move($path, $name);
        return $path .'/'. $name;
    }
    public function uploadFile(Request $request)
    {
        $file = $request->file; 
        $path = public_html().'/'.date("Y-m-d");
        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }
        $name = time().'.'.$file->getClientOriginalExtension();
        $file->move($path, $name);

        return $path .'/'. $name;
    }

}
