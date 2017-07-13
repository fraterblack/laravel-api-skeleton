<?php

namespace Saf\Interfaces\Shared\Http\Requests\Users;

use Saf\Support\Http\Request;

class UpdateUserRequest extends Request
{
    public function attributes()
    {
        return [
            'redefine_password' => 'Redefinir senha'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required',
            'email' => 'required|email|max:255|unique:users,email,' . $this->route()->getParameter('id'),
            'password' => 'required_with:redefine_password|min:6',
        ];
    }
}
