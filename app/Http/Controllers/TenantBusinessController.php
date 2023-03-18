<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TenantBusinessController extends Controller
{
    public function  __invoke()
    {
        return view('tenantBusiness');
    }
}
