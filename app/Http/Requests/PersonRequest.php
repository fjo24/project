<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            //$id = Request::segment(3);
       // dd($this->route->getParameter('user'));
        return [
            'name'           => 'max:50|required',   
            'lastname'       => 'max:50|required',   
            'email'          => 'email|required|unique:users', 
            'identification' => 'required|numeric|min:5|unique:users',
            'telephone'      => 'required|numeric|min:11',
            
            //$this->route->getParameter('user'),
           // 'type'           => 'required',
            //. $this->route->getParameter('user'),
            'password'       => 'required|confirmed|min:6', 
        ];
    }
}
