<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $from, $to, $filters;

    public function __construct(Request $request)
    {
        $this->from = $request->input('from');
        $this->to = $request->input('to');
        $this->filters = $request->input('filters');
    }
    
}
