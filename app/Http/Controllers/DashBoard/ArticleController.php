<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use  Auth,File;
class ArticleController extends CRUDController
{
    use APIResponseTrait;
    public function __construct(Article $model)
    {
        $this->model = $model;
    }
    protected function attributes()
    {
        return ['id','title','type','description','date','image','user_id'];
    }
    public function filter($rows)
    {
        $rows = $rows->where('type','=',request('type'));
        return $rows;
    }
}
