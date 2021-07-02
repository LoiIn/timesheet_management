<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
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
            'username'      => ['required', 'string', 'max:32', 'min:5', 'unique:users,username'],
            'email'         => ['required', 'email', 'unique:users,email'],
        ];
    }
}
