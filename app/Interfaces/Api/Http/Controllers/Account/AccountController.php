<?php

namespace Saf\Interfaces\Api\Http\Controllers\Account;

use Saf\Domains\Users\Contracts\UserRepository;
use Saf\Interfaces\Api\Http\Controllers\BaseController;

class AccountController extends BaseController
{
    public function show(UserRepository $userRepository)
    {
        return $userRepository->transformItem($this->request->user());
    }
}