<?php

namespace App\Http\Controllers\Backend\Currencies;

use App\Http\Controllers\FrontendController;
use App\Model\Currencies\Tcmb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateController extends FrontendController
{
    public function render()
    {
        $a = new Tcmb();
        print_r($a->run());
        die;
    }
}
