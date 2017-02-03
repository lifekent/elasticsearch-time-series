<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->from = $request->input('from');
        $this->to = $request->input('to');
        $this->filters = $request->input('filters');
    }
    
}
