<?php

namespace App\Http\Controllers;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Article,Service,Configration};
use Auth;
class HomeController extends Controller
{
    use APIResponseTrait;

    public function index() 
    {
        $data['articles'] = Article::orderBy('id', 'DESC')->where('type', 'article')->get()->take(6);
        $data['services'] = Article::orderBy('id', 'DESC')->where('type', 'service')->get()->take(6);
        $data['history_working'] = Article::orderBy('id', 'DESC')->where('type', 'history_working')->get()->take(6);
        $data['conifgrations'] = Configration::find(1);
        return $this->APIResponse($data, null, 200);
    }
    public function articles($id=null)
    {
        if(isset($id))
        {
           
            $articles = Article::orderBy('id', 'DESC')->where("id", $id)->first();
        }
        else
        {
            $articles = Article::orderBy('id', 'DESC')->where('type', request('type'))->get();
        }
           
        return $this->APIResponse($articles, null, 200);

    }
    public function configrations()
    {
        $data['conifgrations'] = Configration::find(1);
        return $this->APIResponse($data, null, 200);
    }
}