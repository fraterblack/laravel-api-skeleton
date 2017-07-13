<?php

namespace Saf\Interfaces\Shared\Http\Requests\Users;

use Saf\Support\Http\Request;

class ForgotPasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'route' => 'required|url',
        ];
    }
}
