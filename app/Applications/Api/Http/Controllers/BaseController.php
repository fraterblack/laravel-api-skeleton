<?php

namespace Saf\Applications\Api\Http\Controllers;

use Saf\Support\Http\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;

        parent::__construct();
    }
}
