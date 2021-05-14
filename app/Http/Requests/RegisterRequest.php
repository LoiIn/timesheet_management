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
}
