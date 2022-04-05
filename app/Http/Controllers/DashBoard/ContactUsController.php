<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Hash;
use Auth;

class ContactUsController extends CRUDController
{
    use APIResponseTrait;
    public function __construct(ContactUs $model)
    {
        $this->model = $model;
    }

    public function validationItem()
    {
        return ['name' => 'required'];
    }
}
