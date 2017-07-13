<?php

namespace Saf\Interfaces\Shared\Handlers;

use Illuminate\Http\Request;

class ForbiddenHandler
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $user = $this->request->user();

        app()->abort(403);
    }
}