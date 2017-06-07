<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Routing\Route;

class UsersRequest extends FormRequest
{

   /* private $route;
    public function __construct(Route $route)
    {
        $this->route = $route;
    } */   

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

       //$id = Request::segment(3);
       // dd($this->route->getParameter('user'));
        return [
            'name'              => 'max:15|required',   
            'last_name'              => 'max:15|required',   
            'email'        => 'email|required|unique:users', 
            'identification' => 'required|numeric|min:7|unique:users',
            'telephone' => 'required|numeric|min:11',
            //$this->route->getParameter('user'),
            'type'        => 'required',
            //. $this->route->getParameter('user'),
            'password' => 'required|confirmed|min:6', 
        ];
    }
}