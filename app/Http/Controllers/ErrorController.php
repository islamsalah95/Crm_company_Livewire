<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index($error)
    {
        return view('error', ['error' => $error]);
    }
}
