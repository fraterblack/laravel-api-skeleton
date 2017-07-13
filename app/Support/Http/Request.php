<?php

namespace Saf\Support\Http;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request.
 */
class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function expectsJson()
    {
        //Sobrescreve método na classe pai, forçando a resposta como um Json
        return true;
    }
}
