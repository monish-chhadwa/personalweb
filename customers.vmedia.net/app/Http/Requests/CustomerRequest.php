<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerRequest extends Request
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
        return [
            'cName'=>'required|min:3|max:60',
            'company'=>'required',
            'email'=>'required',
            'contact'=>'digits:10',
            'password'=>'required|confirmed',
            'type'=>'required'
        ];
    }
}
