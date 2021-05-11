<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Validator;

class RegisterRequest extends Request
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
            'username'      => 'string|required|unique:users,username|min:5|max:32',
            'password'      => 'string|required|min:3|max:16',
            'email'         => 'string|required|unique:users,email|email:rfc,dns',
            're_password'   => 'string|required|same:password'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'username.unique'=>'The Username already exists',
    //         'username.max'   =>'Username must be less than 32 characters',
    //         'username.min'   =>'Username must be more than 5 characters',
    //         'password.max'   =>'Username must be less than 16 characters',
    //         'password.min'   =>'Username must be more than 3 characters',
    //         'email.unique'   =>'The Email already exists',
    //         're_password'    =>'The re_password is incorrect'
    //     ];
    // }
}
