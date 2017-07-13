<?php

namespace Saf\Interfaces\Api\Http\Controllers\Account;

use Saf\Interfaces\Api\Http\Controllers\BaseController;

class AccountController extends BaseController
{
    public function show()
    {
        return $this->request->user();
    }
}