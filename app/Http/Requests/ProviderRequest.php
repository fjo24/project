<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'           => 'max:30',   
            'email'          => 'email|required|unique:providers', 
            'rif'            => 'required|max:15|unique:providers',
            'locale'         => 'required|max:130',
            'telephone'      => 'required|numeric|min:11',
        ];
    }

}
