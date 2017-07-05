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
            'name'       => 'max:50',   
            'lastname'       => 'max:50',   
            'email'          => 'email|required|unique:users', 
            'identification' => 'required|min:5|unique:users',
            'telephone'      => 'required|numeric|min:11',
            'password'       => 'required|confirmed|min:6', 
        ];
    }
}