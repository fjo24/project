<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

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
        $date = Carbon::now()->format('Y-m-d');

        return [
            'title'      => 'max:100|required',
            'event_id'   => 'required',
            'date'       => 'date|required|after_or_equal:'.$date,
            'user_id'    => 'required',
            'locale'     => 'required|max:200',

        ];

    
    
    }
}
