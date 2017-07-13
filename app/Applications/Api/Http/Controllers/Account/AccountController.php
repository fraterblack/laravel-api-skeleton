<?php

namespace Saf\Applications\Api\Http\Controllers\Account;

use Saf\Applications\Api\Http\Controllers\BaseController;

class AccountController extends BaseController
{
    public function show()
    {
        return $this->request->user();
    }
}