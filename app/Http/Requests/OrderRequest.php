<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class OrderRequest extends FormRequest
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




    public function rules()
    {

        return [
            'title'      => 'max:50|required',
           // 'date'       => 'required|date',

        ];

    
    
    }
}
