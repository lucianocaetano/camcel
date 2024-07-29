<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    //
    public function index(){
        $enterprise = new Enterprise();
        
        $enterprise = $enterprise->all();

        return response()->json($enterprise, 200);
    }
}
