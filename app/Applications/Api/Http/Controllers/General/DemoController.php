<?php

namespace Saf\Applications\Api\Http\Controllers\General;

use Illuminate\Http\Request;
use Saf\Applications\Api\Http\Controllers\BaseController;

class DemoController extends BaseController
{
    protected $request;

    function __construct(Request $request)
    {
        parent::__construct();

        $this->request = $request;
    }

    public function initial()
    {
        $this->setSeo([
            'title' => 'Página Inicial do Api'
        ]);

        return $this->view('site::index', [
        ]);
    }
}