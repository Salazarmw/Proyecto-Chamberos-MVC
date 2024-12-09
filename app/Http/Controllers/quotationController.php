<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class quotationController extends Controller
{
    public function index()
    {
        return view('quotations.index');
    }
}
