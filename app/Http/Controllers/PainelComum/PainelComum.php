<?php

namespace App\Http\Controllers\PainelComum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PainelComum extends Controller
{
    //
    function index(){
        return view('templates.app');
    }
}
